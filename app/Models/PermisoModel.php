<?php

namespace App\Models;

use CodeIgniter\Model;

class PermisoModel extends Model
{
    protected $table            = 'permisos';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $allowedFields    = ['nombre', 'modulo', 'descripcion'];
    protected $useTimestamps    = true;
    protected $dateFormat       = 'datetime';
    protected $createdField     = 'created_at';
    protected $updatedField     = '';

    public function getPermisosByModulo(string $modulo)
    {
        return $this->where('modulo', $modulo)->findAll();
    }

    public function getPermisosAgrupados()
    {
        $permisos = $this->findAll();
        $agrupados = [];

        foreach ($permisos as $p) {
            $agrupados[$p['modulo']][] = $p;
        }

        return $agrupados;
    }
}
