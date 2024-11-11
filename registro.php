<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/ecologico/src/cliente/css/registro.css">
    <title>Document</title>
</head>
<body>
    <div id="imagen-seccion">
        
    </div>
    <div id="formulario-seccion">
        <div id="botones-nav">
            <input type="button"name="iniciosesion" value="Iniciar sesi&oacute;n" id="btn_iniciarSPag">
            <input type="button"name="iniciosesion" value="Registrarse" id="btn_RegistrarsePag">
        </div>
        <div id="formulario-contenedor">
            <form method="post" enctype="application/x-www-form-urlencoded" action="/ecologico/src/servidor/autenticacion.php">
            <input type="hidden" name="action" value="registrarUsuario">
                Nombre:
                <br><br><br>
                <input type="text" maxlength="35" size="35" name="txt_nombre" id="txt_nombre">
                <br><br><br>
                Contraseña:
                <br><br><br>
                <input type="password" maxlength="35" size="35" name="pass_contraseña" id="pass_contraseña">
                <br><br><br>
                Confirmar contraseña:
                <br><br><br>
                <input type="password"
                maxlength="35" size="35" name="pass_contraseña_2" id="pass_contraseña_2">
                <br><br><br>
                <input type="submit" name="iniciosesion" value="Registrarse" id="btn_Registro">
            </form>
        </div>
    </div>
    <script src="/ecologico/src/cliente/scripts/index.js"></script>
</body>
</html>