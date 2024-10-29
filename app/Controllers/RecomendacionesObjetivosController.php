<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\UserModel;

class RecomendacionesObjetivosController extends Controller
{
    protected $usuario;

    private $api_id_recetas = '130e10c5';
    private $api_key_recetas = '3bec4d199a676d5783a0f53367a05b13';
    private $api_id_nutricional = '90c2d60a';
    private $api_key_nutricional = '750f1619af26709231130fa8899d1c5f';

    public function __construct()
    {
        $this->usuario = new UserModel;
    }

    public function recomendacionesObjetivos()
    {
        $session = session();

        if (empty($session->get('logged_in'))) {
            return redirect()->to(base_url('/login'));
        } else {

            $userId = $session->get('id');
            $perfil = $this->usuario->where('id', $userId)->first();

            if ($perfil) {
                $objetivos = [
                    'objetivo_salud' => $perfil['objetivo_salud'],
                    'calorias_diarias' =>  $perfil['calorias_diarias'],
                    'carbohidratos_diarios' => $perfil['carbohidratos_diarios'],
                    'proteinas_diarias' => $perfil['proteinas_diarias'],
                    'grasas_diarias' => $perfil['grasas_diarias'],

                ];

                echo view('layout/admin/header');
                echo view('layout/admin/navbar');
                echo view('layout/admin/sidebar');
                echo view('layout/recomendaciones/recomendaciones_objetivos', ['userId' => $userId, 'objetivos' => $objetivos]);
                echo view('layout/admin/footer');
            } else {
                return 'No se encontraron condiciones para este usuario.';
            }
        }
    }
    // dashboard de recomendaciones nutricionales y objetivos de salud
    public function darRecomendaciones()
    {
        $userId = session()->get('id');
        $perfil = $this->usuario->where('id', $userId)->first();

        if (!$perfil) {
            return $this->response->setJSON(['error' => 'No se encontró el perfil del usuario.']);
        }

        $objetivos = [
            'objetivo_salud' => $perfil['objetivo_salud'],
            'calorias_diarias' =>  $perfil['calorias_diarias'],
            'carbohidratos_diarios' => $perfil['carbohidratos_diarios'],
            'proteinas_diarias' => $perfil['proteinas_diarias'],
            'grasas_diarias' => $perfil['grasas_diarias'],

        ];
        // 1. Buscar recetas en la API de Edamam
        $url_recetas = "https://api.edamam.com/search?q=&app_id={$this->api_id_recetas}&app_key={$this->api_key_recetas}&calories=0-{$objetivos['calorias_diarias']}&from=0&to=10";
        $response_recetas = file_get_contents($url_recetas);
        $data_recetas = json_decode($response_recetas, true);

        // 2. Filtrar recetas según los objetivos de macronutrientes
        $recetas_filtradas = array_filter($data_recetas['hits'], function ($receta) use ($objetivos) {
            $nutrients = $receta['recipe']['totalNutrients'];

            $calorias = $nutrients['ENERC_KCAL']['quantity'] ?? 0;
            $carbohidratos = $nutrients['CHOCDF']['quantity'] ?? 0;
            $proteinas = $nutrients['PROCNT']['quantity'] ?? 0;
            $grasas = $nutrients['FAT']['quantity'] ?? 0;

            return $calorias <= $objetivos['calorias_diarias']
                && $carbohidratos <= $objetivos['carbohidratos_diarios']
                && $proteinas <= $objetivos['proteinas_diarias']
                && $grasas <= $objetivos['grasas_diarias'];
        });

        // 3. Obtener detalles nutricionales de las recetas filtradas
        $recetas_con_nutricion = [];
        foreach ($recetas_filtradas as $receta) {
            $ingredients = $receta['recipe']['ingredientLines'];
            $nutricional_url = "https://api.edamam.com/api/nutrition-details?app_id={$this->api_id_nutricional}&app_key={$this->api_key_nutricional}";
            $nutricional_data = ['ingredients' => $ingredients];

            $options = [
                'http' => [
                    'header'  => "Content-Type: application/json\r\n",
                    'method'  => 'POST',
                    'content' => json_encode($nutricional_data),
                ],
            ];
            $context  = stream_context_create($options);
            $nutricional_response = @file_get_contents($nutricional_url, false, $context);

            if ($nutricional_response === FALSE) {
                $receta['nutrition'] = ['error' => 'No se pudo obtener información nutricional'];
            } else {
                $nutricional_data = json_decode($nutricional_response, true);
                $receta['nutrition'] = $nutricional_data;
            }

            $recetas_con_nutricion[] = [
                'label' => $receta['recipe']['label'],
                'image' => $receta['recipe']['image'],
                'url' => $receta['recipe']['url'],
                'nutrition' => $receta['nutrition']
            ];
        }

        // 4. Devolver los datos como respuesta en formato JSON
        return $this->response->setJSON(['recetas' => $recetas_con_nutricion]);
    }
}
