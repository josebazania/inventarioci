<?php

namespace App\Controllers;

use App\Models\RoleModel;
use App\Models\PermisoModel;

class Roles extends BaseController
{
    public function index()
    {
        $roleModel = new RoleModel();
        $data = [
            'title' => 'Roles',
            'roles' => $roleModel->findAll(),
        ];

        return view('roles/index', $data);
    }

    public function create()
    {
        $data = ['title' => 'Crear Rol'];
        return view('roles/create', $data);
    }

    public function store()
    {
        $roleModel = new RoleModel();

        $rules = [
            'nombre'      => 'required|min_length[2]|max_length[50]',
            'descripcion' => 'permit_empty|max_length[500]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $roleModel->insert([
            'nombre'      => $this->request->getPost('nombre'),
            'descripcion' => $this->request->getPost('descripcion'),
        ]);

        return redirect()->to(base_url('roles'))->with('success', 'Rol creado correctamente.');
    }

    public function edit(int $id)
    {
        $roleModel   = new RoleModel();
        $permisoModel = new PermisoModel();

        $role = $roleModel->getRoleWithPermissions($id);
        if (!$role) {
            return redirect()->to(base_url('roles'))->with('error', 'Rol no encontrado.');
        }

        $data = [
            'title'        => 'Editar Rol',
            'role'         => $role,
            'permisos'     => $permisoModel->getPermisosAgrupados(),
            'permisos_asignados' => array_column($role['permisos'], 'id'),
        ];

        return view('roles/edit', $data);
    }

    public function update(int $id)
    {
        $roleModel = new RoleModel();

        $rules = [
            'nombre'      => 'required|min_length[2]|max_length[50]|is_unique[roles.nombre,id,' . $id . ']',
            'descripcion' => 'permit_empty|max_length[500]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $roleModel->update($id, [
            'nombre'      => $this->request->getPost('nombre'),
            'descripcion' => $this->request->getPost('descripcion'),
        ]);

        $permisos = $this->request->getPost('permisos') ?? [];
        $roleModel->syncPermissions($id, $permisos);

        return redirect()->to(base_url('roles'))->with('success', 'Rol actualizado correctamente.');
    }

    public function delete(int $id)
    {
        $roleModel = new RoleModel();
        $roleModel->delete($id);

        return redirect()->to(base_url('roles'))->with('success', 'Rol eliminado correctamente.');
    }
}
