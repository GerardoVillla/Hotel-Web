document.addEventListener('DOMContentLoaded', () => {
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
});
