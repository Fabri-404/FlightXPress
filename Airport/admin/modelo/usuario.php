<?php

class Usuario{
    protected $id;
    protected $contraseña;
    protected $email;

    public function __construct($id, $contraseña, $email){
        $this->id=$id;
        $this->contraseña=$contraseña;
        $this->email=$email;
    }
    public function registrarUsuario($pa,$em){
        require '../../includes/config/database.php';
        $db=conectarDB();
        $db->query("INSERT INTO usuarios (pasword,email) VALUES ('$pa','$em';");
        return $db;
    }
    public function listaUsuario(){
        include_once("conexion.php");
        $db=new Conexion();
        $res=$db->query("SELECT * FROM usuarios where estado='Activo'");
        return $res;
    }
}