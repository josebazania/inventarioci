<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class PermisosSeeder extends Seeder
{
    public function run()
    {
        // Insertar permisos
        $permisos = [
            ['nombre' => 'usuarios.create', 'modulo' => 'usuarios', 'descripcion' => 'Crear usuarios'],
            ['nombre' => 'usuarios.read', 'modulo' => 'usuarios', 'descripcion' => 'Ver usuarios'],
            ['nombre' => 'usuarios.update', 'modulo' => 'usuarios', 'descripcion' => 'Actualizar usuarios'],
            ['nombre' => 'usuarios.delete', 'modulo' => 'usuarios', 'descripcion' => 'Eliminar usuarios'],
            ['nombre' => 'productos.create', 'modulo' => 'productos', 'descripcion' => 'Crear productos'],
            ['nombre' => 'productos.read', 'modulo' => 'productos', 'descripcion' => 'Ver productos'],
            ['nombre' => 'productos.update', 'modulo' => 'productos', 'descripcion' => 'Actualizar productos'],
            ['nombre' => 'productos.delete', 'modulo' => 'productos', 'descripcion' => 'Eliminar productos'],
            ['nombre' => 'categorias.create', 'modulo' => 'categorias', 'descripcion' => 'Crear categorías'],
            ['nombre' => 'categorias.read', 'modulo' => 'categorias', 'descripcion' => 'Ver categorías'],
            ['nombre' => 'categorias.update', 'modulo' => 'categorias', 'descripcion' => 'Actualizar categorías'],
            ['nombre' => 'categorias.delete', 'modulo' => 'categorias', 'descripcion' => 'Eliminar categorías'],
            ['nombre' => 'stock.entrada', 'modulo' => 'stock', 'descripcion' => 'Registrar entrada de stock'],
            ['nombre' => 'stock.salida', 'modulo' => 'stock', 'descripcion' => 'Registrar salida de stock'],
            ['nombre' => 'stock.ajuste', 'modulo' => 'stock', 'descripcion' => 'Ajustar stock'],
            ['nombre' => 'stock.ver', 'modulo' => 'stock', 'descripcion' => 'Ver stock'],
            ['nombre' => 'reportes.ver', 'modulo' => 'reportes', 'descripcion' => 'Ver reportes'],
            ['nombre' => 'transferencias.create', 'modulo' => 'transferencias', 'descripcion' => 'Crear transferencias'],
            ['nombre' => 'transferencias.read', 'modulo' => 'transferencias', 'descripcion' => 'Ver transferencias'],
        ];

        $this->db->table('permisos')->insertBatch($permisos);

        // Asignar permisos a roles
        
        // Administrador (role_id = 1): todos los permisos
        $rolePermisoAdmin = [];
        for ($i = 1; $i <= 19; $i++) {
            $rolePermisoAdmin[] = ['role_id' => 1, 'permiso_id' => $i];
        }
        $this->db->table('role_permiso')->insertBatch($rolePermisoAdmin);

        // Almacenista (role_id = 2): permisos de stock y lectura
        $rolePermisoAlmacenista = [
            ['role_id' => 2, 'permiso_id' => 5],  // productos.create
            ['role_id' => 2, 'permiso_id' => 6],  // productos.read
            ['role_id' => 2, 'permiso_id' => 7],  // productos.update
            ['role_id' => 2, 'permiso_id' => 13], // stock.entrada
            ['role_id' => 2, 'permiso_id' => 14], // stock.salida
            ['role_id' => 2, 'permiso_id' => 15], // stock.ajuste
            ['role_id' => 2, 'permiso_id' => 16], // stock.ver
            ['role_id' => 2, 'permiso_id' => 18], // transferencias.create
            ['role_id' => 2, 'permiso_id' => 19], // transferencias.read
        ];
        $this->db->table('role_permiso')->insertBatch($rolePermisoAlmacenista);

        // Supervisor (role_id = 3): lectura y reportes
        $rolePermisoSupervisor = [
            ['role_id' => 3, 'permiso_id' => 2],   // usuarios.read
            ['role_id' => 3, 'permiso_id' => 6],   // productos.read
            ['role_id' => 3, 'permiso_id' => 10],  // categorias.read
            ['role_id' => 3, 'permiso_id' => 13],  // stock.entrada
            ['role_id' => 3, 'permiso_id' => 14],  // stock.salida
            ['role_id' => 3, 'permiso_id' => 15],  // stock.ajuste
            ['role_id' => 3, 'permiso_id' => 16],  // stock.ver
            ['role_id' => 3, 'permiso_id' => 17],  // reportes.ver
            ['role_id' => 3, 'permiso_id' => 19],  // transferencias.read
        ];
        $this->db->table('role_permiso')->insertBatch($rolePermisoSupervisor);

        // Consulta (role_id = 4): solo lectura
        $rolePermisoConsulta = [
            ['role_id' => 4, 'permiso_id' => 2],   // usuarios.read
            ['role_id' => 4, 'permiso_id' => 6],   // productos.read
            ['role_id' => 4, 'permiso_id' => 10],  // categorias.read
            ['role_id' => 4, 'permiso_id' => 16],  // stock.ver
            ['role_id' => 4, 'permiso_id' => 17],  // reportes.ver
            ['role_id' => 4, 'permiso_id' => 19],  // transferencias.read
        ];
        $this->db->table('role_permiso')->insertBatch($rolePermisoConsulta);
    }
}
