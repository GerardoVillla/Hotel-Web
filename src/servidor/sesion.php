<?php

require_once (__DIR__."/../../config.inc.php");



function iniciarSesion($nombreUsuario, $contrasenaUsuario): void{
	$conexionSql = new conexiondb();
	$conexionSql = $conexionSql->getConnection();

	$consulta = "SELECT idCliente, contraseña, rol FROM clientes WHERE user = ?";
	$stmt = $conexionSql->prepare($consulta);
	$stmt->bind_param("s", $nombreUsuario);
	$stmt->execute();
	$resultado = $stmt->get_result();

	if($resultado->num_rows > 0){
		$nombreUsuario = $resultado->fetch_assoc();
		if($contrasenaUsuario === $nombreUsuario["contraseña"]){
			//Iniciamos sesion del servidor
			session_start();
			$_SESSION["idUsuario"] = $nombreUsuario["idCliente"];
			$_SESSION["rol"] = $nombreUsuario["rol"];
		
			if($nombreUsuario["rol"] == "cliente"){
				header("Location: ../cliente/view/principal.php");
			}else{
				header("Location: ../cliente/view/adminpanel.php");
			}
			exit();
		}
	}
	$stmt->close();
	// Redirigir a la página de inicio de sesión con un mensaje de error en post
	header("Location: ../../index.php?error=1");
	exit();

}


function registrarUsuario($usuarnombreUsuarioio, $contrasenaUsuario): void{
	$conexionSql = new conexiondb();
	$conexionSql = $conexionSql->getConnection();

	$consulta = "INSERT INTO clientes(user, contraseña, rol) VALUES(?,?,?)";
	$stmt = $conexionSql->prepare($consulta);
	$rol = "cliente";
	$stmt->bind_param("sss", $nombreUsuario, $contrasenaUsuario, $rol);
	$stmt->execute();
	$stmt->close();
	
	// Redirigir a la página de inicio de sesión con un mensaje de éxito
    header("Location: ../../index.php?registro_exitoso=1");
    exit();

}

function validarSesionPantallaPrincipal(){
	session_start();
	if(!isset($_SESSION["idUsuario"])|| $_SESSION["rol"] == "administrador"){
		$cdestino = "Location: ../../../index.php";
		header($cdestino);
		exit();
	}
}

function validarSesionCliente(){
	session_start();
	if(!isset($_SESSION["idUsuario"])|| $_SESSION["rol"] != "cliente"){
		$cdestino = "Location: ../../../index.php";
		header($cdestino);
		exit();
	}
}

function validarSesionAdministrador(){
	session_start();
	if(!isset($_SESSION["idUsuario"])|| $_SESSION["rol"] != "administrador"){
		$cdestino = "Location: ../../../index.php";
		header($cdestino);
		exit();
	}
}

function cerrarSesion(){
	session_start();
	session_unset();
	session_destroy();
	header("Location: ../../index.php");
	exit();
}

