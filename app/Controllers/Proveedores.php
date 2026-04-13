<?php

namespace App\Controllers;

use App\Models\ProveedorModel;

class Proveedores extends BaseController
{
    public function index()
    {
        $model = new ProveedorModel();
        $data = [
            'title'       => 'Proveedores',
            'proveedores' => $model->findAll(),
        ];

        return view('proveedores/index', $data);
    }

    public function create()
    {
        return view('proveedores/create', ['title' => 'Crear Proveedor']);
    }

    public function store()
    {
        $model = new ProveedorModel();

        $rules = [
            'nombre'   => 'required|min_length[2]|max_length[100]',
            'ruc'      => 'permit_empty|is_unique[proveedores.ruc]|max_length[20]',
            'telefono' => 'permit_empty|max_length[20]',
            'email'    => 'permit_empty|valid_email|max_length[100]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $model->insert([
            'nombre'    => $this->request->getPost('nombre'),
            'ruc'       => $this->request->getPost('ruc'),
            'direccion' => $this->request->getPost('direccion'),
            'telefono'  => $this->request->getPost('telefono'),
            'email'     => $this->request->getPost('email'),
            'contacto'  => $this->request->getPost('contacto'),
            'activo'    => 1,
        ]);

        return redirect()->to(base_url('proveedores'))->with('success', 'Proveedor creado correctamente.');
    }

    public function edit(int $id)
    {
        $model = new ProveedorModel();
        $proveedor = $model->find($id);

        if (!$proveedor) {
            return redirect()->to(base_url('proveedores'))->with('error', 'Proveedor no encontrado.');
        }

        return view('proveedores/edit', ['title' => 'Editar Proveedor', 'proveedor' => $proveedor]);
    }

    public function update(int $id)
    {
        $model = new ProveedorModel();

        $rules = [
            'nombre'   => 'required|min_length[2]|max_length[100]',
            'ruc'      => 'permit_empty|is_unique[proveedores.ruc,id,' . $id . ']|max_length[20]',
            'telefono' => 'permit_empty|max_length[20]',
            'email'    => 'permit_empty|valid_email|max_length[100]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $model->update($id, [
            'nombre'    => $this->request->getPost('nombre'),
            'ruc'       => $this->request->getPost('ruc'),
            'direccion' => $this->request->getPost('direccion'),
            'telefono'  => $this->request->getPost('telefono'),
            'email'     => $this->request->getPost('email'),
            'contacto'  => $this->request->getPost('contacto'),
        ]);

        return redirect()->to(base_url('proveedores'))->with('success', 'Proveedor actualizado correctamente.');
    }

    public function delete(int $id)
    {
        $model = new ProveedorModel();
        $model->delete($id);
        return redirect()->to(base_url('proveedores'))->with('success', 'Proveedor eliminado correctamente.');
    }

    public function toggleActivo(int $id)
    {
        $model = new ProveedorModel();
        $prov = $model->find($id);
        if ($prov) {
            $model->update($id, ['activo' => !$prov['activo']]);
        }
        return redirect()->to(base_url('proveedores'))->with('success', 'Estado del proveedor actualizado.');
    }
}
