<?php
require_once ("config/conexiondb.php");

function iniciarSesion($usuario, $contrasena): void{
	$conexionSql = new conexiondb();
	$conexionSql = $conexionSql->getConnection();

	$consulta = "SELECT idCliente, contraseña, rol FROM clientes WHERE user = ?";
	$stmt = $conexionSql->prepare($consulta);
	$stmt->bind_param("s", $usuario);
	$stmt->execute();
	$resultado = $stmt->get_result();

	if($resultado->num_rows > 0){
		$usuario = $resultado->fetch_assoc();
		if($contrasena === $usuario["contraseña"]){
			//Iniciamos sesion del servidor
			session_start();
			$_SESSION["idUsuario"] = $usuario["idCliente"];
			$_SESSION["rol"] = $usuario["rol"];
		
			if($usuario["rol"] == "cliente"){
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


function registrarUsuario($usuario, $contrasena): void{
	$conexionSql = new conexiondb();
	$conexionSql = $conexionSql->getConnection();

	$consulta = "INSERT INTO clientes(user, contraseña, rol) VALUES(?,?,?)";
	$stmt = $conexionSql->prepare($consulta);
	$rol = "cliente";
	$stmt->bind_param("sss", $usuario, $contrasena, $rol);
	$stmt->execute();
	$stmt->close();
	
	// Redirigir a la página de inicio de sesión con un mensaje de éxito
    header("Location: ../../index.php?registro_exitoso=1");
    exit();

}

function validarSesion(){
	session_start();
	if(!isset($_SESSION["idUsuario"])){
		$cdestino = "Location: ../../../index.php";
		header($cdestino);
		exit();
	}
}


function cerrarSesion(){
	session_start();
	session_unset();
	session_destroy();
}

