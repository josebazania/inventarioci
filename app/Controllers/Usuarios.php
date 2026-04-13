<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\RoleModel;

class Usuarios extends BaseController
{
    public function index()
    {
        $userModel = new UserModel();
        $data = [
            'title'   => 'Usuarios',
            'usuarios' => $userModel->getUsersWithRole(),
        ];

        return view('usuarios/index', $data);
    }

    public function create()
    {
        $roleModel = new RoleModel();
        $data = [
            'title' => 'Crear Usuario',
            'roles' => $roleModel->findAll(),
        ];

        return view('usuarios/create', $data);
    }

    public function store()
    {
        $userModel = new UserModel();

        $rules = [
            'nombre_completo' => 'required|min_length[3]|max_length[100]',
            'email'           => 'required|valid_email|is_unique[usuarios.email]',
            'role_id'         => 'required|integer',
            'password'        => 'required|min_length[6]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $userModel->insert([
            'nombre_completo' => $this->request->getPost('nombre_completo'),
            'email'           => $this->request->getPost('email'),
            'role_id'         => $this->request->getPost('role_id'),
            'password'        => $this->request->getPost('password'),
        ]);

        return redirect()->to(base_url('usuarios'))->with('success', 'Usuario creado correctamente.');
    }

    public function edit(int $id)
    {
        $userModel = new UserModel();
        $roleModel = new RoleModel();

        $user = $userModel->find($id);
        if (!$user) {
            return redirect()->to(base_url('usuarios'))->with('error', 'Usuario no encontrado.');
        }

        $data = [
            'title' => 'Editar Usuario',
            'usuario' => $user,
            'roles' => $roleModel->findAll(),
        ];

        return view('usuarios/edit', $data);
    }

    public function update(int $id)
    {
        $userModel = new UserModel();

        $rules = [
            'nombre_completo' => 'required|min_length[3]|max_length[100]',
            'email'           => 'required|valid_email|is_unique[usuarios.email,id,' . $id . ']',
            'role_id'         => 'required|integer',
        ];

        if ($this->request->getPost('password')) {
            $rules['password'] = 'min_length[6]';
        }

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'nombre_completo' => $this->request->getPost('nombre_completo'),
            'email'           => $this->request->getPost('email'),
            'role_id'         => $this->request->getPost('role_id'),
        ];

        if ($this->request->getPost('password')) {
            $data['password'] = $this->request->getPost('password');
        }

        $userModel->update($id, $data);

        return redirect()->to(base_url('usuarios'))->with('success', 'Usuario actualizado correctamente.');
    }

    public function delete(int $id)
    {
        $userModel = new UserModel();
        $userModel->delete($id);

        return redirect()->to(base_url('usuarios'))->with('success', 'Usuario eliminado correctamente.');
    }

    public function toggleActivo(int $id)
    {
        $userModel = new UserModel();
        $user = $userModel->find($id);

        if ($user) {
            $userModel->update($id, ['activo' => !$user['activo']]);
        }

        return redirect()->to(base_url('usuarios'))->with('success', 'Estado del usuario actualizado.');
    }
}
