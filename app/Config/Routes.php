<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/login', 'LoginController::index');
$routes->post('/login/authenticate', 'LoginController::authenticate');
$routes->get('/logout', 'LoginController::logout');
// registro
$routes->get('/registro', 'RegistroController::registro');
$routes->post('/registro/guardarRegistro', 'RegistroController::guardarRegistro');
$routes->post('/authenticate', 'RegistroController::authenticate');
// perfil
$routes->get('/perfil', 'PerfilController::perfil');
$routes->post('/perfil/actualizar', 'PerfilController::actualizarPerfil');
// seguimiento de proceso
$routes->get('/seguimiento', 'SeguimientoController::seguimiento');
$routes->post('seguimiento/guardar', 'SeguimientoController::guardar');
// vuisualizacion de progreso
$routes->get('progreso', 'SeguimientoController::progreso');
// eliminar
$routes->post('/eliminar-progreso', 'SeguimientoController::eliminarProgreso');
// planificar comidas
$routes->get('/planificar-comidas', 'PlanificarController::planificar');
$routes->post('/planificador/guardar_planificacion', 'PlanificarController::guardarPlanificacion');
$routes->get('/planificador/eliminar/(:num)/(:any)/(:any)', 'PlanificarController::eliminar/$1/$2/$3');
$routes->post('/planificador/marcar_realizado/(:num)','PlanificacionController::update/1$');

// recetas
$routes->get('/recetas-basadas-a-la-planificacion', 'RecetasController::sugerencias');
$routes->post('/recetas-buscar_recetas', 'RecetasController::buscar_recetas');
$routes->get('/recetas-recomendaciones', 'RecomendacionesController::view');
$routes->get('/recetas-recomendaciones-nutricionales', 'RecomendacionesController::recomendaciones');
$routes->get('/recetas-recomendaciones-objetivos', 'RecomendacionesObjetivosController::recomendacionesObjetivos');
$routes->get('/recetas-recomendaciones-por-objetivos', 'RecomendacionesObjetivosController::darRecomendaciones');
$routes->get('/sugerencias-ia', 'RecomendacionesController::iaView');


// informacion nutricional
$routes->get('/informacion-nutricional', 'InformacionNutricionalController::informacion_alimentos');
$routes->post('/informacion-nutricional-buscarAlimento', 'InformacionNutricionalController::buscarAlimento');

$routes->get('/calculadora-nutricional', 'InformacionNutricionalController::calculadora_nutricional');
$routes->post('/calculadora-nutricional-informacionReceta', 'InformacionNutricionalController::calcularInformacionReceta');

// cambio de contraseña

// dashboard
$routes->get('/dashboard', 'DashboardController::dashboard');
$routes->get('/dashboard/cerrarSesion', 'DashboardController::cerrarSesion');
