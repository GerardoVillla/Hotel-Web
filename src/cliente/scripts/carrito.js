import { cookiesCarrito } from './cookiesCarrito.js';

function anadirReservaAlCarrito() {
    const habitacion = document.getElementById('idhabitacion').value;
    cookiesCarrito.agregarHabitacionAlCarrito(habitacion);

    const entrada = document.getElementById('entrada').value;
    document.cookie = `entrada${habitacion}=${entrada}; expires=${cookiesCarrito.fechaExpiracionDefault()}; path=/`;


    const salida = document.getElementById('salida').value;
    document.cookie = `salida${habitacion}=${salida}; expires=${cookiesCarrito.fechaExpiracionDefault()}; path=/`;

    const numPersonas = document.getElementById('numPersonas').value;
    document.cookie = `habitacion${habitacion}=${numPersonas}; expires=${cookiesCarrito.fechaExpiracionDefault()}; path=/`;

    const total = document.getElementById('total').textContent
    document.cookie = `total${habitacion}=${total}; expires=${cookiesCarrito.fechaExpiracionDefault()}; path=/`;
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

    const elements = {
        entrada: document.getElementById('entrada'),
        salida: document.getElementById('salida'),
        numPersonas: document.getElementById('numPersonas'),
        costoPorNoche: parseFloat("<?php echo $registro['costoPorNoche']; ?>"),
        totalDiv: document.getElementById('total') // Cambió de etiqueta a un div
    };

    const calcularTotal = () => {
        const fechaEntrada = new Date(elements.entrada.value);
        const fechaSalida = new Date(elements.salida.value);
        const personas = parseInt(elements.numPersonas.value) || 1;

        if (fechaEntrada && fechaSalida && fechaSalida > fechaEntrada) {
            const tiempoEstadia = Math.ceil((fechaSalida - fechaEntrada) / (1000 * 60 * 60 * 24)); // Días
            const total = tiempoEstadia * elements.costoPorNoche * personas;
            elements.totalDiv.textContent = `$${total.toFixed(2)}`; // Usa el div aquí
        } else {
            elements.totalDiv.textContent = "$0.00";
        }
    };

    ['change', 'input'].forEach(evento => {
        elements.entrada.addEventListener(evento, calcularTotal);
        elements.salida.addEventListener(evento, calcularTotal);
        elements.numPersonas.addEventListener(evento, calcularTotal);
    });


    document.querySelector('#btn_anadir').onclick = function () {
        if (verificar()) { // Solo si pasa la verificación
            anadirReservaAlCarrito();
            window.location.replace("../view/principal.php");
        }
    }
});
                                                     