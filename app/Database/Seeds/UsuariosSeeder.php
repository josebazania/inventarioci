<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UsuariosSeeder extends Seeder
{
    public function run()
    {
        // Password por defecto: admin123
        // Hash generado con password_hash('admin123', PASSWORD_DEFAULT)
        // $2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi
        $hashPassword = '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi';

        $data = [
            [
                'nombre_completo' => 'Admin Sistema',
                'email'           => 'admin@inventario.com',
                'password'        => $hashPassword,
                'role_id'         => 1,
            ],
            [
                'nombre_completo' => 'Juan Almacen',
                'email'           => 'juan@inventario.com',
                'password'        => $hashPassword,
                'role_id'         => 2,
            ],
            [
                'nombre_completo' => 'Maria Supervisor',
                'email'           => 'maria@inventario.com',
                'password'        => $hashPassword,
                'role_id'         => 3,
            ],
        ];

        $this->db->table('usuarios')->insertBatch($data);
    }
}
