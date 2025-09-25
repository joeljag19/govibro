<?php
namespace App\Modules\AdminTours\Models;

use CodeIgniter\Model;

class TourAvailabilityModel extends Model
{
    protected $table         = 'tour_availability';
    protected $primaryKey    = 'id';
    protected $allowedFields = [
        'tour_id',
        'start_date',
        'end_date',
        'price',
        'max_people',
        'is_available'
        // Añade aquí cualquier otro campo que gestiones desde el calendario
    ];
    protected $useTimestamps = true;

    /**
     * Obtiene y formatea los registros de disponibilidad para FullCalendar,
     * aplicando una lógica de anulación donde las reglas más específicas
     * (fechas únicas) tienen prioridad sobre las reglas generales (rangos).
     *
     * @param int $tourId El ID del tour.
     * @return array Un array de eventos para el calendario.
     */
    public function getEventsForCalendar($tourId)
    {
        // Ordenamos por fecha de inicio para procesar en orden cronológico
        $availabilities = $this->where('tour_id', $tourId)->orderBy('start_date', 'asc')->findAll();
        
        $finalSchedule = [];

        // 1. Expandir todos los rangos a días individuales en un mapa
        foreach ($availabilities as $avail) {
            $currentDate = new \DateTime($avail['start_date']);
            $endDate = new \DateTime($avail['end_date']);

            while ($currentDate <= $endDate) {
                $dateString = $currentDate->format('Y-m-d');
                
                // La regla más específica (la última leída para un día) sobrescribe la anterior
                $finalSchedule[$dateString] = [
                    'id'           => $avail['id'],
                    'start_date'   => $dateString,
                    'end_date'     => $dateString,
                    'is_available' => $avail['is_available'],
                    'max_people'   => $avail['max_people'],
                    'price'        => $avail['price']
                ];
                
                $currentDate->modify('+1 day');
            }
        }

        // 2. Agrupar días consecutivos con las mismas propiedades en rangos
        $events = [];
        $schedule = array_values($finalSchedule); // Reindexar el array
        $i = 0;
        while ($i < count($schedule)) {
            $currentEvent = $schedule[$i];
            $j = $i;
            // Buscar hasta dónde se extiende este evento
            while (
                $j + 1 < count($schedule) &&
                $schedule[$j+1]['is_available'] == $currentEvent['is_available'] &&
                $schedule[$j+1]['max_people'] == $currentEvent['max_people'] &&
                (new \DateTime($schedule[$j]['end_date']))->modify('+1 day') == (new \DateTime($schedule[$j+1]['start_date']))
            ) {
                $j++;
            }
            
            // Crear el evento agrupado
            $endDate = $schedule[$j]['end_date'];
            $events[] = [
                'id'        => $currentEvent['id'], // Usamos el ID del primer día del rango
                'title'     => $currentEvent['is_available'] ? "Disponible (" . ($currentEvent['max_people'] ?? 'N/A') . " plazas)" : 'No Disponible',
                'start'     => $currentEvent['start_date'],
                'end'       => date('Y-m-d', strtotime($endDate . ' +1 day')),
                'color'     => $currentEvent['is_available'] ? '#28a745' : '#dc3545',
                'extendedProps' => [
                    'price' => $currentEvent['price'],
                    'max_people' => $currentEvent['max_people'],
                    'is_available' => $currentEvent['is_available']
                ]
            ];
            
            $i = $j + 1;
        }

        return $events;
    }

    /**
     * Helper: Divide un rango disponible si se superpone con uno no disponible.
     */
    private function splitRange($available, $unavailable)
    {
        $availStart = new \DateTime($available['start_date']);
        $availEnd = new \DateTime($available['end_date']);
        $unavailStart = new \DateTime($unavailable['start_date']);
        $unavailEnd = new \DateTime($unavailable['end_date']);

        // Si no hay superposición, devolver el rango original
        if ($availStart > $unavailEnd || $availEnd < $unavailStart) {
            return [$available];
        }

        $parts = [];

        // Parte 1: La porción del rango disponible que está ANTES del bloqueo
        if ($availStart < $unavailStart) {
            $part1 = $available;
            $part1['end_date'] = (clone $unavailStart)->modify('-1 day')->format('Y-m-d');
            $parts[] = $part1;
        }

        // Parte 2: La porción del rango disponible que está DESPUÉS del bloqueo
        if ($availEnd > $unavailEnd) {
            $part2 = $available;
            $part2['start_date'] = (clone $unavailEnd)->modify('+1 day')->format('Y-m-d');
            $parts[] = $part2;
        }

        return $parts;
    }

    /**
     * Guarda (inserta o actualiza) un evento de disponibilidad.
     * Si ya existe un registro para la misma fecha/rango, lo actualiza
     * para evitar duplicados.
     *
     * @param array $data Los datos del evento recibidos del controlador.
     * @return int|bool El ID del registro insertado/actualizado o false si falla.
     */
    public function saveEvent($data)
    {
        // Prepara los datos para la base de datos
        $eventData = [
            'tour_id'      => $data['tour_id'],
            'start_date'   => $data['start'],
            // Ajustamos la fecha final que viene de FullCalendar
            'end_date'     => date('Y-m-d', strtotime($data['end'] . ' -1 day')),
            'price'        => empty($data['price']) ? null : (float)$data['price'],
            'max_people'   => empty($data['max_people']) ? null : (int)$data['max_people'],
            'is_available' => $data['is_available'] ? 1 : 0,
        ];

        // Si se está editando un evento existente (tiene ID), simplemente actualizamos.
        if (!empty($data['id'])) {
            $this->update($data['id'], $eventData);
            return $data['id'];
        }

        // Si es un evento nuevo, comprobamos si ya existe una regla para esa fecha exacta.
        $existing = $this->where('tour_id', $eventData['tour_id'])
                         ->where('start_date', $eventData['start_date'])
                         ->where('end_date', $eventData['end_date'])
                         ->first();

        if ($existing) {
            // Si existe, lo actualizamos en lugar de crear un duplicado.
            $this->update($existing['id'], $eventData);
            return $existing['id'];
        } else {
            // Si no existe, es un registro verdaderamente nuevo.
            return $this->insert($eventData);
        }
    }

}
