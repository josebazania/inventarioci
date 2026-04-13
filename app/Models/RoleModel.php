<?php

namespace App\Models;

use CodeIgniter\Model;

class RoleModel extends Model
{
    protected $table            = 'roles';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $allowedFields    = ['nombre', 'descripcion'];
    protected $useTimestamps    = true;
    protected $dateFormat       = 'datetime';
    protected $createdField     = 'created_at';
    protected $updatedField     = 'updated_at';

    protected $validationRules = [
        'nombre'      => 'required|min_length[2]|max_length[50]|is_unique[roles.nombre,id,{id}]',
        'descripcion' => 'permit_empty|max_length[500]',
    ];

    public function getRoleWithPermissions(int $id)
    {
        $role = $this->find($id);

        if ($role) {
            $role['permisos'] = $this->db->table('role_permiso rp')
                ->select('p.id, p.nombre, p.modulo')
                ->join('permisos p', 'p.id = rp.permiso_id')
                ->where('rp.role_id', $id)
                ->get()
                ->getResultArray();
        }

        return $role;
    }

    public function assignPermission(int $roleId, int $permissionId)
    {
        return $this->db->table('role_permiso')->insert([
            'role_id'     => $roleId,
            'permiso_id'  => $permissionId,
        ]);
    }

    public function removePermission(int $roleId, int $permissionId)
    {
        return $this->db->table('role_permiso')
            ->where('role_id', $roleId)
            ->where('permiso_id', $permissionId)
            ->delete();
    }

    public function syncPermissions(int $roleId, array $permissionIds)
    {
        $this->db->table('role_permiso')->where('role_id', $roleId)->delete();

        foreach ($permissionIds as $permId) {
            $this->db->table('role_permiso')->insert([
                'role_id'    => $roleId,
                'permiso_id' => $permId,
            ]);
        }
    }
}
