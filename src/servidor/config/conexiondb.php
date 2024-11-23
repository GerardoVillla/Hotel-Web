<?php

$GLOBALS["servidor"] = "localhost";
$GLOBALS["usuario"] = "root";
$GLOBALS["contrasena"] = "";
$GLOBALS["base_datos"] = "ecologico";
$GLOBALS["raiz_sitio"] = "http://localhost/ecologico/";
class Conexiondb{
	//Configuracion por defecto que trae xampp 

	private $servidor;
	private $usuario;
	private $contrasena;
	//Nombre que le se puso a la bd en phpmyadmin
	private $db;
	public $conexion;

	public function __construct(){
		$this->servidor = $GLOBALS["servidor"];
		$this->usuario = $GLOBALS["servidor"];
		$this->contrasena = $GLOBALS["servidor"];
		$this->db = $GLOBALS["servidor"];
	}

	public function getConnection(){
		$this->conexion = new mysqli($this->servidor, $this->user, $this->pass, $this->db);
		if($this->conexion->connect_error){
			die("Conexion fallida: " . $this->conexion->connect_error);
		}
		return $this->conexion;
	}


}
