<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'usuarios';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'nombre',
        'apellidos',
        'email',
        'password',
        'edad',
        'peso',
        'altura',
        'genero',
        'nivel_actividad',
        'objetivo_salud',
        'calorias_diarias',
        'carbohidratos_diarios',
        'proteinas_diarias',
        'grasas_diarias',
        'condiciones_medicas',
        'alergias',
        'intolerancias',
        'tipo_dieta',
        'otro_objetivo',
        'otro_condicion',
        'otro_alergia',
        'otra_intolerancia',
        'otra_dieta',
    ];
    public function getProgreso()
    {
        return $this->db->table('progreso_salud')
            ->where('user_id', session()->get('id')) // Asumiendo que el ID del usuario está en sesión
            ->orderBy('fecha_registro', 'DESC')
            ->get()
            ->getResultArray();
    }

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}
