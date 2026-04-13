<?php

namespace App\Models;

use CodeIgniter\Model;

class MovimientoStockModel extends Model
{
    protected $table            = 'movimientos_stock';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $allowedFields    = ['producto_id', 'tipo_movimiento', 'cantidad', 'motivo', 'usuario_id', 'fecha_movimiento'];
    protected $useTimestamps    = true;
    protected $dateFormat       = 'datetime';
    protected $createdField     = 'created_at';
    protected $updatedField     = '';

    public function getMovimientosConDetalles(int $productoId = null)
    {
        $builder = $this->select('movimientos_stock.*, productos.nombre as producto_nombre, 
                                 productos.codigo as producto_codigo,
                                 usuarios.nombre_completo as usuario_nombre')
            ->join('productos', 'productos.id = movimientos_stock.producto_id', 'left')
            ->join('usuarios', 'usuarios.id = movimientos_stock.usuario_id', 'left')
            ->orderBy('movimientos_stock.fecha_movimiento', 'DESC');

        if ($productoId) {
            $builder->where('movimientos_stock.producto_id', $productoId);
        }

        return $builder->findAll();
    }

    public function registrarMovimiento(array $data): bool
    {
        $stockModel = new StockModel();
        $productoId = $data['producto_id'];
        $tipo       = $data['tipo_movimiento'];
        $cantidad   = (int) $data['cantidad'];
        $stockActual = $stockModel->getCantidad($productoId);

        $nuevoStock = $stockActual;

        switch ($tipo) {
            case 'entrada':
            case 'devolucion':
                $nuevoStock = $stockActual + $cantidad;
                break;
            case 'salida':
                if ($cantidad > $stockActual) {
                    return false;
                }
                $nuevoStock = $stockActual - $cantidad;
                break;
            case 'ajuste':
                $nuevoStock = $cantidad;
                break;
        }

        $this->insert($data);
        $stockModel->ajustarStock($productoId, $nuevoStock);

        return true;
    }
}
