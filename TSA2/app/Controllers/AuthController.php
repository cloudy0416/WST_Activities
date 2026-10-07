<?php

namespace App\Controllers;

use App\Models\UserModel;

class AuthController extends BaseController
{
    public function login()
    {
        if (session()->get('isLoggedIn')) {
            return redirect()->to('/tasks');
        }
        return view('login', ['title' => 'Log In']);
    }

    public function attemptLogin()
    {
        $rules = [
            'username' => 'required|max_length[50]',
            'password' => 'required|max_length[255]',
        ];
        if (! $this->validate($rules)) {
            return redirect()->back()->with('errors', $this->validator->getErrors());
        }

        $user = (new UserModel())->findByUsername(trim((string) $this->request->getPost('username')));
        if (! $user || ! password_verify((string) $this->request->getPost('password'), $user['password'])) {
            return redirect()->back()->with('error', 'Invalid username or password.');
        }

        session()->regenerate();
        session()->set(['isLoggedIn' => true, 'userId' => $user['id'], 'username' => $user['username']]);
        return redirect()->to('/tasks')->with('success', 'You are now logged in.');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/')->with('success', 'You have been logged out.');
    }
}
