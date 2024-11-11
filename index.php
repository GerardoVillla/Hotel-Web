<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/ecologico/src/cliente/css/iniciosesion-styles.css">
    <title>Document</title>
</head>
<body>
    <div id="imagen-seccion">
    </div>
    <div id="formulario-seccion">
        <div id="botones-nav">
            <input type="button" name="iniciosesion" value="Iniciar sesi&oacute;n" id="btn_iniciarSPag">
            <input type="button" name="iniciosesion" value="Registrarse" id="btn_RegistrarsePag">
        </div>
        <div id="formulario-contenedor">
			<form action="/ecologico/src/servidor/autenticacion.php" method="post">
            <input type="hidden" name="action" value="iniciarSesion">
                <h3>Nombre:</h3>
                <br><br>
                <input type="text" maxlength="35" size="35" name="txt_nombre" id="txt_nombre">
                <br><br><br>
                <h3>Contraseña:</h3>
                <br><br>
                <input type="password" maxlength="35" size="35" name="pass_contraseña" id="pass_contraseña">
                <br><br><br>
                <input type="submit" name="iniciosesion" value="Iniciar sesi&oacute;n" id="btn_inicioS">
            </form>
        </div>
    </div>
    <script src="/ecologico/src/cliente/scripts/index.js"></script>
</body>
</html>