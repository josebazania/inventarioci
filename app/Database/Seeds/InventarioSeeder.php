<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class InventarioSeeder extends Seeder
{
    public function run()
    {
        // Ejecutar seeders en orden de dependencias
        $this->call('RolesSeeder');
        $this->call('PermisosSeeder');
        $this->call('UsuariosSeeder');
        $this->call('CatalogosSeeder');
        $this->call('ProductosSeeder');
    }
}
