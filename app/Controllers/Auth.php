<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\PermisoModel;
use Config\Database;

class Auth extends BaseController
{
    public function login()
    {
        if (session()->get('logged_in')) {
            return redirect()->to(base_url('dashboard'));
        }

        return view('auth/login');
    }

    public function authenticate()
    {
        $rules = [
            'email'    => 'required|valid_email',
            'password' => 'required',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $userModel = new UserModel();
        $email    = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $user = $userModel->verifyPassword($email, $password);

        if ($user) {
            if (!$user['activo']) {
                return redirect()->back()->with('error', 'Tu cuenta está desactivada.');
            }

            // Load permissions
            $db = Database::connect();
            $permisos = $db->table('role_permiso rp')
                ->select('p.nombre')
                ->join('permisos p', 'p.id = rp.permiso_id')
                ->where('rp.role_id', $user['role_id'])
                ->get()
                ->getResultArray();

            $permisoNames = array_column($permisos, 'nombre');

            // Load role name
            $roleName = $db->table('roles')->where('id', $user['role_id'])->get()->getRowArray();

            session()->set([
                'user_id'        => $user['id'],
                'user_name'      => $user['nombre_completo'],
                'user_email'     => $user['email'],
                'role_id'        => $user['role_id'],
                'role_name'      => $roleName['nombre'] ?? '',
                'permisos'       => $permisoNames,
                'logged_in'      => true,
            ]);

            return redirect()->to(base_url('dashboard'));
        }

        return redirect()->back()->withInput()->with('error', 'Credenciales incorrectas.');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to(base_url('login'));
    }
}
