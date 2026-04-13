<?php

namespace App\Models;

use CodeIgniter\Model;

class StockModel extends Model
{
    protected $table            = 'stocks';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $allowedFields    = ['producto_id', 'cantidad'];
    protected $useTimestamps    = true;
    protected $dateFormat       = 'datetime';
    protected $createdField     = 'created_at';
    protected $updatedField     = 'updated_at';

    public function getCantidad(int $productoId): int
    {
        $stock = $this->where('producto_id', $productoId)->first();
        return $stock ? (int) $stock['cantidad'] : 0;
    }

    public function ajustarStock(int $productoId, int $cantidad): bool
    {
        $stock = $this->where('producto_id', $productoId)->first();

        if ($stock) {
            return $this->update($stock['id'], ['cantidad' => $cantidad]);
        }

        return $this->insert(['producto_id' => $productoId, 'cantidad' => $cantidad]) !== false;
    }

    public function getStockBajo()
    {
        return $this->db->table('productos p')
            ->select('p.id, p.codigo, p.nombre, c.nombre as categoria_nombre, 
                      s.cantidad as stock_actual, p.stock_minimo,
                      (p.stock_minimo - s.cantidad) as cantidad_faltante')
            ->join('stocks s', 's.producto_id = p.id', 'left')
            ->join('categorias c', 'c.id = p.categoria_id', 'left')
            ->where('p.activo', 1)
            ->where('s.cantidad <= p.stock_minimo')
            ->get()
            ->getResultArray();
    }
}
