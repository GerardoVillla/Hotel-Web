<?php

require_once ("sesion.php");


if(isset($_POST["action"])){
	$peticionRecibida = $_POST["action"];
	$usuario = $_POST["txt_nombre"];
	$contrasena = $_POST["pass_contraseña"];
	if($peticionRecibida == "registrarUsuario"){
		registrarUsuario($usuario,$contrasena);
		return;
	}
	iniciarSesion($usuario,$contrasena);
}