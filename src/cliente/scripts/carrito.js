import { cookiesCarrito } from './cookiesCarrito.js';

function anadirReservaAlCarrito() {
    const habitacion = document.getElementById('idhabitacion').value;
    cookiesCarrito.agregarHabitacionAlCarrito(habitacion);

    const entrada = document.getElementById('entrada').value;
    document.cookie = `entrada${habitacion}=${entrada}; expires=${cookiesCarrito.fechaExpiracionDefault()}; path=/`;


    const salida = document.getElementById('salida').value; // Cambiado de vale a value
    document.cookie = `salida${habitacion}=${salida}; expires=${cookiesCarrito.fechaExpiracionDefault()}; path=/`;

    const numPersonas = document.getElementById('numPersonas').value; // Cambiado de vale a value
    document.cookie = `habitacion${habitacion}=${numPersonas}; expires=${cookiesCarrito.fechaExpiracionDefault()}; path=/`;
}

function verificar() {
    const entrada = document.getElementById('entrada').value;
    const salida = document.getElementById('salida').value;
    const numPersonas = document.getElementById('numPersonas').value;

    let mensajeError = '';

    const fechaActual = new Date().toISOString().split('T')[0];

    if (!entrada) {
        mensajeError += 'El día de entrada es obligatorio. <br>';
    } else if (entrada < fechaActual) {
        mensajeError += 'La fecha de entrada no puede ser anterior a la fecha actual. <br>';
    }

    if (!salida) {
        mensajeError += 'El día de salida es obligatorio. <br>';
    } else if (entrada && salida && new Date(entrada) > new Date(salida)) {
        mensajeError += 'La fecha de salida no puede ser anterior a la fecha de entrada. <br>';
    }

    if (!numPersonas || numPersonas < 1 || numPersonas > 10) {
        mensajeError += 'El número de personas debe estar entre 1 y 10. <br>';
    }

    const mensajeDiv = document.getElementById('mensaje');

    if (mensajeError) {
        mensajeDiv.innerHTML = mensajeError;
        mensajeDiv.style.color = 'red';
        return false;
    } else {
        mensajeDiv.innerHTML = 'Formulario validado correctamente.';
        mensajeDiv.style.color = 'green';
        return true;
    }
}

document.addEventListener('DOMContentLoaded', function () {

    document.querySelector('#btn_anadir').onclick = function () {
        if (verificar()) { // Solo si pasa la verificación
            anadirReservaAlCarrito();
            window.location.replace("../view/principal.php");
        }
    }
});
                                                     