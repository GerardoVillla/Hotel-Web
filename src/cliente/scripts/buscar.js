/*document.addEventListener('DOMContentLoaded', () => {
    const forma = document.querySelector('form');
    const resultados = document.querySelector('.habitacionesscroller');

    forma.addEventListener('submit', async (event) => {
        event.preventDefault(); 
        
        const formaDatos = new FormData(forma);
        const datos = Object.fromEntries(formaDatos.entries());

        try {
            const response = await fetch('', {
                method: 'POST',
                body: new URLSearchParams(datos),
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' }
            });

            const html = await response.text();
            const parser = new DOMParser();
            const doc = parser.parseFromString(html, 'text/html');
            const newResults = doc.querySelector('.habitacionesscroller');

            if (newResults) {
                resultados.innerHTML = newResults.innerHTML;
            }
        } catch (error) {
            console.error('Error al buscar habitaciones:', error);
        }
    });
});*/
//aun no funciona
document.getElementById('Form').addEventListener('submit', function(event) {
    event.preventDefault();  // Evita el comportamiento predeterminado del formulario

});

document.addEventListener("DOMContentLoaded", function () {
    const formulario = document.querySelector("form");

    formulario.addEventListener("submit", function (e) {
        e.preventDefault(); // Evita el envío automático del formulario

        // Eliminar mensajes de error previos
        const mensajeExistente = document.querySelector(".error-mensaje");
        if (mensajeExistente) {
            mensajeExistente.remove();
        }

        // Obtener los valores del formulario
        const tipoHabitacion = formulario.querySelector('select[name="TipoHab"]').value;
        const fechaEntrada = formulario.querySelector('input[name="FechaEntrada"]').value;
        const fechaSalida = formulario.querySelector('input[name="FechaSalida"]').value;
        const personas = formulario.querySelector('input[name="Personas"]').value;

        let errores = [];

        // Validaciones
        if (!tipoHabitacion) errores.push("Selecciona un tipo de habitación.");
        if (!fechaEntrada) errores.push("Selecciona una fecha de entrada.");
        if (!fechaSalida) errores.push("Selecciona una fecha de salida.");
        if (!personas || personas <= 0) errores.push("Ingresa un número válido de personas.");
        if (fechaEntrada && fechaSalida && new Date(fechaEntrada) >= new Date(fechaSalida)) {
            errores.push("La fecha de entrada debe ser anterior a la fecha de salida.");
        }

        // Mostrar errores o enviar el formulario
        if (errores.length > 0) {
            const mensajeError = document.createElement("div");
            mensajeError.classList.add("error-mensaje");
            mensajeError.innerHTML = errores.map(error => `<p>${error}</p>`).join("");
            formulario.after(mensajeError); // Insertar después del formulario
        } else {
            // Si no hay errores, envía el formulario
            formulario.submit();
        }
    });
});