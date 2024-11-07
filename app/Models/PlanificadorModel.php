<?php

namespace App\Models;

use CodeIgniter\Model;

class PlanificadorModel extends Model
{
    protected $table = 'planificador';
    protected $primaryKey = 'id';

    protected $allowedFields = ['user_id', 'dia', 'desayuno', 'almuerzo', 'cena', 'realizado'];
    protected $useTimestamps = false;

    public function getPlanificacion($userId)
    {
        return $this->where('user_id', $userId)
            ->findAll();
    }

    public function savePlanificacion($userId, $planificacion)
    {
        $this->where('user_id', $userId)
            ->delete();

        foreach ($planificacion as $dia => $comidas) {
            $data = [
                'user_id' => $userId,
                'dia' => $dia,
                'desayuno' => $comidas['desayuno'],
                'almuerzo' => $comidas['almuerzo'],
                'cena' => $comidas['cena']
            ];
            $this->insert($data);
        }
    }
    public function obtener_planificacion($id, $user_id, $dia)
    {
        return $this->where('id', $id)
                        ->where('user_id', $user_id)
                        ->where('dia', $dia)
                        ->get() // Cambia 'planificaciones' al nombre de tu tabla
                        ->getRowArray();
    }
    
    public function eliminar_planificacion($user_id, $dia, $id)
    {
        return $this->where('id', $id)
        ->where('user_id', $user_id)
        ->where('dia', $dia)
                        ->delete(); // Cambia 'planificaciones' al nombre de tu tabla
    }
    
    public function actualizar_planificacion($id, $user_id, $dia, $datos){
        return $this->where('id', $id)
        ->where('user_id', $user_id)
        ->where('dia', $dia)
                        ->set($datos)
                        ->update(); // Cambia 'planificaciones' al nombre de tu tabla
    }
    
}