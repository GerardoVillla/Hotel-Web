document.addEventListener('DOMContentLoaded', () => {
    const modo = localStorage.getItem('ModoEdit');
    const HabInfo = JSON.parse(localStorage.getItem('HabElegida'));
    
    const categoriaElemento = document.getElementById('txt_categoria');
    console.log("Antes del if  (modo === 'editar' && HabInfo)");
    if (modo === 'editar' && HabInfo) {
        console.log("Estoy en if (modo === 'editar' && HabInfo) ");
        //Recupera la descripcion de la habitacion desde la base de datos
        obtenerDescripcion(HabInfo.codigo, HabInfo);

        // AREA DE PREVISUALIZACION
        document.getElementById('id_habitacion').innerHTML = '<b>Id: </b>'+ HabInfo.codigo;
        document.getElementById('nombre_habitacion').textContent = HabInfo.nombre;
        document.getElementById('categoria_habitacion').textContent = HabInfo.categoria;
        document.getElementById('info_habitaciones').innerHTML = '<b>Habitaciones: </b>' + HabInfo.cantidad;
        document.getElementById('info_disponibles').innerHTML =  '<b>Habitaciones disponibles: </b>'+ HabInfo.cantidadDisponible;
        document.getElementById('info_cap_personas').innerHTML = '<b>Cap. personas: </b>'+ HabInfo.capacidadPersonas;
        document.getElementById('info_Costo').innerHTML = '<b>Costo: </b>'+ HabInfo.costo;
        document.getElementById('info_descripcion').src = HabInfo.descripcion;
        document.getElementById('info_descripcion').textContent = HabInfo.descripcion;
        
        //AREA DEL EDITOR
        // Actualizar imagen
        const imagenPrevisualizacion = document.getElementById('imagen-prev');
        imagenPrevisualizacion.src = HabInfo.imagen;
        //imagenPrevisualizacion.innerHTML = `<img src="${HabInfo.imagen}" alt="Imagen de ${HabInfo.nombre}">`;
        document.getElementById('txt_nombre').value = HabInfo.nombre || '';
        document.getElementById('txt_categoria').value = HabInfo.categoria || '';
        document.getElementById('txt_habitaciones').value = HabInfo.cantidad || '';
        document.getElementById('txt_habdisponibles').value = HabInfo.cantidadDisponible || '';
        document.getElementById('txt_capacidad').value = HabInfo.capacidadPersonas || '';
        document.getElementById('txt_costo').value = HabInfo.costo || '';
        
    }
    if(modo ==='añadir'){
        const id_habitacion = document.getElementById('id_habitacion');
        id_habitacion.style.display = 'none';
        console.log("Añadir");
    }
    
    const btnGuardar = document.getElementById('btn_guardar');
    const btnCancelar = document.getElementById('btn_cancelar');

    if (btnGuardar) {
        console.log("Guardar");
        btnGuardar.addEventListener('click', () => {
            event.preventDefault();  // Prevenir el comportamiento de recarga
            const Habs = parseInt(document.getElementById("txt_habitaciones").value);
            const HabsDisp = parseInt(document.getElementById("txt_habdisponibles").value);
            const Categoria = document.getElementById("txt_categoria").value; 
            const  Costo = document.getElementById("txt_costo").value;
            if(Habs<HabsDisp){
                alert("La cantidad de habitaciones disponibles es mayor a la cantidad de habitaciones totales");
            }else if(!Habs || !HabsDisp || !Categoria || !Costo){
                alert("Todos los campos deben tener valor");
            }else{
                console.log("Creando cambio");
                let img = document.getElementById('btn_cambiarimg').files[0];
                const HabInformacionAEnviar = {
                    nombre: document.getElementById('txt_nombre').value,
                    categoria: document.getElementById('txt_categoria').value,
                    descripcion: document.getElementById('t_area_descripcion').value,
                    numHabitaciones: document.getElementById('txt_habitaciones').value,
                    disponibles: document.getElementById('txt_habdisponibles').value,
                    capacidadDePersonas: document.getElementById('txt_capacidad').value,
                    costoPorNoche: document.getElementById('txt_costo').value,
                    urlImagen: img.name,
    
                };

                    if(modo === 'añadir'){
                        console.log("Creando habitacion");
                        console.log(HabInformacionAEnviar);
                        crearHabitacionEnServidor(HabInformacionAEnviar);
                    }else{
                        actualizarHabitacionEnServidor(HabInformacionAEnviar, HabInfo.codigo);
                    }
                    

            }
            alert("Cambios guardados");
            aAdmin();
        });
    }
    if (btnCancelar) {
        btnCancelar.addEventListener('click', () => {
            event.preventDefault();  // Prevenir el comportamiento de recarga
            console.log("Cancelar");
            localStorage.removeItem('ModoEdit');
            localStorage.removeItem('HabElegida');
            console.log("Btn cancelar");
            aAdmin();
        });
    }
});

