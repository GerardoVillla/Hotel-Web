import { cookiesCarrito } from './cookiesCarrito.js';

document.addEventListener('DOMContentLoaded', function(){
    const botonesEliminar = document.querySelectorAll('.eliminar');
    botonesEliminar.forEach(eliminar => {
        eliminar.addEventListener('click', (event) => {
            const id = event.target.id;
            cookiesCarrito.eliminarHabitacionDelCarrito(id);
            window.location.reload();
        });
    });

    const botonesEditar = document.querySelectorAll('.editar');
    botonesEditar.forEach(editar => {
        editar.addEventListener('click', (event) => {
            const id = event.target.id;
            const entrada = cookiesCarrito.obtenerCookie('entrada' + id);
            if(entrada == undefined){
                window.location.reload();
            }else{
                const salida = cookiesCarrito.obtenerCookie('salida' + id);
                const personas = cookiesCarrito.obtenerCookie('habitacion' + id);
                document.location = `../view/carrito.php?id=${id}&entrada=${entrada}&salida=${salida}&personas=${personas}`;}
        });
    });

    document.getElementById("btnPagar").addEventListener("click", function(){
        const totalhtml = document.getElementById("totalFinal")
        const texto = totalhtml.innerHTML;
        if(texto == "Total final: $ 0"){
            alert('el carrito esta vacio, agregue una habitacion');
        }else{
            window.location.replace("../view/pagarCarrito.php");
        }
    })
});