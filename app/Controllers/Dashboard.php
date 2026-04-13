<?php

namespace App\Controllers;

use App\Models\StockModel;
use App\Models\ProductoModel;
use App\Models\MovimientoStockModel;

class Dashboard extends BaseController
{
    public function index()
    {
        $productoModel = new ProductoModel();
        $stockModel    = new StockModel();
        $movModel      = new MovimientoStockModel();

        $data = [
            'title'          => 'Dashboard',
            'total_productos' => $productoModel->where('activo', 1)->countAllResults(),
            'total_categorias' => $productoModel->db->table('categorias')->countAllResults(),
            'total_proveedores' => $productoModel->db->table('proveedores')->where('activo', 1)->countAllResults(),
            'stock_bajo'     => $stockModel->getStockBajo(),
            'ultimos_movimientos' => $movModel->getMovimientosConDetalles(null),
        ];

        return view('dashboard/index', $data);
    }
}
