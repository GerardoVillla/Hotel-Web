
document.addEventListener('DOMContentLoaded', () => {
    const busquedaEntrada = document.getElementById('busquedaentrada');
    const filtroPrincipal = document.getElementById('filtroPrincipal');
    const filtroSecundario = document.getElementById('filtroSecundario');
    
    const btnReservar = document.getElementById('reservar');
    document.getElementById('cerrarSesion').addEventListener('click', function(){
        window.location.href = '../../../index.php';
    });

    if (btnReservar) {
        btnReservar.addEventListener('click', (e) => {
            e.preventDefault();
            const deseaContinuar = confirm("Para reservar debe tener una sesión iniciada o iniciar una. ¿Desea continuar?");
            console.log("Resultado del confirm:", deseaContinuar); 
            if (deseaContinuar) {
                console.log("Redirigiendo a:", btnReservar.href); 
                window.location.href = btnReservar.href; // Redirige al enlace del botón
            }
        });
    }
    const actualizarFiltros = () => {
        const hayTexto = busquedaEntrada.value.trim().length > 0;
        filtroPrincipal.disabled = !hayTexto;
        filtroSecundario.disabled = !hayTexto;
        if (!hayTexto) {
            filtroSecundario.style.display = 'none'; // Ocultar filtro secundario si no hay texto
        }
    };

    actualizarFiltros();
    busquedaEntrada.addEventListener('input', actualizarFiltros);

    //Filtro secundario
    filtroPrincipal.addEventListener('change', () => {
        filtroSecundario.innerHTML = ''; 
        switch (filtroPrincipal.value) {
            case 'precio':
                filtroSecundario.innerHTML = `
                    <option value="asc">De menor a mayor</option>
                    <option value="desc">De mayor a menor</option>
                `;
                filtroSecundario.style.display = 'block';
                break;
            case 'alfabetico':
                filtroSecundario.innerHTML = `
                    <option value="asc">De la A a la Z</option>
                    <option value="desc">De la Z a la A</option>
                `;
                filtroSecundario.style.display = 'block';
                break;
            case 'categoria':
                filtroSecundario.innerHTML = `
                    <option value="Estandar">Estándar</option>
                    <option value="Suite">Suite</option>
                    <option value="Deluxe">Deluxe</option>
                `;
                filtroSecundario.style.display = 'block';
                break;
            default:
                filtroSecundario.style.display = 'none'; // Ocultar filtro secundario si está en "todo"
                break;
        }
    });

    formBusqueda.addEventListener('submit', (event) => {
        if (!busquedaEntrada.value.trim()) {
            event.preventDefault(); // Evitar que se envíe el formulario
            alert('Por favor, escribe algo en la barra de búsqueda.');
        }
    });
});
   

