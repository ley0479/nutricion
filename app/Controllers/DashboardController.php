<?php
namespace App\Controllers;
use CodeIgniter\Controller;
use App\Models\UserModel;

class DashboardController extends Controller
{
    protected $usuario;

    public function __construct()
    { 
         $this->usuario = new UserModel;
    }

    public function dashboard(){
       
        $session = session();

        if(empty($session->get('logged_in'))){
            return redirect()->to(base_url('/login'));
        }else{

            $user = $this->usuario->find($session->get('id'));

            echo view('layout/admin/header');
            echo view('layout/admin/navbar');
            echo view('layout/admin/sidebar');
            echo view('layout/perfil/perfil', ['user' => $user]);
            echo view('layout/admin/footer');
        }
 
    }
    
}