<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class RecetasController extends Controller
{

    private $api_id_recetas = '130e10c5';
    private $api_key_recetas = '3bec4d199a676d5783a0f53367a05b13';
    private $api_id_nutricional = '90c2d60a';
    private $api_key_nutricional = '750f1619af26709231130fa8899d1c5f';


    // sugerencias de recetas basadas en los ingredientes disponibles en la nevera
    public function sugerencias()
    {
        $session = session();

        if (empty($session->get('logged_in'))) {
            return redirect()->to(base_url('/login'));
        } else {

            echo view('layout/admin/header');
            echo view('layout/admin/navbar');
            echo view('layout/admin/sidebar');
            echo view('layout/planificador/sugerencias');
            echo view('layout/admin/footer');
        }
    }
    // buscar recetas por ingrediente específico
    public function buscar_recetas()
    {
        $ingrediente = $this->request->getPost('ingrediente');

        // Realizar la llamada a la API de Edamam para buscar recetas
        $url = "https://api.edamam.com/search?q=" . urlencode($ingrediente) . "&app_id={$this->api_id_recetas}&app_key={$this->api_key_recetas}&from=0&to=10";
        $response = file_get_contents($url);
        $recetas = json_decode($response, true)['hits'];

        // Realizar la llamada a la API de Edamam para análisis nutricional
        $recetas_con_nutricion = [];
        foreach ($recetas as $receta) {
            $ingredients = $receta['recipe']['ingredientLines'];

            // Preparar los datos para la llamada a la API de análisis nutricional
            $nutricional_url = "https://api.edamam.com/api/nutrition-details?app_id={$this->api_id_nutricional}&app_key={$this->api_key_nutricional}";
            $nutricional_data = [
                'ingredients' => $ingredients
            ];

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
                // Manejo de errores
                $receta['nutrition'] = ['error' => 'No se pudo obtener información nutricional'];
            } else {
                $nutricional_data = json_decode($nutricional_response, true);
                $receta['nutrition'] = $nutricional_data;
            }

            $recetas_con_nutricion[] = $receta;
        }

        // Devolver los datos como JSON
        return $this->response->setJSON(['recetas' => $recetas_con_nutricion]);
    }
}
