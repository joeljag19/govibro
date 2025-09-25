<?php
namespace App\Modules\Auth\Models;

use App\Models\UserModel;

class UserAuthModel extends UserModel
{
    /**
     * Validar las credenciales de un usuario
     * @param string $email Email del usuario
     * @param string $password Contraseña del usuario
     * @return array|null
     */
    public function validateCredentials($email, $password)
    {
        $user = $this->getByEmail($email);
        if ($user && password_verify($password, $user['password'])) {
            return $user;
        }
        return null;
    }

    /**
     * Registrar un nuevo usuario y registrar en audit_logs
     * @param array $data Datos del usuario
     * @return int ID del usuario insertado
     */
    public function register($data)
    {
        $this->db->transBegin();

        // Encriptar la contraseña
        $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        $data['status'] = 'active';
        $data['created_at'] = date('Y-m-d H:i:s');
        $data['updated_at'] = date('Y-m-d H:i:s');

        $userId = $this->insert($data);
        if ($userId) {
            $this->db->table('audit_logs')->insert([
                'user_id' => $userId,
                'action' => 'Usuario registrado',
                'entity_type' => 'user',
                'entity_id' => $userId,
                'details' => json_encode(['email' => $data['email']]),
                'created_at' => date('Y-m-d H:i:s'),
            ]);
        }

        $this->db->transCommit();
        return $userId;
    }

    /**
     * Registrar un candidato como revendedor o vendedor
     * @param array $data Datos del usuario
     * @param string $candidateType 'reseller' o 'seller'
     * @return int ID del usuario insertado
     */
    public function registerCandidate($data, $candidateType)
    {
        $data['role'] = $candidateType === 'reseller' ? 'reseller_candidate' : 'seller_candidate';
        $userId = $this->register($data);  // Llama al method register para reutilizar lógica
        return $userId;
    }
}