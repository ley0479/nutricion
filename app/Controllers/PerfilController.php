<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\UserModel;

class PerfilController extends Controller
{
    protected $usuario;

    public function __construct()
    {
        $this->usuario = new UserModel;
    }

    public function perfil()
    {
        $session = session();

        if (empty($session->get('logged_in'))) {
            return redirect()->to(base_url('/login'));
        } else {

            $user = $this->usuario->find($session->get('id'));

            echo view('layout/admin/header');
            echo view('layout/admin/navbar');
            echo view('layout/admin/sidebar');
            echo view('layout/perfil/perfil', ['user' => $user]);
            echo view('layout/admin/footer');
        }
    }

    public function actualizarPerfil()
    {
        $session = session();
        $userId = $session->get('id');

        $data = [
            'nombre' => $this->request->getPost('nombre'),
            'apellidos' => $this->request->getPost('apellidos'),
            'email' => $this->request->getPost('email'),
            'password' => $this->request->getPost('password'),
            'edad' => $this->request->getPost('edad'),
            'peso' => $this->request->getPost('peso'),
            'altura' => $this->request->getPost('altura'),
            'genero' => $this->request->getPost('genero'),
            'nivel_actividad' => $this->request->getPost('nivel_actividad'),
            'objetivo_salud' => $this->request->getPost('objetivo_salud'),
            'calorias_diarias' => $this->request->getPost('calorias_diarias'),
            'carbohidratos_diarios' => $this->request->getPost('carbohidratos_diarios'),
            'proteinas_diarias' => $this->request->getPost('proteinas_diarias'),
            'grasas_diarias' => $this->request->getPost('grasas_diarias'),
            'condiciones_medicas' => $this->request->getPost('condiciones_medicas'),
            'alergias' => $this->request->getPost('alergias'),
            'intolerancias' => $this->request->getPost('intolerancias'),
            'tipo_dieta' => $this->request->getPost('tipo_dieta'),
            'otro_condicion' => $this->request->getPost('otro_condicion'),
            'otro_alergia' => $this->request->getPost('otro_alergia'),
            'otra_intolerancia' => $this->request->getPost('otra_intolerancia'),
            'otra_dieta' => $this->request->getPost('otra_dieta'),

        ];

        // Verificar si se ha actualizado la contraseña
        if (!empty($data['password'])) {
            $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        } else {
            unset($data['password']);
        }
        // Si el objetivo de salud es "otro", guarda la descripción adicional
        if ($this->request->getPost('objetivo_salud') === 'otro') {
            $data['otro_objetivo'] = $this->request->getPost('otro_objetivo');
        } else {
            $data['otro_objetivo'] = NULL; // Limpia el campo si no es "otro"
        }
        // Manejo de condiciones médicas
        $condiciones_medicas = $this->request->getPost('condiciones_medicas');
        if ($condiciones_medicas === 'otro') {
            $data['otro_condicion'] = $this->request->getPost('otro_condicion');
        } else {
            $data['otro_condicion'] = NULL;
        }

        // Manejo de alergias
        $alergias = $this->request->getPost('alergias');
        if ($alergias === 'otro') {
            $data['otro_alergia'] = $this->request->getPost('otro_alergia');
        } else {
            $data['otro_alergia'] = NULL;
        }

        // Manejo de intolerancias
        $intolerancias = $this->request->getPost('intolerancias');
        if ($intolerancias === 'otro') {
            $data['otra_intolerancia'] = $this->request->getPost('otra_intolerancia');
        } else {
            $data['otra_intolerancia'] = NULL;
        }

        // Manejo de tipo de dieta
        $tipo_dieta = $this->request->getPost('tipo_dieta');
        if ($tipo_dieta === 'otro') {
            $data['otra_dieta'] = $this->request->getPost('otra_dieta');
        } else {
            $data['otra_dieta'] = NULL;
        }

        $this->usuario->update($userId, $data);

        return redirect()->to(base_url('/perfil'))->with('message', 'Perfil actualizado con éxito.');
    }
}
