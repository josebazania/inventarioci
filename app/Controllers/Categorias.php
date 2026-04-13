<?php

namespace App\Controllers;

use App\Models\CategoriaModel;

class Categorias extends BaseController
{
    public function index()
    {
        $model = new CategoriaModel();
        $data = [
            'title'      => 'Categorías',
            'categorias' => $model->findAll(),
        ];

        return view('categorias/index', $data);
    }

    public function create()
    {
        return view('categorias/create', ['title' => 'Crear Categoría']);
    }

    public function store()
    {
        $model = new CategoriaModel();

        $rules = [
            'nombre'      => 'required|min_length[2]|max_length[100]',
            'descripcion' => 'permit_empty|max_length[500]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $model->insert([
            'nombre'      => $this->request->getPost('nombre'),
            'descripcion' => $this->request->getPost('descripcion'),
            'activo'      => 1,
        ]);

        return redirect()->to(base_url('categorias'))->with('success', 'Categoría creada correctamente.');
    }

    public function edit(int $id)
    {
        $model = new CategoriaModel();
        $categoria = $model->find($id);

        if (!$categoria) {
            return redirect()->to(base_url('categorias'))->with('error', 'Categoría no encontrada.');
        }

        return view('categorias/edit', ['title' => 'Editar Categoría', 'categoria' => $categoria]);
    }

    public function update(int $id)
    {
        $model = new CategoriaModel();

        $rules = [
            'nombre'      => 'required|min_length[2]|max_length[100]|is_unique[categorias.nombre,id,' . $id . ']',
            'descripcion' => 'permit_empty|max_length[500]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $model->update($id, [
            'nombre'      => $this->request->getPost('nombre'),
            'descripcion' => $this->request->getPost('descripcion'),
        ]);

        return redirect()->to(base_url('categorias'))->with('success', 'Categoría actualizada correctamente.');
    }

    public function delete(int $id)
    {
        $model = new CategoriaModel();
        $model->delete($id);

        return redirect()->to(base_url('categorias'))->with('success', 'Categoría eliminada correctamente.');
    }

    public function toggleActivo(int $id)
    {
        $model = new CategoriaModel();
        $cat = $model->find($id);
        if ($cat) {
            $model->update($id, ['activo' => !$cat['activo']]);
        }

        return redirect()->to(base_url('categorias'))->with('success', 'Estado de la categoría actualizado.');
    }
}
