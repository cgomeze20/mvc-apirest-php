<?php

namespace App\Controllers;

use App\Controllers\Controller;
use App\Models\Usuario;

class UsuarioController extends Controller
{

    public function index(){

        $usuario = new Usuario();
        $usuarios = $usuario->All();

        return $this->view("usuarios",[
            "title"=>"Usuarios",
            "usuarios"=>$usuarios
        ]);
    }

    public function save(){
        //Read data from frontend
        $data = json_decode(file_get_contents("php://input"),true);

        $usuario = new Usuario();
        return $usuario->create($data);
    }

    public function delete(){
        //Read data from frontend
        $id = json_decode(file_get_contents("php://input"),true);

        extract($id);

        $usuario = new Usuario();
        $item = $usuario->Find($id);

        if(is_array($item)){
            $usuario->Delete($id);
            return $item;
        }else{
            header("Content-type: application/json");
            return json_encode(array("ok"=>false, "message"=>"Record no encontrado"));
        }

    }

    public function getAll(){
        $usuario = new Usuario();
        return $usuario->All();
    }

    public function getOne(){
        $id = json_decode(file_get_contents("php://input"),true);

        extract($id);

        $usuario = new Usuario();
        $result = $usuario->Find($id);

        if(!$result){
            header("Content-type: application/json");
            echo json_encode(array("ok"=>false, "message"=>"record no encontrado"));
        }else{
            return $result;
        }
    }

    public function actualizar(){
        $data = json_decode(file_get_contents("php://input"),true);

        $usuario = new Usuario();
        $result =  $usuario->Update($data['id'], $data);

        if(!$result){
            header("Content-type: application/json");
            echo json_encode(array("ok"=>false, "message"=>"Error al actualizar usuario"));
        }else{
            return $result;
        }
    }


}

