<?php

namespace App\Controllers;

use App\Models\ProgresoModel;
use CodeIgniter\Controller;
use App\Models\UserModel;

class SeguimientoController extends Controller
{
    protected $salud, $usuario;

    public function __construct()
    {
        // Cargar el modelo UserModel
        $this->salud = new ProgresoModel();
        $this->usuario = new UserModel;
    }
    // Mostrar el formulario de registro de progreso
    public function seguimiento()
    {
        helper(['form']); // Cargar el helper de formularios
        echo view('layout/admin/header');
        echo view('layout/admin/navbar');
        echo view('layout/admin/sidebar');
        echo view('layout/seguimiento/registro');
        echo view('layout/admin/footer');
    }

    // Procesar el formulario de registro de progreso
    public function guardar()
    {
        // Cargar helper de formularios y validación
        helper(['form']);
        // $validation = \Config\Services::validation();
        $session = session();

        // Definir reglas de validación
        $rules = [
            'peso' => 'required|decimal',
            'grasa_corporal' => 'required|decimal',
            'masa_muscular' => 'required|decimal'
        ];

        // Verificar si los datos son válidos
        if ($this->validate($rules)) {
            // Obtener los datos del formulario
            $data = [
                'user_id' => session()->get('id'), // Asumiendo que el ID del usuario está en sesión
                'peso' => $this->request->getPost('peso'),
                'grasa_corporal' => $this->request->getPost('grasa_corporal'),
                'masa_muscular' => $this->request->getPost('masa_muscular'),
                'fecha_registro' => date('Y-m-d H:i:s')
            ];

            // Insertar los datos en la base de datos
            $this->salud->guardarProgreso($data);

            $session->setFlashdata('success', 'Registro guardado exitosamente.');
            return redirect()->to(base_url('/seguimiento')); // Redirigir a la página de
        } else {
            // Si los datos no son válidos, mostrar el formulario nuevamente con errores
            $session->setFlashdata('errors', 'Datos incorrectos, recuerda que los campos deben ser números decimales.');
            return redirect()->to(base_url('/seguimiento')); // Redirigir a la página de

        }
    }
    public function progreso()
    {
        $session = session();

        if (empty($session->get('logged_in'))) {
            return redirect()->to(base_url('/login'));
        } else {

            $userId = $session->get('id');

            // Obtener la fecha actual
            $hoy = date('Y-m-d');

            // Obtener la fecha de hace 30 días
            $fecha_inicio = date('Y-m-d', strtotime('-30 days', strtotime($hoy)));

            // Obtener todos los registros para la tabla
            $datosProgresoRestantes = $this->salud->getProgresoRestantes($userId, $fecha_inicio, $hoy);

            // Filtrar los últimos 30 registros (si hay más de 30)
            $datosProgresoUltimos30 = array_slice($datosProgresoRestantes, 0, 30);

            // Procesar datos para la gráfica
            $fechas = [];
            $pesos = [];
            foreach ($datosProgresoUltimos30 as $dato) {
                $fechas[] = $dato['fecha_registro'];
                $pesos[] = $dato['peso'];
            }

            // Mostrar vista
            echo view('layout/admin/header');
            echo view('layout/admin/navbar');
            echo view('layout/admin/sidebar');
            echo view('layout/seguimiento/visualizacion', [
                'fechas' => $fechas,
                'pesos' => $pesos,
                'datosProgresoRestantes' => $datosProgresoRestantes
            ]);
            echo view('layout/admin/footer');
        }
    }


    public function eliminarProgreso()
    {
        $session = session();
        // Obtener el user_id y la fecha_registro desde la solicitud AJAX
        $user_id = $this->request->getPost('user_id');
        $fecha_registro = $this->request->getPost('fecha_registro');

        // Llamar al método del modelo para eliminar el registro
        $resultado = $this->salud->eliminarProgreso($user_id, $fecha_registro);

        if ($resultado) {
            $session->setFlashdata('success', 'Progreso eliminado correctamente.');
            return redirect()->to(base_url('/progreso'));
        } else {
            $session->setFlashdata('error', 'No se pudo eliminar el progreso.');
            return redirect()->to(base_url('/progreso'));
        }
    }
}
