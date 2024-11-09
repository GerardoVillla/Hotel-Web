document.addEventListener('DOMContentLoaded', () => {
    const modo = localStorage.getItem('ModoEdit');
    const HabInfo = JSON.parse(localStorage.getItem('HabElegida'));
    
    const categoriaElemento = document.getElementById('txt_categoria');
    console.log("Antes del if  (modo === 'editar' && HabInfo)");
    if (modo === 'editar' && HabInfo) {
        console.log("Estoy en if (modo === 'editar' && HabInfo) ");
        // Cargar previsualización
        document.getElementById('titulo_habitacion').textContent = HabInfo.nombre;
        document.getElementById('info_descripcion').textContent = HabInfo.descripcion;
        document.getElementById('info_habitaciones').innerHTML = '<b>Habitaciones: </b>' + HabInfo.cantidad;
        document.getElementById('info_disponibles').innerHTML =  '<b>Habitaciones disponibles: </b>'+ HabInfo.cantidadDisponible;
        document.getElementById('info_Costo').innerHTML = '<b>Costo: </b>'+ HabInfo.costo;
        
        // Actualizar imagen
        const imagenPrevisualizacion = document.getElementById('imagen-prev');
        imagenPrevisualizacion.src = HabInfo.imagen;
        //imagenPrevisualizacion.innerHTML = `<img src="${HabInfo.imagen}" alt="Imagen de ${HabInfo.nombre}">`;

        document.getElementById('txt_categoria').value = HabInfo.categoria || '';
       // document.getElementById('txt_disponibilidad').value = HabInfo.disponibilidad || '';
        document.getElementById('txt_habitaciones').value = HabInfo.cantidad || '';
        document.getElementById('txt_habdisponibles').value = HabInfo.cantidadDisponible || '';
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
                    /*
                    nombre: Categoria,
                    cantidad: Habs,
                    cantidadDisponible: HabsDisp,
                    costo: Costo,
                    imagen: document.getElementById('imagen-prev').src
                `   */
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

function mostrar(valor, id){
    
    switch(id){
        case('titulo_habitacion'):
            document.getElementById(id).textContent = valor;
            break;
        case('info_disponibilidad'):
            const totalHabitaciones = parseInt(document.getElementById('txt_habitaciones').value) || 0;
            const habDisponibles = parseInt(document.getElementById('txt_habdisponibles').value) || 0;
            const disponibilidad = totalHabitaciones - habDisponibles;
            document.getElementById(id).innerHTML = "<b>Disponibilidad: </b>" + Math.max(disponibilidad, 0);
            break;
        case('info_habitaciones'):
            document.getElementById(id).innerHTML = "<b>Habitaciones: </b>" + valor;
            break;
        case('info_Costo'):
            document.getElementById(id).innerHTML = "<b>Costo: </b>" + "$" + valor;
            break;
        case('info_disponibles'):
            document.getElementById(id).innerHTML = "<b>Habitaciones disponibles: </b>" + valor;
            break;
        case('info_descripcion'):
            document.getElementById(id).textContent = valor;
            break;
    }
}

function soloNumeros(input) {
    input.value = input.value.replace(/[^0-9]/g, ''); // Reemplaza cualquier cosa que no sea número
}

function aAdmin(){
    window.location.href = 'adminpanel.html';
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
