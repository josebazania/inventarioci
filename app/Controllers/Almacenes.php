<?php

namespace App\Controllers;

use App\Models\AlmacenModel;

class Almacenes extends BaseController
{
    public function index()
    {
        $model = new AlmacenModel();
        $data = [
            'title'     => 'Almacenes',
            'almacenes' => $model->findAll(),
        ];

        return view('almacenes/index', $data);
    }

    public function create()
    {
        return view('almacenes/create', ['title' => 'Crear Almacén']);
    }

    public function store()
    {
        $model = new AlmacenModel();

        $rules = [
            'nombre' => 'required|min_length[2]|max_length[100]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $model->insert([
            'nombre'     => $this->request->getPost('nombre'),
            'ubicacion'  => $this->request->getPost('ubicacion'),
            'descripcion' => $this->request->getPost('descripcion'),
            'activo'     => 1,
        ]);

        return redirect()->to(base_url('almacenes'))->with('success', 'Almacén creado correctamente.');
    }

    public function edit(int $id)
    {
        $model = new AlmacenModel();
        $almacen = $model->find($id);

        if (!$almacen) {
            return redirect()->to(base_url('almacenes'))->with('error', 'Almacén no encontrado.');
        }

        return view('almacenes/edit', ['title' => 'Editar Almacén', 'almacen' => $almacen]);
    }

    public function update(int $id)
    {
        $model = new AlmacenModel();

        $rules = [
            'nombre' => 'required|min_length[2]|max_length[100]|is_unique[almacenes.nombre,id,' . $id . ']',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $model->update($id, [
            'nombre'     => $this->request->getPost('nombre'),
            'ubicacion'  => $this->request->getPost('ubicacion'),
            'descripcion' => $this->request->getPost('descripcion'),
        ]);

        return redirect()->to(base_url('almacenes'))->with('success', 'Almacén actualizado correctamente.');
    }

    public function delete(int $id)
    {
        $model = new AlmacenModel();
        $model->delete($id);
        return redirect()->to(base_url('almacenes'))->with('success', 'Almacén eliminado correctamente.');
    }

    public function toggleActivo(int $id)
    {
        $model = new AlmacenModel();
        $alm = $model->find($id);
        if ($alm) {
            $model->update($id, ['activo' => !$alm['activo']]);
        }
        return redirect()->to(base_url('almacenes'))->with('success', 'Estado del almacén actualizado.');
    }
}
