document.addEventListener("DOMContentLoaded", () => {
    const carrusel = document.getElementById("carrusel");
    const prevBtn = document.getElementById("prev");
    const nextBtn = document.getElementById("next");
    let currentPosition = 0;
    const reservarBtn = document.getElementById("btnReservar");

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

        reservarBtn.addEventListener("click", (e) => {
            e.preventDefault();
            console.log("Evento detectado.");
            if (1 == 1) {
                window.location.href = "reservar.html";
            } else {
                window.location.href = "../../../index.php"; // Redirige al usuario al inicio de sesión
                alert("Inicia sesión para poder reservar"); // Opcional: mensaje de alerta
            }
        });
    };

    function mostrarHabitacion(id) {
    
    fetch("../../servidor/carrusel.php")
    .then(response => response.json())
    .then(data => {
        data.forEach((habitacion) => {
            if(habitacion.idhabitacion == id){
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
                            <h1>${habitacion.nombre}</h1>
                            <p>${habitacion.descripcion}</p>
                            <h5>
                                Categoria: ${habitacion.categoria}<br>
                                Capacidad de personas: ${habitacion.capacidadDePersonas}<br>
                                Numero de habitaciones: ${habitacion.numHabitaciones}<br>
                                Disponibles: ${habitacion.disponibles}<br>
                                Costo por noche: ${habitacion.costoPorNoche}<br>
                            </h5>
                        </td>
                    </tr>
                `;
                // Crear el botón de cerrar
                const cerrarBtn = document.createElement("button");
                cerrarBtn.innerHTML = `
                    <img src="../recursos/img/infohab/cerrarInformacion.png" alt="Cerrar">
                `;
                cerrarBtn.addEventListener("click", () => {
                    // Eliminar el contenedor flotante al cerrar
                    document.body.removeChild(contenedor);
                });
                // Agregar la tabla y el botón al contenedor
                contenedor.appendChild(tabla);
                contenedor.appendChild(cerrarBtn);
                // Añadir el contenedor al cuerpo del documento
                document.body.appendChild(contenedor);
            }
        });
    })
    .catch(error => console.error("Error al cargar la habitacion:", error));
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
                        <h2>${habitacion.nombre}</h2>
                        <p>${habitacion.descripcion}</p>
                        <h3>MXN ${habitacion.costoPorNoche}</h3>
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
});
