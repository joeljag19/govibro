<?php
namespace App\Modules\AdminTours\Models;

use App\Models\LocationsTranslationsModel;

class LocationsTranslationsAdminModel extends LocationsTranslationsModel
{
    /**
     * Sobreescribir insert para registrar en audit_logs
     * @param array $data Datos de la traducción
     * @param int $userId ID del usuario que realiza la acción
     * @return int ID insertado
     */
    public function insertTranslation($data, $userId = null)
    {
        $this->db->transBegin();

        $data['create_user'] = $userId;
        $data['created_at'] = date('Y-m-d H:i:s');
        $data['updated_at'] = date('Y-m-d H:i:s');
        $this->insert($data);
        $translationId = $this->db->insertID();

        if ($translationId) {
            $this->db->table('audit_logs')->insert([
                'user_id' => $userId,
                'action' => 'Creó traducción de ubicación',
                'entity_type' => 'location_translation',
                'entity_id' => $translationId,
                'details' => json_encode($data),
                'created_at' => date('Y-m-d H:i:s'),
            ]);
        }

        $this->db->transCommit();
        return $translationId;
    }

    /**
     * Sobreescribir update para registrar en audit_logs
     * @param int $locationId ID de la ubicación
     * @param string $locale Idioma
     * @param array $data Datos de la traducción
     * @param int $userId ID del usuario que realiza la acción
     * @return int Filas afectadas
     */
    public function updateTranslation($locationId, $locale, $data, $userId = null)
    {
        $this->db->transBegin();

        $data['update_user'] = $userId;
        $data['updated_at'] = date('Y-m-d H:i:s');
        $result = $this->where('origin_id', $locationId)
                       ->where('locale', $locale)
                       ->update($data);

        if ($result) {
            $this->db->table('audit_logs')->insert([
                'user_id' => $userId,
                'action' => 'Actualizó traducción de ubicación',
                'entity_type' => 'location_translation',
                'entity_id' => 0,
                'details' => json_encode(['location_id' => $locationId, 'locale' => $locale, 'data' => $data]),
                'created_at' => date('Y-m-d H:i:s'),
            ]);
        }

        $this->db->transCommit();
        return $result;
    }
}