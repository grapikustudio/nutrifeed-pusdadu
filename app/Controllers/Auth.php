<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AuthModel;

class Auth extends BaseController
{
    public function __construct()
    {
        $this->authModel = new AuthModel();
        $this->session = session();
    }
    public function login()
    {
        $data = [
            'title' => 'Login'
        ];
        return view('auth/login', $data);
    }
    public function logout()
    {
        $this->session->destroy();
        return redirect()->to('/');
    }
    public function register()
    {
        $data = [
            'title' => 'Register'
        ];
        return view('auth/register', $data);
    }
    public function doRegister()
    {
        $data = $this->request->getVar();
        $salt = uniqid('', true);
        $password = md5($data['pass']) . $salt;
        $this->authModel->save([
            'email' => $data['email'],
            'pass' => $password,
            'name' => $data['name'],
            'status' => 0,
            'salt' => $salt,
            'role' => 4
        ]);
        session()->setFlashdata('login', 'Anda berhasil mendaftar, silahkan login');
        return redirect()->to('/login');
    }
    public function doLogin()
    {
        $data = $this->request->getVar();
        $user = $this->authModel->where('email', $data['email'])->first();
        if ($user) {
            if ($user['pass'] != md5($data['pass']) . $user['salt']) {
                session()->setFlashdata('error', 'Password salah');
                return redirect()->to('/');
            } else {
                if (!$user['status']) {
                    session()->setFlashdata('error', 'User Belum di Aktivasi, Silahkan Hubungi Admin');
                    return redirect()->to('/');
                } else {
                    $sessLogin = [
                        'isLogin' => true,
                        'id' => $user['id'],
                        'email' => $user['email'],
                        'name' => $user['name'],
                        'role' => $user['role']
                    ];
                    $this->session->set($sessLogin);
                    if ($this->session->get('role') == 4) {
                        return redirect()->to('/link');
                    } else {
                        return redirect()->to('/welcome');
                    }
                }
            }
        } else {
            session()->setFlashdata('error', 'Username tidak ditemukan');
            return redirect()->to('/');
        }
    }
}
