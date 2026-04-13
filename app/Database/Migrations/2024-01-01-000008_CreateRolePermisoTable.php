<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateRolePermisoTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'role_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'null'       => false,
            ],
            'permiso_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'null'       => false,
            ],
        ]);
        $this->forge->addKey(['role_id', 'permiso_id'], true);
        $this->forge->addForeignKey('role_id', 'roles', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('permiso_id', 'permisos', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('role_permiso');
    }

    public function down()
    {
        $this->forge->dropTable('role_permiso');
    }
}
