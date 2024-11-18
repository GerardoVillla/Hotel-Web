<?php
class Conexiondb{
	//Configuracion por defecto que trae xampp 
	private $server = "localhost";
	private $user = "root";
	private $pass = "";
	//Nombre que le se puso a la bd en phpmyadmin
	private $db = "ecologico";
	public $conexion;

	public function getConnection(){
		$this->conexion = new mysqli($this->server, $this->user, $this->pass, $this->db);
		if($this->conexion->connect_error){
			die("Conexion fallida: " . $this->conexion->connect_error);
		}else{
			//echo"conectado";
		}
		return $this->conexion;
	}


}
