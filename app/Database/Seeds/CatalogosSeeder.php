<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class CatalogosSeeder extends Seeder
{
    public function run()
    {
        // Categorías
        $categorias = [
            ['nombre' => 'Electrónica', 'descripcion' => 'Productos y componentes electrónicos'],
            ['nombre' => 'Oficina', 'descripcion' => 'Artículos y suministros de oficina'],
            ['nombre' => 'Limpieza', 'descripcion' => 'Productos de limpieza'],
            ['nombre' => 'Seguridad', 'descripcion' => 'Equipos de seguridad'],
            ['nombre' => 'Herramientas', 'descripcion' => 'Herramientas manuales y eléctricas'],
            ['nombre' => 'Redes', 'descripcion' => 'Equipos y accesorios de red'],
            ['nombre' => 'Software', 'descripcion' => 'Licencias de software'],
            ['nombre' => 'Mobiliario', 'descripcion' => 'Mobiliario de oficina'],
        ];
        $this->db->table('categorias')->insertBatch($categorias);

        // Marcas
        $marcas = [
            ['nombre' => 'Genérico'],
            ['nombre' => 'Logitech'],
            ['nombre' => 'HP'],
            ['nombre' => 'Dell'],
            ['nombre' => 'Microsoft'],
            ['nombre' => 'Samsung'],
            ['nombre' => '3M'],
            ['nombre' => 'Stanley'],
        ];
        $this->db->table('marcas')->insertBatch($marcas);

        // Proveedores
        $proveedores = [
            [
                'nombre'    => 'TechDistribuciones SAC',
                'ruc'       => '20601234567',
                'direccion' => 'Av. Tecnológica 123, Lima',
                'telefono'  => '01-2345678',
                'email'     => 'ventas@techdist.com',
                'contacto'  => 'Carlos Ruiz',
            ],
            [
                'nombre'    => 'OficinaPlus EIRL',
                'ruc'       => '20609876543',
                'direccion' => 'Jr. Comercio 456, Lima',
                'telefono'  => '01-8765432',
                'email'     => 'info@oficinaplus.com',
                'contacto'  => 'Ana Torres',
            ],
            [
                'nombre'    => 'LimpioMax SAC',
                'ruc'       => '20605555555',
                'direccion' => 'Av. Industrial 789, Lima',
                'telefono'  => '01-5555555',
                'email'     => 'contacto@limpiomax.com',
                'contacto'  => 'Pedro Gomez',
            ],
        ];
        $this->db->table('proveedores')->insertBatch($proveedores);
    }
}
