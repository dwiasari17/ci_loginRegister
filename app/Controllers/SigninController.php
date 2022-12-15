<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Controller;

class SigninController extends Controller
{
    public function index()
    {
        helper(['form']);
        echo view('signin');
    }

    public function loginAuth()
    {
        $session = session();
        $userModel = new UserModel();
        $email = $this->request->getVar('username');
        $password = $this->request->getVar('password');

        $data = $userModel->where('username', $email)->first();

        if ($data) {
            $pass = $data['password'];
            $authenticatePassword = password_verify($password, $pass);
            if ($authenticatePassword) {
                $ses_data = [
                    //'id' => $data['id'],
                    'username' => $data['username'],
                    'name' => $data['name'],
                    'email' => $data['email'],
                    'isLoggedIn' => TRUE
                ];
                $session->set($ses_data);
                return redirect()->to('/home');
            } else {
                $session->setFlashdata('msg', 'Password is incorrect');
                return redirect()->to('/signin');
            }
        } else {
            $session->setFlashdata('msg', 'Username does not exist');
            return redirect()->to('/signin');
        }
    }

    public function logout()
    {
        $session = session();
        $session->destroy();
        return redirect()->to('/signin');
    }
}