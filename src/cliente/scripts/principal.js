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
            if (1 == 2) {
                window.location.href = "reservar.html";
            } else {
                window.location.href = "../../../index.php"; // Redirige al usuario al inicio de sesión
                alert("Inicia sesión para poder reservar"); // Opcional: mensaje de alerta
            }
        });
    };

    // Cargar datos del carrusel dinámicamente
    fetch("../../servidor/carrusel.php")
        .then(response => response.json())
        .then(data => {
            contador = 0;
            data.forEach(habitacion => {
                carrusel.innerHTML += `
                    <a class="tarjeta-habitacion" href="#" id="hab${contador+1}">
                        <img src="../recursos/img/habitaciones/${habitacion.URLImagen}" alt="img ${habitacion.nombre}">
                        <div class="descripcion-articulo">
                            <h2>${habitacion.nombre}</h2>
                            <p>${habitacion.descripcion}</p>
                            <h3>MXN ${habitacion.costoPorNoche}</h3>
                        </div>
                    </a>
                `;
                contador++;
            });

            // Inicializar el carrusel después de cargar los datos
            inicializarCarrusel();
        })
    .catch(error => console.error("Error al cargar las habitaciones:", error));
});
