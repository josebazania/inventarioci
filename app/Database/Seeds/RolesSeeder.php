<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class RolesSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'nombre'      => 'Administrador',
                'descripcion' => 'Acceso completo al sistema',
            ],
            [
                'nombre'      => 'Almacenista',
                'descripcion' => 'Gestión de stock y movimientos',
            ],
            [
                'nombre'      => 'Supervisor',
                'descripcion' => 'Supervisión y reportes',
            ],
            [
                'nombre'      => 'Consulta',
                'descripcion' => 'Solo lectura de información',
            ],
        ];

        $this->db->table('roles')->insertBatch($data);
    }
}
