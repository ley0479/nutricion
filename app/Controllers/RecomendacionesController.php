<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\UserModel;
// header('Content-Type: text/html; charset=utf-8');


class RecomendacionesController extends Controller
{
    protected $usuario;
    protected $openai;

    private $api_id_recetas = '130e10c5';
    private $api_key_recetas = '3bec4d199a676d5783a0f53367a05b13';
    private $api_id_nutricional = '90c2d60a';
    private $api_key_nutricional = '750f1619af26709231130fa8899d1c5f';

    public function __construct()
    {
        $this->usuario = new UserModel;
    }

    public function view()
    {
        $userId = session()->get('id');
        $session = session();

        if (empty($session->get('logged_in'))) {
            return redirect()->to(base_url('/login'));
        } else {

            $perfil = $this->usuario->where('id', $userId)->first();

            if ($perfil) {
                $condiciones = [
                    'condiciones_medicas' => $perfil['condiciones_medicas'],
                    'alergias' =>  $perfil['alergias'],
                    'intolerancias' => $perfil['intolerancias'],
                    'tipo_dieta' => $perfil['tipo_dieta'],
                ];

                echo view('layout/admin/header');
                echo view('layout/admin/navbar');
                echo view('layout/admin/sidebar');
                echo view('layout/recomendaciones/recomendacion', ['userId' => $userId, 'condiciones' => $condiciones]);
                echo view('layout/admin/footer');
            } else {
                return 'No se encontraron condiciones para este usuario.';
            }
        }
    }
    public function obtenerRecomendaciones($userId)
    {
        // Obtener el perfil del usuario
        $perfil = $this->usuario->where('id', $userId)->first();

        if (!$perfil) {
            return 'No se encontraron condiciones para este usuario.';
        }

        // Construir el prompt basado en el perfil del usuario
        $prompt = "Proporciona recomendaciones generales para llevar un estilo de vida saludable, considerando lo siguiente:\n" .
            "- Condiciones médicas: {$perfil['condiciones_medicas']}\n" .
            "- Peso: {$perfil['peso']} kg\n" .
            "- Altura: {$perfil['altura']} cm\n" .
            "- Edad: {$perfil['edad']} años\n" .
            "- Género: {$perfil['genero']}\n" .
            "- Nivel de actividad: {$perfil['nivel_actividad']}\n" .
            "- Objetivo de salud: {$perfil['objetivo_salud']}\n" .
            "- Calorías diarias: {$perfil['calorias_diarias']}\n" .
            "- Carbohidratos diarios: {$perfil['carbohidratos_diarios']}\n" .
            "- Proteínas diarias: {$perfil['proteinas_diarias']}\n" .
            "- Grasas diarias: {$perfil['grasas_diarias']}\n" .
            "- Alergias: {$perfil['alergias']}\n" .
            "- Intolerancias: {$perfil['intolerancias']}\n\n" .
            "Por favor, proporciona un plan de ejercicio y dieta personalizado basado en la información anterior.";

        // Ejecutar el script de Python
        $scriptPath = "C:\\Users\\mafia\\AppData\\Local\\Programs\\Python\\Python39\\python.exe";
        $pythonScript = "C:\\xampp\\htdocs\\nutricion\\scripts\\gemini_script.py";
        $command = "$scriptPath $pythonScript " . escapeshellarg($prompt);

        // Obtener la salida del script
        $output = shell_exec($command);

        // Limpiar la salida
        $recomendaciones = htmlspecialchars($output); // Limpiar caracteres especiales
        $recomendaciones = nl2br($recomendaciones); // Convertir saltos de línea a <br>

        // Eliminar asteriscos
        $recomendaciones = str_replace(['*', '**'], '', $recomendaciones);

        // Verificar si se obtuvo una respuesta
        return $this->renderRecomendaciones($recomendaciones, $perfil);
    }

    private function renderRecomendaciones($recomendaciones, $perfil)
    {
        // Formatear la información del perfil en dos columnas
        $perfilInfo = '
        <div class="row">
            <div class="col-md-6">
                <p><strong>Información de tu perfil:</strong></p>
                <ul>
                    <li><strong>Condiciones médicas:</strong> ' . htmlspecialchars($perfil['condiciones_medicas']) . '</li>
                    <li><strong>Peso:</strong> ' . htmlspecialchars($perfil['peso']) . ' kg</li>
                    <li><strong>Altura:</strong> ' . htmlspecialchars($perfil['altura']) . ' cm</li>
                    <li><strong>Edad:</strong> ' . htmlspecialchars($perfil['edad']) . ' años</li>
                    <li><strong>Género:</strong> ' . htmlspecialchars($perfil['genero']) . '</li>
                    <li><strong>Nivel de actividad:</strong> ' . htmlspecialchars($perfil['nivel_actividad']) . '</li>
                </ul>
            </div>
            <div class="col-md-6">
                <ul>
                    <li><strong>Objetivo de salud:</strong> ' . htmlspecialchars($perfil['objetivo_salud']) . '</li>
                    <li><strong>Calorías diarias:</strong> ' . htmlspecialchars($perfil['calorias_diarias']) . '</li>
                    <li><strong>Carbohidratos diarios:</strong> ' . htmlspecialchars($perfil['carbohidratos_diarios']) . '</li>
                    <li><strong>Proteínas diarias:</strong> ' . htmlspecialchars($perfil['proteinas_diarias']) . '</li>
                    <li><strong>Grasas diarias:</strong> ' . htmlspecialchars($perfil['grasas_diarias']) . '</li>
                    <li><strong>Alergias:</strong> ' . htmlspecialchars($perfil['alergias']) . '</li>
                    <li><strong>Intolerancias:</strong> ' . htmlspecialchars($perfil['intolerancias']) . '</li>
                </ul>
            </div>
        </div>';

        return '
        <div class="content-wrapper">
            <br>
            <section class="content-header text-center">
                <h2>Recomendaciones Personalizadas por la IA</h2>
            </section>
                    <br>
            <style>
    .contenedor {
        width: 100%;
        max-width: 800px;
        /* Ajusta el ancho máximo del contenedor según tus necesidades */
        margin: 0 auto;
        padding: 20px;
        border: 1px solid #ccc;
        background-color: #253544;
        color: white;
        text-align: justify;
                border-radius: 25px;

    }

    p {
        text-align: justify;
    }
    </style>
    <hr>

    <div class="contenedor">
        <p>  Basado en tu perfil, aquí tienes algunas recomendaciones personalizadas de ejercicio y dieta, 
    generadas por nuestro módulo de inteligencia artificial. Este sistema analiza tu información personal, 
    como condiciones médicas, peso, altura y nivel de actividad, para ofrecerte un plan adaptado a tus necesidades. 
    A continuación, encontrarás recomendaciones específicas diseñadas para ayudarte a alcanzar tus objetivos de salud y bienestar.
        </p>
    </div>
    <br>
            <section class="content ">
                <div class="row justify-content-center">
                            <div class="col-md-8 bg-white p-4" style="border-radius: 8px;">' . $perfilInfo . '</div>

                    <div class="col-md-8 bg-white p-4 border-16" style="border-radius: 10px;">
                        <div class="box box-primary">
                            <div class="box-body">
                                <p><strong>Recomendaciones:</strong></p>
                                <p style="text-align: justify;">' . $recomendaciones . '</p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>';
    }

