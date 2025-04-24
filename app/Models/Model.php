<?php

namespace App\Models;

use PDO;
use PDOException;

class Model
{
    protected $db_host = db_host;
    protected $db_user = db_user;
    protected $db_password = db_password;
    protected $db_name = db_name;
    protected $db_port = db_port;

    protected $table;

    protected $connection;
    protected $queries;

    public function __construct()
    {
        $this->connection();
    }

    public function connection()
    {
        try {

            $this->connection = new PDO("mysql:host=$this->db_host;port=$this->db_port;dbname=$this->db_name", $this->db_user, $this->db_password);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            return $this->connection;
        } catch (PDOException $error) {
            echo "Error" . $error;
        }
    }

    public function query($consulta)
    {
        $this->queries = $this->connection()->prepare($consulta);
        $this->queries->execute();
        return $this;
    }

    public function getOne()
    {
        return $this->queries->fetch(PDO::FETCH_ASSOC);
    }

    public function getAll()
    {
        return $this->queries->fetchAll(PDO::FETCH_ASSOC);
    }

    //Consultas

    public function All()
    {
        $sql = "SELECT * FROM {$this->table}";
        return $this->query($sql)->getAll();
    }

    public function Find($id)
    {
        $sql = "SELECT * FROM {$this->table} Where id = {$id}";
        return $this->query($sql)->getOne();
    }

    public function Where($column, $operator, $value = null)
    {
        if ($value == null) {
            $value = $operator;
            $operator = "=";
        }

        $sql = "SELECT * FROM {$this->table} WHERE {$column} {$operator} '{$value}'";
        $this->query($sql);
        return $this;
    }

    public function create($data)
    {
        $columns = array_keys($data);
        $columns = implode(', ', $columns);

        $values = array_values($data);
        $values = "'" . implode("', '", $values) . "'";

        $sql = "INSERT INTO {$this->table} ({$columns}) VALUES ({$values})";
        $this->query($sql);
        $insert_id = $this->connection->lastInsertId();
        return $this->Find($insert_id);
    }

    public function Update($id, $data)
    {
        $fields = [];
        foreach ($data as $key => $value) {
            $fields[] = " {$key} = '{$value}' ";
        }

        $fields = implode(', ', $fields);

        $sql = "UPDATE {$this->table} SET {$fields} WHERE id = {$id}";
        $this->query($sql);
        return $this->Find($id);
    }

    public function Delete($id)
    {
        $sql = "DELETE FROM {$this->table} WHERE id = {$id}";
        return $this->query($sql);
    }
}
