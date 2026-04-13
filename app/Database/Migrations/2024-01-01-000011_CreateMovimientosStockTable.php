<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateMovimientosStockTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'producto_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'null'       => false,
            ],
            'tipo_movimiento' => [
                'type'       => 'ENUM',
                'constraint' => ['entrada', 'salida', 'ajuste', 'devolucion'],
                'null'       => false,
            ],
            'cantidad' => [
                'type'       => 'INT',
                'constraint' => 11,
                'null'       => false,
            ],
            'motivo' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
            ],
            'usuario_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'null'       => false,
            ],
            'fecha_movimiento' => [
                'type'    => 'TIMESTAMP',
                'default' => 'CURRENT_TIMESTAMP',
            ],
            'created_at' => [
                'type'    => 'TIMESTAMP',
                'default' => 'CURRENT_TIMESTAMP',
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('producto_id', 'productos', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('usuario_id', 'usuarios', 'id', 'RESTRICT', 'RESTRICT');
        $this->forge->createTable('movimientos_stock');
    }

    public function down()
    {
        $this->forge->dropTable('movimientos_stock');
    }
}
