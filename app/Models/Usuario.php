<?php

namespace App\Models;

use PDO;
use PDOException;

class Usuario extends Model
{
    protected $table =  "personas";

    public function loginWithEmailAndPassword(string $email, string $password): Array{

        $query = "SELECT * FROM {$this->table} WHERE email = '{$email}'";
        $result = $this->query($query)->getOne();

        $isValid = password_verify($password, $result['password']);

        header("Content-type: application/json");

        if($isValid){
            echo json_encode(array("ok"=>true, "data"=> $result));
            return array("ok"=>true, "data"=>$result);
        }

        echo json_encode(array("ok"=>false, "data"=>[]));
        return array("ok"=>false, "data"=>[]);
        
    }
}