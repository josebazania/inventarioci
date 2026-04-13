<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table            = 'usuarios';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['nombre_completo', 'email', 'password', 'role_id', 'activo'];

    protected bool $allowEmptyInserts = false;

    // Dates
    protected $useTimestamps   = true;
    protected $dateFormat      = 'datetime';
    protected $createdField    = 'created_at';
    protected $updatedField    = 'updated_at';

    // Validation
    protected $validationRules = [
        'nombre_completo' => 'required|min_length[3]|max_length[100]',
        'email'           => 'required|valid_email|is_unique[usuarios.email,id,{id}]',
        'role_id'         => 'required|integer',
        'password'        => 'if_not_empty|min_length[6]',
    ];

    protected $validationMessages = [
        'email' => [
            'is_unique' => 'El correo ya está registrado.',
        ],
    ];

    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = ['hashPassword'];
    protected $beforeUpdate   = ['hashPassword'];

    protected function hashPassword(array $data)
    {
        if (isset($data['data']['password']) && $data['data']['password']) {
            $data['data']['password'] = password_hash($data['data']['password'], PASSWORD_DEFAULT);
        }
        return $data;
    }

    public function getUserWithRole(int $id)
    {
        return $this->select('usuarios.*, roles.nombre as role_nombre')
            ->join('roles', 'roles.id = usuarios.role_id')
            ->find($id);
    }

    public function getUsersWithRole()
    {
        return $this->select('usuarios.*, roles.nombre as role_nombre')
            ->join('roles', 'roles.id = usuarios.role_id')
            ->findAll();
    }

    public function verifyPassword(string $email, string $password)
    {
        $user = $this->where('email', $email)->first();

        if ($user && password_verify($password, $user['password'])) {
            return $user;
        }

        return false;
    }
}
