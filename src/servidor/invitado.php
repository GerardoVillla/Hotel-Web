<?php
session_start();
$_SESSION["idUsuario"] = 'invitado';
$_SESSION["rol"] = 'invitado';
header("Location: ../cliente/view/principal.php");
exit();