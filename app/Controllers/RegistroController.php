<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Controller;

class RegistroController extends Controller
{
    protected $usuario;

    public function __construct()
    {
        $this->usuario = new UserModel;
    }
    public function registro()
    {
            helper(['form']);
            echo view('layout/login/register');
        
    }

    public function guardarRegistro()
    {
        helper(['form', 'url']);

        // Validación de los datos del formulario
        $validationRules = [
            'name' => [
                'label' => 'Nombre',
                'rules' => 'required|min_length[2]',
                'errors' => [
                    'required' => 'El campo {field} es obligatorio.',
                    'min_length' => 'El {field} debe tener al menos {param} caracteres.',
                ]
            ],
            'apellidos' => [
                'label' => 'Apellidos',
                'rules' => 'required|min_length[2]',
                'errors' => [
                    'required' => 'El campo {field} es obligatorio.',
                    'min_length' => 'Los {field} deben tener al menos {param} caracteres.',
                ]
            ],
            'email' => [
                'label' => 'Correo electrónico',
                'rules' => 'required|valid_email|is_unique[usuarios.email]',
                'errors' => [
                    'required' => 'El {field} es obligatorio.',
                    'valid_email' => 'El {field} debe ser un correo válido.',
                    'is_unique' => 'El {field} ya está registrado.',
                ]
            ],
            'password' => [
                'label' => 'Contraseña',
                'rules' => 'required|min_length[6]',
                'errors' => [
                    'required' => 'La {field} es obligatoria.',
                    'min_length' => 'La {field} debe tener al menos {param} caracteres.',
                ]
            ],
            'password_confirmation' => [
                'label' => 'Confirmación de contraseña',
                'rules' => 'matches[password]',
                'errors' => [
                    'matches' => 'La {field} debe coincidir con la contraseña.',
                ]
            ]
        ];

        // Validar los datos del formulario
        if (!$this->validate($validationRules)) {
            // Recopilar los errores y almacenarlos como mensaje flash
            session()->setFlashdata('errors', $this->validator->getErrors());
            // Redirigir de vuelta a la página de registro con datos previos
            return redirect()->to(base_url('/registro'))->withInput();
        }

        // Guardar el usuario en la base de datos
        $this->usuario->save([
            'nombre' => $this->request->getPost('name'),
            'apellidos' => $this->request->getPost('apellidos'),
            'email' => $this->request->getPost('email'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
        ]);

        // Establecer mensaje flash de éxito
        session()->setFlashdata('success', 'Registro exitoso. Puedes iniciar sesión ahora.');

        // Redirigir al login
        return redirect()->to(base_url('/login'));
    }
}