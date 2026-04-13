<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ProductosSeeder extends Seeder
{
    public function run()
    {
        // Productos
        $productos = [
            ['codigo' => 'ELEC-001', 'nombre' => 'Mouse Inalámbrico', 'descripcion' => 'Mouse inalámbrico ergonómico', 'categoria_id' => 1, 'marca_id' => 2, 'proveedor_id' => 1, 'precio_compra' => 25.00, 'precio_venta' => 45.00, 'stock_minimo' => 10, 'stock_maximo' => 100],
            ['codigo' => 'ELEC-002', 'nombre' => 'Teclado Mecánico', 'descripcion' => 'Teclado mecánico retroiluminado', 'categoria_id' => 1, 'marca_id' => 2, 'proveedor_id' => 1, 'precio_compra' => 80.00, 'precio_venta' => 150.00, 'stock_minimo' => 5, 'stock_maximo' => 50],
            ['codigo' => 'ELEC-003', 'nombre' => 'Monitor 24"', 'descripcion' => 'Monitor LED Full HD 24 pulgadas', 'categoria_id' => 1, 'marca_id' => 6, 'proveedor_id' => 1, 'precio_compra' => 350.00, 'precio_venta' => 550.00, 'stock_minimo' => 3, 'stock_maximo' => 30],
            ['codigo' => 'OFI-001', 'nombre' => 'Resma Papel A4', 'descripcion' => 'Resma de papel A4 500 hojas', 'categoria_id' => 2, 'marca_id' => 1, 'proveedor_id' => 2, 'precio_compra' => 8.00, 'precio_venta' => 15.00, 'stock_minimo' => 50, 'stock_maximo' => 500],
            ['codigo' => 'OFI-002', 'nombre' => 'Bolígrafo Azul (caja)', 'descripcion' => 'Caja de 50 bolígrafos azules', 'categoria_id' => 2, 'marca_id' => 1, 'proveedor_id' => 2, 'precio_compra' => 12.00, 'precio_venta' => 22.00, 'stock_minimo' => 20, 'stock_maximo' => 200],
            ['codigo' => 'LIMP-001', 'nombre' => 'Desinfectante Multiuso', 'descripcion' => 'Desinfectante multiuso 5L', 'categoria_id' => 3, 'marca_id' => 1, 'proveedor_id' => 3, 'precio_compra' => 15.00, 'precio_venta' => 28.00, 'stock_minimo' => 10, 'stock_maximo' => 100],
            ['codigo' => 'LIMP-002', 'nombre' => 'Toallas de Papel (pack)', 'descripcion' => 'Pack 6 rollos toallas de papel', 'categoria_id' => 3, 'marca_id' => 1, 'proveedor_id' => 3, 'precio_compra' => 10.00, 'precio_venta' => 18.00, 'stock_minimo' => 15, 'stock_maximo' => 150],
            ['codigo' => 'SEG-001', 'nombre' => 'Extintor PQS 6kg', 'descripcion' => 'Extintor de polvo químico seco 6kg', 'categoria_id' => 4, 'marca_id' => 1, 'proveedor_id' => 1, 'precio_compra' => 60.00, 'precio_venta' => 95.00, 'stock_minimo' => 5, 'stock_maximo' => 50],
            ['codigo' => 'SEG-002', 'nombre' => 'Botiquín Primeros Auxilios', 'descripcion' => 'Botiquín completo 20 piezas', 'categoria_id' => 4, 'marca_id' => 1, 'proveedor_id' => 1, 'precio_compra' => 45.00, 'precio_venta' => 75.00, 'stock_minimo' => 3, 'stock_maximo' => 30],
            ['codigo' => 'HERR-001', 'nombre' => 'Set Destornilladores', 'descripcion' => 'Set de 20 destornilladores', 'categoria_id' => 5, 'marca_id' => 8, 'proveedor_id' => 1, 'precio_compra' => 35.00, 'precio_venta' => 60.00, 'stock_minimo' => 5, 'stock_maximo' => 50],
            ['codigo' => 'RED-001', 'nombre' => 'Cable Ethernet Cat6 (305m)', 'descripcion' => 'Rollo cable de red 305 metros', 'categoria_id' => 6, 'marca_id' => 1, 'proveedor_id' => 1, 'precio_compra' => 85.00, 'precio_venta' => 140.00, 'stock_minimo' => 5, 'stock_maximo' => 50],
            ['codigo' => 'RED-002', 'nombre' => 'Switch 8 Puertos', 'descripcion' => 'Switch de red 8 puertos Gigabit', 'categoria_id' => 6, 'marca_id' => 3, 'proveedor_id' => 1, 'precio_compra' => 45.00, 'precio_venta' => 75.00, 'stock_minimo' => 5, 'stock_maximo' => 40],
            ['codigo' => 'SOFT-001', 'nombre' => 'Licencia Office 365', 'descripcion' => 'Licencia anual Office 365 Business', 'categoria_id' => 7, 'marca_id' => 5, 'proveedor_id' => 1, 'precio_compra' => 85.00, 'precio_venta' => 120.00, 'stock_minimo' => 0, 'stock_maximo' => 200],
            ['codigo' => 'MOB-001', 'nombre' => 'Silla Ergonómica', 'descripcion' => 'Silla de oficina ergonómica ajustable', 'categoria_id' => 8, 'marca_id' => 1, 'proveedor_id' => 2, 'precio_compra' => 180.00, 'precio_venta' => 300.00, 'stock_minimo' => 3, 'stock_maximo' => 30],
            ['codigo' => 'MOB-002', 'nombre' => 'Escritorio 1.40m', 'descripcion' => 'Escritorio de oficina 1.40x0.70m', 'categoria_id' => 8, 'marca_id' => 1, 'proveedor_id' => 2, 'precio_compra' => 220.00, 'precio_venta' => 380.00, 'stock_minimo' => 2, 'stock_maximo' => 20],
        ];
        $this->db->table('productos')->insertBatch($productos);

        // Stocks iniciales
        $stocks = [
            ['producto_id' => 1, 'cantidad' => 35],
            ['producto_id' => 2, 'cantidad' => 12],
            ['producto_id' => 3, 'cantidad' => 8],
            ['producto_id' => 4, 'cantidad' => 150],
            ['producto_id' => 5, 'cantidad' => 45],
            ['producto_id' => 6, 'cantidad' => 25],
            ['producto_id' => 7, 'cantidad' => 30],
            ['producto_id' => 8, 'cantidad' => 10],
            ['producto_id' => 9, 'cantidad' => 8],
            ['producto_id' => 10, 'cantidad' => 15],
            ['producto_id' => 11, 'cantidad' => 12],
            ['producto_id' => 12, 'cantidad' => 18],
            ['producto_id' => 13, 'cantidad' => 50],
            ['producto_id' => 14, 'cantidad' => 10],
            ['producto_id' => 15, 'cantidad' => 7],
        ];
        $this->db->table('stocks')->insertBatch($stocks);

        // Almacenes
        $almacenes = [
            ['nombre' => 'Almacén Principal', 'ubicacion' => 'Edificio A - Sótano', 'descripcion' => 'Almacén central de inventario'],
            ['nombre' => 'Almacén Oficina Central', 'ubicacion' => 'Piso 2 - Sala 201', 'descripcion' => 'Almacén de suministros de oficina'],
            ['nombre' => 'Almacén Seguridad', 'ubicacion' => 'Edificio B - Planta Baja', 'descripcion' => 'Almacén de equipos de seguridad'],
        ];
        $this->db->table('almacenes')->insertBatch($almacenes);

        // Stock por almacén
        $stockAlmacen = [
            ['producto_id' => 1, 'almacen_id' => 1, 'cantidad' => 20],
            ['producto_id' => 1, 'almacen_id' => 2, 'cantidad' => 15],
            ['producto_id' => 2, 'almacen_id' => 1, 'cantidad' => 12],
            ['producto_id' => 3, 'almacen_id' => 1, 'cantidad' => 8],
            ['producto_id' => 4, 'almacen_id' => 2, 'cantidad' => 100],
            ['producto_id' => 4, 'almacen_id' => 1, 'cantidad' => 50],
            ['producto_id' => 5, 'almacen_id' => 2, 'cantidad' => 45],
            ['producto_id' => 6, 'almacen_id' => 2, 'cantidad' => 25],
            ['producto_id' => 7, 'almacen_id' => 2, 'cantidad' => 30],
            ['producto_id' => 8, 'almacen_id' => 3, 'cantidad' => 10],
            ['producto_id' => 9, 'almacen_id' => 3, 'cantidad' => 8],
            ['producto_id' => 10, 'almacen_id' => 1, 'cantidad' => 15],
            ['producto_id' => 11, 'almacen_id' => 1, 'cantidad' => 12],
            ['producto_id' => 12, 'almacen_id' => 1, 'cantidad' => 18],
            ['producto_id' => 13, 'almacen_id' => 1, 'cantidad' => 50],
            ['producto_id' => 14, 'almacen_id' => 1, 'cantidad' => 5],
            ['producto_id' => 14, 'almacen_id' => 2, 'cantidad' => 5],
            ['producto_id' => 15, 'almacen_id' => 1, 'cantidad' => 7],
        ];
        $this->db->table('stock_almacen')->insertBatch($stockAlmacen);

        // Movimientos de stock iniciales
        $movimientos = [
            ['producto_id' => 1, 'tipo_movimiento' => 'entrada', 'cantidad' => 50, 'motivo' => 'Compra inicial a TechDistribuciones', 'usuario_id' => 1],
            ['producto_id' => 2, 'tipo_movimiento' => 'entrada', 'cantidad' => 20, 'motivo' => 'Compra inicial a TechDistribuciones', 'usuario_id' => 1],
            ['producto_id' => 4, 'tipo_movimiento' => 'entrada', 'cantidad' => 200, 'motivo' => 'Compra inicial a OficinaPlus', 'usuario_id' => 1],
            ['producto_id' => 6, 'tipo_movimiento' => 'entrada', 'cantidad' => 40, 'motivo' => 'Compra inicial a LimpioMax', 'usuario_id' => 1],
            ['producto_id' => 8, 'tipo_movimiento' => 'entrada', 'cantidad' => 15, 'motivo' => 'Compra inicial de equipos seguridad', 'usuario_id' => 1],
        ];
        $this->db->table('movimientos_stock')->insertBatch($movimientos);
    }
}
