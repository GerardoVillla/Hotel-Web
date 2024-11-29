import { cookiesCarrito } from './cookiesCarrito.js';

document.getElementById('cerrarSesion').addEventListener('click', function(){
    window.location.href = '../../../index.php';
});

function verificarCampos(){
    const titular = document.getElementById("titular").value.trim();
    const numeroTarjeta = document.getElementById("numeroTarjeta").value.trim();
    const cvv = document.getElementById("cvv").value.trim();

    if (!/^[a-zA-Z\s]+$/.test(titular)) {
        alert("El campo 'Titular' solo puede contener letras y espacios.");
        return false;
    }

    if (!/^\d+$/.test(numeroTarjeta)) {
        alert("El campo 'Número de tarjeta' solo puede contener números.");
        return false;
    }

    if (!/^\d{3}$/.test(cvv)) {
        alert("El campo 'CVV' debe contener exactamente 3 dígitos.");
        return false;
    }

    alert("Pago procesado con éxito.");
    return true;
}

function pagar() {
    const habitacionesReservaciones = cookiesCarrito.obtenerHabitacionesDelCarrito();
    let salioBien = true; // Indicador de éxito global

    for (const idHabitacion of habitacionesReservaciones) {
        const idHab = idHabitacion;
        const idCliente = document.getElementById('idUsuario').value;
        const fechaRes = new Date().toISOString().split('T')[0]; // Formato YYYY-MM-DD
        const inicioEstadia = cookiesCarrito.obtenerCookie('entrada' + idHabitacion);
        const finEstadia = cookiesCarrito.obtenerCookie('salida' + idHabitacion);
        const subtotal = cookiesCarrito.obtenerCookie('total' + idHabitacion);

        // Llama a la función que procesa la reservación
        const resultado = agregarUnaReservacion(idHab, idCliente, fechaRes, inicioEstadia, finEstadia, subtotal);

        if (!resultado) {
            console.error(`Error al procesar la reservación para la habitación ${idHab}`);
            salioBien = false;
        }else{
            cookiesCarrito.eliminarCookie('entrada' + idHabitacion);
            cookiesCarrito.eliminarCookie('salida' + idHabitacion);
            cookiesCarrito.eliminarCookie('total' + idHabitacion);
            cookiesCarrito.eliminarCookie('habitacion' + idHabitacion);
        }
    }
    cookiesCarrito.eliminarTodasabitacionesDelCarrito();
    //cookiesCarrito.eliminarTodasLasCookies();
    return salioBien;
}

function agregarUnaReservacion(idHab,idCliente,fecharRes,inicioEstadia,finEstadia,subtotal){
    const data = new FormData();
    data.append("idHabitacion", idHab);
    data.append("idCliente", idCliente);
    data.append("fechaReservacion", fecharRes);
    data.append("inicioEstadia", inicioEstadia);
    data.append("finEstadia", finEstadia);
    data.append("subtotal", subtotal);
    // Realizar la petición AJAX usando fetch
    fetch("../../servidor/pagar.php", {
        method: "POST",
        body: data,
    })
    .then(response => response.json()) // Parsear respuesta como JSON
    .then(data => {
        // Mostrar el mensaje devuelto por PHP
        alert(data.mensaje);
        return true;
    })
    .catch(error => {
        console.error("Error al llamar a PHP:", error);
        return true;
    });
}

function calcularTotal(){
    const habitacionesReservaciones = cookiesCarrito.obtenerHabitacionesDelCarrito();
    let total = 0.00;
    for (const idHabitacion of habitacionesReservaciones) {
        let totalPorHabitacion = parseFloat( cookiesCarrito.obtenerCookie('total'+idHabitacion) );
        total += totalPorHabitacion;
    }
    return total+"";
}

document.addEventListener('DOMContentLoaded', function(){
    const total = document.getElementById("total");
    total.value = calcularTotal();

    document.getElementById("btnPagar").addEventListener("click", function(){
        if(verificarCampos()){
            if(pagar()){
                alert('pago procesado con exito');
            }
            document.location = "../view/principal.php";
        }
    })
    
    document.getElementById("btnCancelar").addEventListener('click', function(){
        document.location = "../view/pagar.php";

    })
});