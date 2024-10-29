<?php

namespace App\Models;

use CodeIgniter\Model;

class AlimentoModel extends Model
{
    protected $table = 'alimentos';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'nombre', 'macronutrientes', 'micronutrientes', 'calorias', 'grasas', 'proteinas', 'carbohidratos'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}
