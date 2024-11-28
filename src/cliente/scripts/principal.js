import { cookiesCarrito } from './cookiesCarrito.js';

document.addEventListener("DOMContentLoaded", () => {
    const carrusel = document.getElementById("carrusel");
    const prevBtn = document.getElementById("prev");
    const nextBtn = document.getElementById("next");
    let currentPosition = 0;

    // Función para inicializar el carrusel después de cargar los datos
    const inicializarCarrusel = () => {
        const tarjeta = document.querySelector(".tarjeta-habitacion");
        if (!tarjeta) {
            console.error("No se encontraron tarjetas de habitación.");
            return;
        }

        // Calcular el ancho de una tarjeta (incluyendo el gap)
        const cardWidth = tarjeta.offsetWidth + 16;

        // Agregar funcionalidad a los botones
        prevBtn.addEventListener("click", () => {
            currentPosition = Math.min(currentPosition + cardWidth, 0);
            carrusel.style.transform = `translateX(${currentPosition}px)`;
        });

        nextBtn.addEventListener("click", () => {
            const maxScroll = -(carrusel.scrollWidth - carrusel.parentElement.offsetWidth);
            currentPosition = Math.max(currentPosition - cardWidth, maxScroll);
            carrusel.style.transform = `translateX(${currentPosition}px)`;
        });
    };

    function mostrarHabitacion(id) {
        fetch("../../servidor/carrusel.php")
            .then(response => response.json())
            .then(data => {
                const habitacion = data.find(h => h.idhabitacion === id);
                if (!habitacion) {
                    console.error("Habitación no encontrada.");
                    return;
                }
    
                // Crear el contenedor flotante
                const contenedor = document.createElement("div");
                contenedor.className = "contenedor";
    
                // Crear la tabla con la información
                const tabla = document.createElement("table");
                tabla.innerHTML = `
                    <tr>
                        <td id="imgsection">
                            <img class="imgHab" src="../recursos/img/habitaciones/${habitacion.URLImagen}" alt="Imagen de la habitación">
                        </td>
                        <td id="infosection">
                            <button id="btnCerrarInfo" class="cerrar-btn">
                                <img src="../recursos/img/iconos/cerrarInformacion.png" alt="Cerrar">
                            </button>
                            <h1 class="playfair-display-titulo">${habitacion.nombre}</h1>
                            <p class="playfair-display-parrafo">${habitacion.descripcion}</p>
                            <h5 class="playfair-display-subtitulo">
                                Categoría: ${habitacion.categoria}<br>
                                Capacidad de personas: ${habitacion.capacidadDePersonas}<br>
                                Número de habitaciones: ${habitacion.numHabitaciones}<br>
                                Disponibles: ${habitacion.disponibles}<br>
                                Costo por noche: ${habitacion.costoPorNoche}<br>
                            </h5>
                            <button id="btnReservar">Reservar</button>
                        </td>
                    </tr>
                `;
    
                // Agregar eventos a los botones
                const cerrarBtn = tabla.querySelector("#btnCerrarInfo");
                cerrarBtn.addEventListener("click", () => {
                    document.body.removeChild(contenedor);
                });
    
                const reservarBtn = tabla.querySelector("#btnReservar");
                reservarBtn.addEventListener("click", () => {
                    window.location.href = "reservar.php";
                });
    
                // Agregar la tabla al contenedor
                contenedor.appendChild(tabla);
    
                // Añadir el contenedor al cuerpo del documento
                document.body.appendChild(contenedor);
            })
            .catch(error => console.error("Error al cargar la habitación:", error));
    }
    

    // Cargar datos del carrusel dinámicamente
    fetch("../../servidor/carrusel.php")
        .then(response => response.json())
        .then(data => {
            data.forEach((habitacion) => {
                // Crear cada tarjeta de habitación
                const tarjeta = document.createElement("a");
                tarjeta.className = "tarjeta-habitacion";
                tarjeta.id = `${habitacion.idhabitacion}`;
                tarjeta.href = "#";
                tarjeta.innerHTML = `
                    <img src="../recursos/img/habitaciones/${habitacion.URLImagen}" alt="img ${habitacion.nombre}">
                    <div class="descripcion-articulo">
                        <h2 class="playfair-display-titulo">${habitacion.nombre}</h2>
                        <p class="playfair-display-parrafo">${habitacion.descripcion}</p>
                        <h3 class="playfair-display-subtitulo">MXN ${habitacion.costoPorNoche}</h3>
                    </div>
                `;
                // Agregar el evento de clic directamente
                tarjeta.addEventListener("click", (e) => {
                    e.preventDefault();
                    mostrarHabitacion(habitacion.idhabitacion);
                });

                // Insertar en el carrusel
                carrusel.appendChild(tarjeta);
            });

            // Inicializar el carrusel después de cargar los datos
            inicializarCarrusel();
        })
        .catch(error => console.error("Error al cargar las habitaciones:", error));

    document.getElementById('cerrarSesion').addEventListener('click', function(){
        cookiesCarrito.eliminarTodasLasCookies();
        window.location.reload();
    });
});
