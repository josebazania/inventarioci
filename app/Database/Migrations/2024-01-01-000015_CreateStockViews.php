<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateStockViews extends Migration
{
    public function up()
    {
        // Vista: Stock actual con detalles
        $sqlVistaStockActual = "
            CREATE VIEW vista_stock_actual AS
            SELECT
                p.id AS producto_id,
                p.codigo,
                p.nombre AS producto_nombre,
                c.nombre AS categoria_nombre,
                m.nombre AS marca_nombre,
                pr.nombre AS proveedor_nombre,
                s.cantidad AS stock_actual,
                p.stock_minimo,
                p.stock_maximo,
                CASE
                    WHEN s.cantidad <= p.stock_minimo THEN 'Stock Bajo'
                    WHEN s.cantidad >= p.stock_maximo AND p.stock_maximo > 0 THEN 'Stock Excedido'
                    ELSE 'Normal'
                END AS estado_stock
            FROM productos p
            LEFT JOIN stocks s ON p.id = s.producto_id
            LEFT JOIN categorias c ON p.categoria_id = c.id
            LEFT JOIN marcas m ON p.marca_id = m.id
            LEFT JOIN proveedores pr ON p.proveedor_id = pr.id
            WHERE p.activo = 1
        ";

        $this->db->query($sqlVistaStockActual);

        // Vista: Productos con stock bajo
        $sqlVistaStockBajo = "
            CREATE VIEW vista_stock_bajo AS
            SELECT
                p.id AS producto_id,
                p.codigo,
                p.nombre AS producto_nombre,
                c.nombre AS categoria_nombre,
                s.cantidad AS stock_actual,
                p.stock_minimo,
                (p.stock_minimo - s.cantidad) AS cantidad_faltante
            FROM productos p
            LEFT JOIN stocks s ON p.id = s.producto_id
            LEFT JOIN categorias c ON p.categoria_id = c.id
            WHERE p.activo = 1
              AND s.cantidad <= p.stock_minimo
        ";

        $this->db->query($sqlVistaStockBajo);
    }

    public function down()
    {
        $this->db->query('DROP VIEW IF EXISTS vista_stock_bajo');
        $this->db->query('DROP VIEW IF EXISTS vista_stock_actual');
    }
}
