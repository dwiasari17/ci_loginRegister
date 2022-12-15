<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Controller;

class SignupController extends Controller
{
    public function index()
    {
        helper(['form']);
        $data = [];
        echo view('signup', $data);
    }

    public function store()
    {
        helper(['form']);
        $rules = [
            'username'          => 'required|min_length[4]|max_length[100]|is_unique[users.username]',
            'name'              => 'required|min_length[2]|max_length[100]',
            'email'             => 'required|min_length[4]|max_length[100]|valid_email|is_unique[users.email]',
            'password'          => 'required|min_length[2]|max_length[50]',
            'confirmpassword'   => 'matches[password]',
        ];

        if ($this->validate($rules)) {
            $userModel = new UserModel();
            $data = [
                'username'  => $this->request->getVar('username'),
                'name'      => $this->request->getVar('name'),
                'email'     => $this->request->getVar('email'),
                'password'  => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
            ];
            $userModel->save($data);
            return redirect()->to('/signin');
        } else {
            $data['validation'] = $this->validator;
            echo view('signup', $data);
        }
    }
}