function actualizarHabitacionEnServidor(HabInformacionAEnviar, id) {
    // Idenfiticar los campos que sufrieron cambios
    console.log("Entrando a metodo para actualizar habitacion");
    const datosIniciales = JSON.parse(localStorage.getItem('HabElegida'));
    for (const key in HabInformacionAEnviar) {
        if (HabInformacionAEnviar[key] !== datosIniciales[key]) {
            console.log("Actualizando habitacion en servidor");
            const argumentos = new URLSearchParams();
            argumentos.append('action', 'actualizar');
            argumentos.append('id', id);
            argumentos.append("campo", key);
            argumentos.append("valor", HabInformacionAEnviar[key]);
            fetch('../../servidor/habitacion.php', {
                method: 'POST',
                body: argumentos
            }).then(respuesta => respuesta.text())
            .then(resultado => {
                console.log(resultado);
            })
            console.log(argumentos);
        }
    }
    


}

function crearHabitacionEnServidor(HabInformacionAEnviar){
    const argumentos = new URLSearchParams();
    argumentos.append('action', 'crear');
    Object.keys(HabInformacionAEnviar).forEach(key => argumentos.append(key, HabInformacionAEnviar[key]));
    fetch('../../servidor/habitacion.php', {
        method: 'POST',
        body: argumentos
    }).then(respuesta =>respuesta.text())
    .then(resultado => {

    })
    console.log(argumentos);
}

function obtenerDescripcion(id, HabInfo){
    const argumentos = new URLSearchParams();
    argumentos.append('action', 'obtenerDescripcion');
    argumentos.append('id', id);
    fetch('../../servidor/habitacion.php', {
        method: 'POST',
        body: argumentos
    })
        .then(respuesta => {
            if (!respuesta.ok) {
                throw new Error('La respuesta no fue bien recibida');
            }
            return respuesta.text();
        })
        .then(descripcion => {
            // Guardar la descripción en HabInfo
            HabInfo.descripcion = descripcion;

            // Actualizar el localStorage con la nueva información
            localStorage.setItem('HabElegida', JSON.stringify(HabInfo));

            // Mostrar la descripción en el elemento correspondiente

            document.getElementById('t_area_descripcion').value = descripcion;
            document.getElementById('info_descripcion').value = descripcion;
        })
        .catch(error => console.error('Error al enviar la petición:', error))
}

function mostrar(valor, id){
    
    switch(id){
        case('nombre_habitacion'):
            document.getElementById(id).textContent = valor;
            break;
        case('categoria_habitacion'):
            document.getElementById(id).textContent = valor;
            break;    
        case('info_habitaciones'):
            document.getElementById(id).innerHTML = "<b>Habitaciones: </b>" + valor;
            break;
        case('info_disponibles'):
            document.getElementById(id).innerHTML = "<b>Habitaciones disponibles: </b>" + valor;
            break;
        case('info_descripcion'):
            document.getElementById(id).textContent = valor;
            break;
        case('info_cap_personas'):
            document.getElementById(id).innerHTML = "<b>Cap. personas: </b>" + valor;
            break;
        case('info_Costo'):
            document.getElementById(id).innerHTML = "<b>Costo: </b>" + "$" + valor;
            break;
    }
}

function soloNumeros(input) {
    input.value = input.value.replace(/[^0-9]/g, ''); // Reemplaza cualquier cosa que no sea número
}

function aAdmin(){
    window.location.href = 'adminpanel.php';
}

function PrevisualizarImagen(event){
    const input = event.target;
    const file = input.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            const imagen = document.getElementById('imagen-prev');
            imagen.src = e.target.result;
            imagen.style.display = 'block';
        };
        reader.readAsDataURL(file);
    }
}
