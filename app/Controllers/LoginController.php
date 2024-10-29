<?php

namespace App\Controllers;
use App\Models\UserModel;

class LoginController extends BaseController
{
    protected $usuario;

    public function __construct()
    {
         $this->usuario = new UserModel;
        
    }
    public function index(): string
    {
        return view('layout/login/login');
    }
    
    public function authenticate()
    {
        $session = session();
        $email = $this->request->getVar('email');
        $password = $this->request->getVar('password');
        $user = $this->usuario->where('email', $email)->first();

        if ($user) {
            $pass = $user['password'];
            if (password_verify($password, $pass)) {
                $session->set([
                    'id'       => $user['id'],
                    'nombre'   => $user['nombre'],
                    'apellidos'   => $user['apellidos'],
                    'email'    => $user['email'],
                    'logged_in'=> TRUE
                ]);
                $session->setFlashdata('success', 'Iniciendo session');

                return redirect()->to(base_url('/dashboard'));
            } else {
                $session->setFlashdata('error', 'Contraseña incorrecta');
                return redirect()->to(base_url('/login'));
            }
        } else {
            $session->setFlashdata('error', 'Correo electrónico no registrado');
            return redirect()->to(base_url('/login'));
        }
    }
    public function logout(){
        $session = session();
        $session->destroy();
        return redirect()->to(base_url('/login'));
    }

}
