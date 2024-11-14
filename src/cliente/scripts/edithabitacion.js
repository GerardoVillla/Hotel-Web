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
        
        console.log("Añadir");
        const input = document.createElement('input');
        input.type = 'text';
        input.id = 'txt_categoria'; 
        categoriaElemento.replaceWith(input);
        const desc= document.getElementById('info_descripcion');
        desc.textContent= " "
    }
    console.log("GG");

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
                const HabInformacion = {
                    nombre: document.getElementById('txt_categoria').value,
                    cantidad: document.getElementById('txt_habitaciones').value,
                    cantidadDisponible: document.getElementById('txt_habdisponibles').value,
                    costo: document.getElementById('txt_costo').value,
                    imagen: document.getElementById('imagen-prev').src
                    };

                
                localStorage.setItem('HabElegida', JSON.stringify(HabInformacion));
                localStorage.setItem('ModoEdit', 'añadir');
                
                let listaHabitaciones = JSON.parse(localStorage.getItem('listaHabitaciones')) || [];
                if (modo === 'editar') {
                    listaHabitaciones = listaHabitaciones.map(hab => 
                        hab.nombre === HabInfo.nombre ? { ...hab, ...HabInformacion } : hab
                    );
                } else {
                    listaHabitaciones.push(HabInformacion);
                }

                localStorage.setItem('listaHabitaciones', JSON.stringify(listaHabitaciones));
                let listaCategorias = JSON.parse(localStorage.getItem('listaCategorias')) || [];
                if (!listaCategorias.includes(Categoria)) {
                    listaCategorias.push(Categoria); // Añadir nueva categoría si no existe
                    localStorage.setItem('listaCategorias', JSON.stringify(listaCategorias));
                }

                aAdmin();
            }
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


function obtenerDescripcion(id, HabInfo){
    fetch(`../../servidor/habitacion.php?action=obtenerDescripcion&id=${id}`)
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.text();
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
