<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\PlanificadorModel;

class PlanificarController extends Controller
{
    protected $planificar;

    public function __construct()
    {
        $this->planificar = new PlanificadorModel();
    }

    public function planificar()
    {
        $session = session();

        if (empty($session->get('logged_in'))) {
            return redirect()->to(base_url('/login'));
        } else {

            $userId = $session->get('id');
            $data['planificacion'] = $this->planificar->getPlanificacion($userId);

            echo view('layout/admin/header');
            echo view('layout/admin/navbar');
            echo view('layout/admin/sidebar');
            echo view('layout/planificador/planificador', $data);
            echo view('layout/admin/footer');
        }
    }

    public function guardarPlanificacion()
    {
        $userId = session()->get('id');
        $planificacion = $this->request->getPost('planificacion');

        // Recorrer la planificación por día y comida (desayuno, almuerzo, cena)
        foreach ($planificacion as $dia => $comidas) {
            $data = [
                'user_id' => $userId,
                'dia' => $dia,
                'desayuno' => $comidas['desayuno'],
                'almuerzo' => $comidas['almuerzo'],
                'cena' => $comidas['cena'],
                'realizado' => $comidas['realizado'] ?? 0 // Esto es para almacenar si se cumplió o no
            ];
            // Guardar los datos de la planificación
            $this->planificar->save($data);
        }

        session()->setFlashdata('success', 'Comida guardada exitosamente.');
        return redirect()->to(base_url('/planificar-comidas'));
    }
    public function eliminar($user_id, $dia, $id)
    {
        // Cargar el modelo que maneja la planificación
    
        // Validar la existencia del registro
        $registro = $this->planificar->obtener_planificacion( $id,$user_id, $dia);
    
        if ($registro) {
            // Si existe, eliminar
            $this->planificar->eliminar_planificacion($user_id, $dia, $id);
           session()->setFlashdata('success', 'Planificación eliminada exitosamente.');
        } else {
            // Si no existe, mostrar error
            session()->setFlashdata('errors', 'No se encontró la planificación para eliminar.');
        }
    
        // Redirigir a la página de planificación
        return redirect()->to(base_url('/planificar-comidas'));
    }
    // actualizar
    public function update($id){
       
        $session = session();
        // Validar la existencia del registro
        $user_id =$session->get('id');

        $dia = $this->request->getPost('dia');
      
        $registro = $this->planificar->obtener_planificacion($id, $user_id, $dia);
        
        if ($registro) {
            // Si existe, obtener los datos del formulario
            $datos = $this->request->getPost();
            // Actualizar los datos del registro
            $this->planificar->actualizar_planificacion($id, $user_id, $dia, $datos);
            session()->setFlashdata('success', 'Planificación actualizada exitosamente.');
        } else {
            // Si no existe, mostrar error
            session()->setFlashdata('errors', 'No se encontró la planificación para actualizar.');
    
        }
        return redirect()->to(base_url('/planificar-comidas'));

    }
    
}