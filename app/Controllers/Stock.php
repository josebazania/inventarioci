<?php

namespace App\Controllers;

use App\Models\StockModel;
use App\Models\ProductoModel;
use App\Models\MovimientoStockModel;

class Stock extends BaseController
{
    public function index()
    {
        $stockModel = new StockModel();
        $productoModel = new ProductoModel();

        $data = [
            'title'    => 'Control de Stock',
            'productos' => $productoModel->getProductosConDetalles(),
            'stock_bajo' => $stockModel->getStockBajo(),
        ];

        return view('stock/index', $data);
    }

    public function movimiento(int $productoId = null)
    {
        $productoModel = new ProductoModel();

        if ($productoId) {
            $producto = $productoModel->getProductoDetalle($productoId);
            if (!$producto) {
                return redirect()->to(base_url('stock'))->with('error', 'Producto no encontrado.');
            }
        }

        $data = [
            'title'    => $productoId ? 'Registrar Movimiento' : 'Registrar Movimiento',
            'productos' => $productoModel->where('activo', 1)->findAll(),
            'producto'  => $producto ?? null,
        ];

        return view('stock/movimiento', $data);
    }

    public function registrarMovimiento()
    {
        $rules = [
            'producto_id'     => 'required|integer',
            'tipo_movimiento' => 'required|in_list[entrada,salida,ajuste,devolucion]',
            'cantidad'        => 'required|integer|greater_than[0]',
            'motivo'          => 'permit_empty|max_length[255]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $movModel = new MovimientoStockModel();

        $data = [
            'producto_id'     => $this->request->getPost('producto_id'),
            'tipo_movimiento' => $this->request->getPost('tipo_movimiento'),
            'cantidad'        => (int) $this->request->getPost('cantidad'),
            'motivo'          => $this->request->getPost('motivo'),
            'usuario_id'      => session()->get('user_id'),
        ];

        $result = $movModel->registrarMovimiento($data);

        if ($result) {
            return redirect()->to(base_url('stock'))->with('success', 'Movimiento registrado correctamente.');
        }

        return redirect()->back()->with('error', 'No hay suficiente stock para realizar la salida.');
    }

    public function historial(int $productoId = null)
    {
        $movModel = new MovimientoStockModel();

        $data = [
            'title'      => 'Historial de Movimientos',
            'movimientos' => $movModel->getMovimientosConDetalles($productoId),
        ];

        return view('stock/historial', $data);
    }

    public function stockBajo()
    {
        $stockModel = new StockModel();

        $data = [
            'title'      => 'Stock Bajo',
            'stock_bajo' => $stockModel->getStockBajo(),
        ];

        return view('stock/stock_bajo', $data);
    }
}
