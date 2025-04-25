<?php

namespace App\Controllers;

use App\Models\Usuario;

class AuthController extends Controller{

    public static function validateAuth()
    {
        session_start();
        return isset($_SESSION['username']) && !empty($_SESSION['username']);
    }

    public function logOut()
    {
        session_start();
        session_unset();
        session_destroy();
        // header('Location: /');
        header("Content-type: application/json");
        echo json_encode(array("ok"=>true, "message"=>"Logout successfully"));
        exit();
    }

    public function login()
    {
        $data = json_decode(file_get_contents("php://input"), true);
        extract($data);
        $usuario = new Usuario();
        $auth = $usuario->loginWithEmailAndPassword($email,$password);

        if($auth['ok']){
            session_start();
            $_SESSION['username'] = $auth['data']['email'];
            $_SESSION['login'] = true;
        }

    }

}