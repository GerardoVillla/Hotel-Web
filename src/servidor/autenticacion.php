<?php
require_once ("config/conexiondb.php");
session_start();
class autenticacion{
	private $conexionSql;

	public function __construct() {
        $database = new Conexiondb();
        $this->conexionSql = $database->getConnection();
    }

	function iniciarSesion($usuario, $contrasena): void{
		
		$consulta = "SELECT idCliente, contraseña, rol FROM clientes WHERE user = ?";
		$stmt = $this->conexionSql->prepare($consulta);
		$stmt->bind_param("s", $usuario);
		$stmt->execute();
		$resultado = $stmt->get_result();

		if($resultado->num_rows > 0){
			$usuario = $resultado->fetch_assoc();
			if($contrasena == $usuario["contraseña"]){
				//Iniciamos sesion del servidor
				session_start();
				$_SESSION["id"] = $usuario["id"];
				$_SESSION["rol"] = $usuario["rol"];
			
				if($usuario["rol"] == "cliente"){
					header("Location: ../cliente/view/principal.php");
				}else{
					header("Location: ../cliente/view/adminpanel.php");
				}
				exit();
			}
		}else{
			echo"Usuario o contraseña incorrectos";
		}

		$stmt->close();
	}
	public function cerrarSesion(){
		session_start();
		session_unset();
		session_destroy();
	}
	
}

if(isset($_POST['txt_nombre']) && isset($_POST['pass_contraseña'])){
	$usuario = $_POST["txt_nombre"];
	$contrasena = $_POST["pass_contraseña"];
	$autenticador = new autenticacion();
	$autenticador->iniciarSesion($usuario, $contrasena);
}

