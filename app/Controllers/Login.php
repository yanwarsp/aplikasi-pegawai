<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UsersModel;

class Login extends BaseController
{
    public function index()
    {
        $data = [
            'validation' => \Config\Services::validation()
        ];
        echo view("login_view", $data);
    }

    public function logout()
    {
        session()->destroy();
        session()->setFlashdata("error", "ada berhasil logout");
        return redirect()->to(base_url('login'));
    }

    public function submitLogin()
    {
        if (!$this->validate([
            'username' => 'required',
            'password' => 'required',

        ])) {
            $validation = \Config\Services::validation();
            return redirect()->to(base_url('login'))->withInput()->with('validation', $validation);
        }


        $model = new UsersModel();
        $username = $this->request->getVar('username');
        $password = $this->request->getVar('password');

        $data = $model->where('username', $username)->first();

        if ($data) {
            if (password_verify($password, $data['password'])) {
                session()->set([
                    'namadepan' => $data['namadepan'],
                    'namabelakang' => $data['namabelakang'],
                    'logged_in' => true,
                ]);
                return redirect()->to(base_url('dashboard'));
            } else {
                session()->setFlashdata("error", "Username dan password salah");
                return redirect()->back();
            }
        } else {
            session()->setFlashdata("error", "Username dan password salah");
            return redirect()->back();
        }
    }
}
