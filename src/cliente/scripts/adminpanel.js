


//Carga las habitaciones disponibles de la base de datos
document.addEventListener('DOMContentLoaded', () => {
    actualizarHabitacionEnLista();  
    cargarTodasHabitaciones();
});

//Filtra por categorias de habitaciones
const contenedorCuartos = document.getElementById('seccion-habitaciones');
const listaCuartos = contenedorCuartos.querySelector('#lista-cuartos');
const selectCuarto = document.getElementById('Categorias-cuarto');
selectCuarto.addEventListener('change', () => {
    const selectCuarto = document.getElementById('Categorias-cuarto');
    const tipoSeleccionado = selectCuarto.value;
    if (tipoSeleccionado === 'Todas') {
        cargarTodasHabitaciones();
        return;
    }
    console.log("Filtrando habitaciones")
    fetch(`../../servidor/habitacion.php?action=filtrar&categoria=${tipoSeleccionado}`)
    .then(response => response.text())
    .then(html => {
            listaCuartos.innerHTML = html;
    })
    .catch(error => console.error('Error al filtrar habitaciones:', error));
});


function cargarTodasHabitaciones(){
    const selectCuarto = document.getElementById('Categorias-cuarto');
    console.log(selecc_cuarto);
    const contenedorCuartos = document.getElementById('seccion-habitaciones');
    console.log("C1")
    if (selectCuarto && contenedorCuartos) {
        const listaCuartos = contenedorCuartos.querySelector('#lista-cuartos');
        
        fetch('../../servidor/habitacion.php?action=listar')
        .then(response => response.text())
        .then(html => {
            listaCuartos.innerHTML = html;
            console.log("Insertando habitaciones desde la base de datos")
        })
        .catch(error => console.error('Error al cargar habitaciones:', error));

    } else {
        console.log("El elemento 'tipoCuarto' o 'contenedorCuartos' no se encontró.");
    }
}


function selecc_cuarto(element) {
    document.querySelectorAll('.habitacion-propiedades').forEach(card => {
        card.classList.remove('selected');
    });
    element.classList.add('selected');
}

function dirigirAeditar(modo) {
    const HabElegida = document.querySelector('.habitacion-propiedades.selected');

    if (modo === 'editar' && !HabElegida) {
        alert('Por favor, selecciona una habitación para editar.');
        return;
    }

    localStorage.setItem('ModoEdit', modo);

    if (modo === 'editar' && HabElegida) {
        // Extrae la información de la habitación seleccionada
        const HabInfo = {
            nombre: HabElegida.querySelector('#nombre-habitacion').textContent,
            categoria: HabElegida.querySelector('#categoria-habitacion').textContent,
           /* disponibilidad: HabElegida.querySelector('#disponibilidad-habitacion').textContent,*/
            cantidad: HabElegida.querySelector('#cantidad-habitacion').textContent,
            cantidadDisponible: HabElegida.querySelector('#cantidad-disponible').textContent,
            costo: HabElegida.querySelector('#costo-habitacion').textContent.replace('$','').trim(),
            imagen: HabElegida.querySelector('img').src
        };

        localStorage.setItem('HabElegida', JSON.stringify(HabInfo));
    } else {
        localStorage.removeItem('HabElegida');
    }
    window.location.href = 'edithabitacion.html';
}

function actualizarHabitacionEnLista() {
    const HabInfo = JSON.parse(localStorage.getItem('HabElegida'));
    console.log("if(HabInfo)");
    if (HabInfo) {
        // Buscar habitación existente o crear nueva
        let habitacion = document.querySelector(`[data-tipo="${HabInfo.nombre}"]`);
        if (!habitacion) {
            console.log("añadiendo a lista");
            habitacion = document.createElement('li');
            habitacion.classList.add('habitacion-propiedades');
            habitacion.dataset.tipo = HabInfo.nombre;
            document.getElementById('lista-cuartos').appendChild(habitacion);
        }

        // Actualiza o crea el contenido de la habitación
        habitacion.innerHTML = `
            <img src="${HabInfo.imagen}" alt="">
            <div class="detalles-habitacion">
                <h2 id="nombre-habitacion">${HabInfo.nombre}</h2>
                <p><strong>Categoría:</strong> <span id="categoria-habitacion">${HabInfo.nombre}</span></p>
                <p><strong>Disponibilidad:</strong> <span id="disponibilidad-habitacion">Disponible</span></p>
                <p><strong>Habitaciones:</strong> <span id="cantidad-habitacion">${HabInfo.cantidad}</span></p>
                <p><strong>Hab. disponibles:</strong> <span id="cantidad-disponible">${HabInfo.cantidadDisponible}</span></p>
                <p><strong>Costo:</strong> <span id="costo-habitacion">$${HabInfo.costo}</span></p>
            </div>
        `;
    }
}

function eliminarHab() {
    const HabElegida = document.querySelector('.habitacion-propiedades.selected');
    if (!HabElegida) {
        alert('Por favor, selecciona una habitación para eliminar.');
        return;
    }
    // Confirmación de eliminación (cambiar)
    const confirmacion = confirm('¿Estás seguro de que deseas eliminar esta habitación?');
    if (!confirmacion) return;
    // Obtener el nombre de la habitación seleccionada
    const nombreHabitacion = HabElegida.querySelector('#nombre-habitacion').textContent;
    // Obtener la lista de habitaciones de localStorage
    let listaHabitaciones = JSON.parse(localStorage.getItem('listaHabitaciones')) || [];
    // Filtrar la habitación a eliminar y actualizar la lista en localStorage
    listaHabitaciones = listaHabitaciones.filter(habitacion => habitacion.nombre !== nombreHabitacion);
    localStorage.setItem('listaHabitaciones', JSON.stringify(listaHabitaciones));
    // Remover la habitación del DOM
    HabElegida.remove();

    alert(`La habitación "${nombreHabitacion}" ha sido eliminada.`);
}