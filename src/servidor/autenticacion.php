<?php

require_once ("sesion.php");


if(isset($_POST["action"])){
	$peticionRecibida = $_POST["action"];
	if($peticionRecibida == "cerrarsesion"){
		cerrarSesion();
		return;
	}
	$nombreUsuario = $_POST["txt_nombre"];
	$usuarioContrasena = $_POST["pass_contraseña"];
	if($peticionRecibida == "registrarUsuario"){
		registrarUsuario($nombreUsuario, $usuarioContrasena);
		return;
	}
	iniciarSesion($nombreUsuario,$usuarioContrasena);
}