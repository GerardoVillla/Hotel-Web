<?php

session_start();
require_once ("sesion.php");


if(isset($_POST["action"])){
	$peticionRecibida = $_POST["action"];
	$usuario = $_POST["txt_nombre"];
	$contrasena = $_POST["pass_contraseña"];
	if($peticionRecibida == "iniciarSesion"){
		iniciarSesion($usuario,$contrasena);
	}else if($peticionRecibida == "registrarUsuario"){
		registrarUsuario($usuario,$contrasena);
	}
}