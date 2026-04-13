<?php

namespace App\Controllers;

use App\Models\MarcaModel;

class Marcas extends BaseController
{
    public function index()
    {
        $model = new MarcaModel();
        $data = [
            'title'  => 'Marcas',
            'marcas' => $model->findAll(),
        ];

        return view('marcas/index', $data);
    }

    public function create()
    {
        return view('marcas/create', ['title' => 'Crear Marca']);
    }

    public function store()
    {
        $model = new MarcaModel();

        $rules = ['nombre' => 'required|min_length[2]|max_length[100]'];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $model->insert(['nombre' => $this->request->getPost('nombre'), 'activo' => 1]);

        return redirect()->to(base_url('marcas'))->with('success', 'Marca creada correctamente.');
    }

    public function edit(int $id)
    {
        $model = new MarcaModel();
        $marca = $model->find($id);

        if (!$marca) {
            return redirect()->to(base_url('marcas'))->with('error', 'Marca no encontrada.');
        }

        return view('marcas/edit', ['title' => 'Editar Marca', 'marca' => $marca]);
    }

    public function update(int $id)
    {
        $model = new MarcaModel();

        $rules = ['nombre' => 'required|min_length[2]|max_length[100]|is_unique[marcas.nombre,id,' . $id . ']'];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $model->update($id, ['nombre' => $this->request->getPost('nombre')]);

        return redirect()->to(base_url('marcas'))->with('success', 'Marca actualizada correctamente.');
    }

    public function delete(int $id)
    {
        $model = new MarcaModel();
        $model->delete($id);
        return redirect()->to(base_url('marcas'))->with('success', 'Marca eliminada correctamente.');
    }

    public function toggleActivo(int $id)
    {
        $model = new MarcaModel();
        $marca = $model->find($id);
        if ($marca) {
            $model->update($id, ['activo' => !$marca['activo']]);
        }
        return redirect()->to(base_url('marcas'))->with('success', 'Estado de la marca actualizado.');
    }
}