    public function iaView()
    {
        $userId = session()->get('id');
        $session = session();

        // Verificar si el usuario está logueado
        if (empty($session->get('logged_in'))) {
            return redirect()->to(base_url('/login'));
        } else {
            // Obtener el perfil del usuario
            $perfil = $this->usuario->where('id', $userId)->first();

            if ($perfil) {
                // Obtener las recomendaciones
                $recomendaciones = $this->obtenerRecomendaciones($userId);

                // Cargar las vistas
                echo view('layout/admin/header');
                echo view('layout/admin/navbar');
                echo view('layout/admin/sidebar');
                echo view('layout/recomendaciones/ia', [
                    'userId' => $userId,
                    'perfil' => $perfil,
                    'recomendaciones' => $recomendaciones
                ]);
                echo view('layout/admin/footer');
            } else {
                return 'No se encontraron condiciones para este usuario.';
            }
        }
    }


    // recomendaciones nutricionales
    public function recomendaciones()
    {
        $userId = session()->get('id');
        $perfil = $this->usuario->where('id', $userId)->first();

        if (!$perfil) {
            return $this->response->setJSON(['error' => 'No se encontró el perfil del usuario.']);
        }

        $conditions = $perfil['condiciones_medicas'];
        $allergies = explode(',', $perfil['alergias']);
        $intolerances = explode(',', $perfil['intolerancias']);
        $dietType = $perfil['tipo_dieta'];

        // Llamada a la API de recetas
        $recetas = $this->obtenerRecetas($conditions);

        // Filtrar recetas
        $recetas_filtradas = $this->filtrarRecetas($recetas, $allergies, $intolerances, $dietType);

        // Obtener detalles nutricionales
        $recetas_con_nutricion = $this->obtenerDetallesNutricionales($recetas_filtradas);

        // Devolver la respuesta en JSON
        return $this->response->setJSON(['recetas' => $recetas_con_nutricion]);
    }
    // recetas nutricionales
    private function obtenerRecetas($condiciones)
    {
        $url = "https://api.edamam.com/search?q={$condiciones}&app_id={$this->api_id_recetas}&app_key={$this->api_key_recetas}&from=0&to=10";

        try {
            $response = file_get_contents($url);
            return json_decode($response, true)['hits'];
        } catch (\Exception $e) {
            // Manejo de error
            return [];
        }
    }
    // filtrar las recetas por alergias, intolerancias y tipo de dieta
    private function filtrarRecetas($recetas, $allergies, $intolerances, $dietTypes)
    {
        return array_filter($recetas, function ($receta) use ($allergies, $intolerances, $dietTypes) {
            $ingredients = $receta['recipe']['ingredientLines'];
            $include = true;

            foreach ($allergies as $allergy) {
                if (stripos(implode(' ', $ingredients), $allergy) !== false) {
                    $include = false;
                    break;
                }
            }

            foreach ($intolerances as $intolerance) {
                if (stripos(implode(' ', $ingredients), $intolerance) !== false) {
                    $include = false;
                    break;
                }
            }
            // foreach ($dietTypes as $dietType) {
            //     if (stripos(implode(' ', $ingredients), $dietType) !== false) {
            //         $include = false;
            //         break;
            //     }
            // }


            // Agregar lógica adicional para dietType si es necesario

            return $include;
        });
    }
    //  obtener los detalles nutricionales de cada receta filtrada
    private function obtenerDetallesNutricionales($recetas_filtradas)
    {
        $recetas_con_nutricion = [];
        foreach ($recetas_filtradas as $receta) {
            $ingredients = $receta['recipe']['ingredientLines'];
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
                $receta['nutrition'] = ['error' => 'No se pudo obtener información nutricional'];
            } else {
                $nutricional_data = json_decode($nutricional_response, true);
                $receta['nutrition'] = $nutricional_data;
            }

            $recetas_con_nutricion[] = $receta;
        }

        return $recetas_con_nutricion;
    }
}