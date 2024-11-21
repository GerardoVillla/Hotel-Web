<?php
require_once ("../../servidor/sesion.php");
validarSesionAdministrador();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/edithabitacion-styles.css" type="text/css">
    <title>Editar habitacion</title>
</head>
<body>
    <header>
        <h1>Hotel ecologico Ek' Balam</h1>
    </header>
    <form id="grid" method="get" enctype="multipart/form-data" >
        <div id="etiquetas">
            <p><b>Nombre:</b></p>
            <p><b>Categoria (tipo):</b></p>
            <p><b>Habitaciones:</b></p>
            <p><b>Hab. disponibles:</b></p>
            <p><b>Cap. personas:</b></p>
            <p><b>Costo: $</b></p>
        </div>
        <div id="entradas">
            <input type="text" id="txt_nombre" name="Nombre" onkeyup="mostrar(this.value, 'nombre_habitacion')">

                <select name="Categoria" id="txt_categoria" onchange="mostrar(this.value , 'categoria_habitacion')">
                    <option value="" selected disabled hidden></option>
                    <option value="Estandar">Estandar</option>
                    <option value="Deluxe">Deluxe</option>
                    <option value="Suite">Suite</option>
                </select>
            <input type="number" id="txt_habitaciones" name="Habitaciones" min="0" max="50" oninput="mostrar(this.value, 'info_habitaciones')">
            <input type="number" id="txt_habdisponibles" name="Habitaciones disponibles" min="0" max="50" oninput="mostrar(this.value, 'info_disponibles');">
            
            <input type="number" id="txt_capacidad" name="Capacidad" min="0" max="10" oninput="mostrar(this.value,'info_cap_personas')">

            <p><input type="text" id="txt_costo" onkeyup="mostrar(this.value,'info_Costo')" oninput="soloNumeros(this)"></p>
        </div>
        <div id="descripcion">
            <p><b>Descripcion:</b></p>
            <textarea id="t_area_descripcion" onkeyup="mostrar(this.value,'info_descripcion')"></textarea>
        </div>
        <div id="btns_vista_prev">
            <p><b>Cambiar imagen:   </b><input type="file" id="btn_cambiarimg" accept="image/*" onchange="PrevisualizarImagen(event)"></p>
        </div>
        <div id="imagen">
            <img id="imagen-prev" src="../assets/img/home/deluxe.jpg" alt="Previsualización de la Imagen" accept="image/*">
        </div>
        <div id="vista_previa">
            <h2 id="id_habitacion">ID</h2>
            <h2 id="nombre_habitacion">Nombre</h2>
            <h3 id="categoria_habitacion">Categoria</h3>
            <p id="info_descripcion">Lorem ipsum dolor sit amet consectetur adipisicing elit. Ad doloremque eum cum? Eligendi id vitae dicta perferendis magnam dignissimos voluptatum. Ducimus, in labore. Amet magnam, ducimus necessitatibus facilis explicabo iusto.</p>
            <p id="info_habitaciones"><b>Habitaciones:</b></p>
            <p id="info_disponibles"><b>Habitaciones disponibles:</b></p>
            <p id="info_cap_personas"><b>Cap. Personas:</b></p>
            <p id="info_Costo"><b>Costo:</b></p>
        </div>
        <div  id="btns_verificacion">
            <button class="btn" id="btn_guardar">
                Guardar
            </button>
            <button class="btn" id="btn_cancelar" href="">
                Cancelar
            </button>
        </div>
    </form>
    <footer>
        <p>@todos los derechos reservados</p>
    </footer>
    <script src="../scripts/edithabitacion.js"></script>
</body>
</html>