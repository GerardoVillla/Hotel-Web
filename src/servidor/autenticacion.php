<?php

session_start();
require_once ("sesion.php");


if(isset($_POST["action"])){
	$peticionRecibida = $_POST["action"];
	if($peticionRecibida == "iniciarSesion"){
		$usuario = $_POST["txt_nombre"];
		$contrasena = $_POST["pass_contraseña"];
		iniciarSesion($usuario,$contrasena);
	}else if($peticionRecibida == "registrarUsuario"){
		$usuario = $_POST["txt_nombre"];
		$contrasena = $_POST["pass_contraseña"];
		registrarUsuario($usuario,$contrasena);
	}
}