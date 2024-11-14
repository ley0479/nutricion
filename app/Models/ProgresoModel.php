<?php

namespace App\Models;

use CodeIgniter\Model;

class ProgresoModel extends Model
{
    protected $table = 'progreso_salud';
    protected $primaryKey = 'id';
    protected $allowedFields = ['user_id', 'peso', 'grasa_corporal', 'masa_muscular', 'fecha_registro'];

    // Función para guardar el progreso del usuario
    public function guardarProgreso($data)
    {
        return $this->insert($data);
    }
    // Método para eliminar un registro de progreso por user_id y fecha_registro
    public function eliminarProgreso($user_id, $fecha_registro)
    {
        return $this->where(['user_id' => $user_id, 'fecha_registro' => $fecha_registro])->delete();
    }
    public function getProgresoUltimos30($userId, $fecha_inicio, $fecha_fin)
    {
        return $this->where('fecha_registro >=', $fecha_inicio)
            ->where('fecha_registro <=', $fecha_fin)
            ->where('user_id =', $userId)
            ->orderBy('fecha_registro', 'DESC')
            ->findAll(30);
    }
    // Función para obtener todos los registros fuera del rango de los últimos 30 días
    public function getProgresoRestantes($userId, $fecha_inicio, $fecha_fin)
    {
        return $this->where('fecha_registro <', $fecha_inicio)
            ->where('user_id =', $userId)
            ->orWhere('fecha_registro >', $fecha_fin)
            ->findAll();
    }
    
}
