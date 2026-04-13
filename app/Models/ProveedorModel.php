<?php

namespace App\Models;

use CodeIgniter\Model;

class ProveedorModel extends Model
{
    protected $table            = 'proveedores';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $allowedFields    = ['nombre', 'ruc', 'direccion', 'telefono', 'email', 'contacto', 'activo'];
    protected $useTimestamps    = true;
    protected $dateFormat       = 'datetime';
    protected $createdField     = 'created_at';
    protected $updatedField     = 'updated_at';

    protected $validationRules = [
        'nombre'    => 'required|min_length[2]|max_length[100]',
        'ruc'       => 'permit_empty|is_unique[proveedores.ruc,id,{id}]|max_length[20]',
        'telefono'  => 'permit_empty|max_length[20]',
        'email'     => 'permit_empty|valid_email|max_length[100]',
    ];
}
