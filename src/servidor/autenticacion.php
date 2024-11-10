<?php

session_start();
require_once ("sesion.php");
if(isset($_POST['txt_nombre']) && isset($_POST['pass_contraseña'])){
	$usuario = $_POST["txt_nombre"];
	$contrasena = $_POST["pass_contraseña"];
	iniciarSesion($usuario,$contrasena);
}

