<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductoModel extends Model
{
    protected $table            = 'productos';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $allowedFields    = [
        'codigo', 'nombre', 'descripcion', 'categoria_id', 'marca_id',
        'proveedor_id', 'precio_compra', 'precio_venta', 'stock_minimo',
        'stock_maximo', 'imagen', 'activo',
    ];
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    protected $validationRules = [
        'codigo'         => 'required|min_length[2]|max_length[50]|is_unique[productos.codigo,id,{id}]',
        'nombre'         => 'required|min_length[2]|max_length[150]',
        'categoria_id'   => 'required|integer',
        'precio_compra'  => 'if_not_empty|decimal',
        'precio_venta'   => 'if_not_empty|decimal',
        'stock_minimo'   => 'if_not_empty|integer',
        'stock_maximo'   => 'if_not_empty|integer',
    ];

    public function getProductosConDetalles()
    {
        return $this->select('productos.*, categorias.nombre as categoria_nombre,
                             marcas.nombre as marca_nombre, proveedores.nombre as proveedor_nombre,
                             COALESCE(stocks.cantidad, 0) as stock_actual')
            ->join('categorias', 'categorias.id = productos.categoria_id', 'left')
            ->join('marcas', 'marcas.id = productos.marca_id', 'left')
            ->join('proveedores', 'proveedores.id = productos.proveedor_id', 'left')
            ->join('stocks', 'stocks.producto_id = productos.id', 'left')
            ->where('productos.activo', 1)
            ->findAll();
    }

    public function getAllProductosConDetalles()
    {
        return $this->getProductosConDetalles();
    }

    public function getProductoDetalle(int $id)
    {
        return $this->select('productos.*, categorias.nombre as categoria_nombre,
                             marcas.nombre as marca_nombre, proveedores.nombre as proveedor_nombre,
                             COALESCE(stocks.cantidad, 0) as stock_actual')
            ->join('categorias', 'categorias.id = productos.categoria_id', 'left')
            ->join('marcas', 'marcas.id = productos.marca_id', 'left')
            ->join('proveedores', 'proveedores.id = productos.proveedor_id', 'left')
            ->join('stocks', 'stocks.producto_id = productos.id', 'left')
            ->find($id);
    }

    protected function ensureStockExists(int $productoId)
    {
        $exists = $this->db->table('stocks')->where('producto_id', $productoId)->countAllResults();
        if ($exists === 0) {
            $this->db->table('stocks')->insert(['producto_id' => $productoId, 'cantidad' => 0]);
        }
    }

    protected function afterInsert(array $data)
    {
        if (isset($data['id'])) {
            $this->ensureStockExists($data['id']);
        }
        return $data;
    }
}
