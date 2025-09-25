<?php

namespace App\Validation;

class TourRules
{
    /**
     * Valida que los datos del array de inclusiones tengan el formato correcto.
     * Espera un array de arrays, donde cada subarray tiene una clave "item" con un string no vacío.
     *
     * @param array|null $data El array del campo 'include'.
     * @return bool
     */
    public function validate_inclusion_data(?array $data): bool
    {
        // Si no se proporcionaron datos, es válido (permit_empty se encarga de esto)
        if (empty($data)) {
            return true;
        }

        // Revisar cada elemento del array
        foreach ($data as $inclusion) {
            // Debe ser un array y tener la clave 'item'
            if (!is_array($inclusion) || !array_key_exists('item', $inclusion)) {
                return false;
            }
            // El valor de 'item' no puede estar vacío
            if (empty(trim($inclusion['item']))) {
                return false;
            }
        }

        // Si todo está correcto, la validación pasa
        return true;
    }
}