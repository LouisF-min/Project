<?php

namespace App\Controllers;
use App\Models\UserModel;

class AuthController extends BaseController
{
    public function login()
    {
        return view('login'); 
    }

    public function prosesLogin()
    {
        $model = new UserModel();
        $user = $model->where('username', $this->request->getPost('username'))->first();

        if ($user && password_verify($this->request->getPost('password'), $user['password'])) {
            session()->set('user_id', $user['id']);
            return redirect()->to('/produk'); 
        } else {
            return redirect()->to('/login')->with('error', 'Login gagal');
        }
    }

    public function register()
    {
        return view('register'); 
    }

    public function prosesRegister()
    {
        $model = new UserModel();
        $data = [
            'username' => $this->request->getPost('username'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
        ];

        $model->save($data);
        return redirect()->to('/login')->with('success', 'Pendaftaran berhasil, silakan login.');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
}