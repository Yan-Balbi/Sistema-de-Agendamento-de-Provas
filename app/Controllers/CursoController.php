<?php
namespace app\Controllers;
use app\Models\Curso;
use CodeIgniter\Controller;

class CursoController extends Controller{

    public function index(){
        $curso = new Curso();
        $data['items'] = $curso->findAll();
        return $data;
    }

    public function insert($nome){
        $curso = new Curso();

        $curso->insert($nome);
    }
}
