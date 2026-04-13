<?php

namespace App\Controllers;

use App\Models\ProductoModel;
use App\Models\CategoriaModel;
use App\Models\MarcaModel;
use App\Models\ProveedorModel;

class Productos extends BaseController
{
    public function index()
    {
        $model = new ProductoModel();
        $perPage = 10;

        // Build the query
        $builder = $model->select('productos.*, categorias.nombre as categoria_nombre,
                             marcas.nombre as marca_nombre, proveedores.nombre as proveedor_nombre,
                             stocks.cantidad as stock_actual')
            ->join('categorias', 'categorias.id = productos.categoria_id', 'left')
            ->join('marcas', 'marcas.id = productos.marca_id', 'left')
            ->join('proveedores', 'proveedores.id = productos.proveedor_id', 'left')
            ->join('stocks', 'stocks.producto_id = productos.id', 'left');

        $data = [
            'title'      => 'Productos',
            'productos'  => $builder->paginate($perPage),
            'pager'      => $model->pager,
        ];

        return view('productos/index', $data);
    }

    public function create()
    {
        $catModel = new CategoriaModel();
        $marcaModel = new MarcaModel();
        $provModel = new ProveedorModel();

        $data = [
            'title'       => 'Crear Producto',
            'categorias'  => $catModel->where('activo', 1)->findAll(),
            'marcas'      => $marcaModel->where('activo', 1)->findAll(),
            'proveedores' => $provModel->where('activo', 1)->findAll(),
        ];

        return view('productos/create', $data);
    }

    public function store()
    {
        $model = new ProductoModel();

        $rules = [
            'codigo'        => 'required|min_length[2]|max_length[50]',
            'nombre'        => 'required|min_length[2]|max_length[150]',
            'categoria_id'  => 'required|integer',
            'precio_compra' => 'if_not_empty|decimal',
            'precio_venta'  => 'if_not_empty|decimal',
            'stock_minimo'  => 'if_not_empty|integer',
            'stock_maximo'  => 'if_not_empty|integer',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $imageData = $this->uploadImage();

        $model->insert([
            'codigo'        => $this->request->getPost('codigo'),
            'nombre'        => $this->request->getPost('nombre'),
            'descripcion'   => $this->request->getPost('descripcion'),
            'categoria_id'  => $this->request->getPost('categoria_id'),
            'marca_id'      => $this->request->getPost('marca_id') ?: null,
            'proveedor_id'  => $this->request->getPost('proveedor_id') ?: null,
            'precio_compra' => $this->request->getPost('precio_compra') ?: 0,
            'precio_venta'  => $this->request->getPost('precio_venta') ?: 0,
            'stock_minimo'  => $this->request->getPost('stock_minimo') ?: 0,
            'stock_maximo'  => $this->request->getPost('stock_maximo') ?: 0,
            'imagen'        => $imageData,
            'activo'        => 1,
        ]);

        return redirect()->to(base_url('productos'))->with('success', 'Producto creado correctamente.');
    }

    public function edit(int $id)
    {
        $model = new ProductoModel();
        $producto = $model->find($id);

        if (!$producto) {
            return redirect()->to(base_url('productos'))->with('error', 'Producto no encontrado.');
        }

        $catModel = new CategoriaModel();
        $marcaModel = new MarcaModel();
        $provModel = new ProveedorModel();

        $data = [
            'title'       => 'Editar Producto',
            'producto'    => $producto,
            'categorias'  => $catModel->where('activo', 1)->findAll(),
            'marcas'      => $marcaModel->where('activo', 1)->findAll(),
            'proveedores' => $provModel->where('activo', 1)->findAll(),
        ];

        return view('productos/edit', $data);
    }

    public function update(int $id)
    {
        $model = new ProductoModel();

        $rules = [
            'codigo'        => 'required|min_length[2]|max_length[50]|is_unique[productos.codigo,id,' . $id . ']',
            'nombre'        => 'required|min_length[2]|max_length[150]',
            'categoria_id'  => 'required|integer',
            'precio_compra' => 'if_not_empty|decimal',
            'precio_venta'  => 'if_not_empty|decimal',
            'stock_minimo'  => 'if_not_empty|integer',
            'stock_maximo'  => 'if_not_empty|integer',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $producto = $model->find($id);
        $imageData = $this->uploadImage();

        $updateData = [
            'codigo'        => $this->request->getPost('codigo'),
            'nombre'        => $this->request->getPost('nombre'),
            'descripcion'   => $this->request->getPost('descripcion'),
            'categoria_id'  => $this->request->getPost('categoria_id'),
            'marca_id'      => $this->request->getPost('marca_id') ?: null,
            'proveedor_id'  => $this->request->getPost('proveedor_id') ?: null,
            'precio_compra' => $this->request->getPost('precio_compra') ?: 0,
            'precio_venta'  => $this->request->getPost('precio_venta') ?: 0,
            'stock_minimo'  => $this->request->getPost('stock_minimo') ?: 0,
            'stock_maximo'  => $this->request->getPost('stock_maximo') ?: 0,
        ];

        if ($imageData) {
            $updateData['imagen'] = $imageData;
        }

        $model->update($id, $updateData);

        return redirect()->to(base_url('productos'))->with('success', 'Producto actualizado correctamente.');
    }

    public function delete(int $id)
    {
        $model = new ProductoModel();
        $producto = $model->find($id);

        if ($producto && $producto['imagen']) {
            $filePath = FCPATH . 'uploads/productos/' . $producto['imagen'];
            if (file_exists($filePath)) {
                unlink($filePath);
            }
        }

        $model->delete($id);
        return redirect()->to(base_url('productos'))->with('success', 'Producto eliminado correctamente.');
    }

    public function toggleActivo(int $id)
    {
        $model = new ProductoModel();
        $prod = $model->find($id);
        if ($prod) {
            $model->update($id, ['activo' => !$prod['activo']]);
        }
        return redirect()->to(base_url('productos'))->with('success', 'Estado del producto actualizado.');
    }

    public function detail(int $id)
    {
        $model = new ProductoModel();
        $producto = $model->getProductoDetalle($id);

        if (!$producto) {
            return redirect()->to(base_url('productos'))->with('error', 'Producto no encontrado.');
        }

        $movModel = new \App\Models\MovimientoStockModel();

        $data = [
            'title'      => 'Detalle del Producto',
            'producto'   => $producto,
            'movimientos' => $movModel->getMovimientosConDetalles($id),
        ];

        return view('productos/detail', $data);
    }

    private function uploadImage()
    {
        $file = $this->request->getFile('imagen');

        if (!$file || !$file->isValid()) {
            return null;
        }

        $uploadPath = FCPATH . 'uploads/productos';

        if (!is_dir($uploadPath)) {
            mkdir($uploadPath, 0777, true);
        }

        $newName = $file->getRandomName();
        $file->move($uploadPath, $newName);

        return $newName;
    }
}
