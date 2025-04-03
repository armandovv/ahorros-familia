document.getElementById('buscador').addEventListener('input', function() {
    const busqueda = this.value.toLowerCase();
    const filas = document.querySelectorAll('#tablaDatos tbody tr');

    filas.forEach(fila => {
        const textoFila = fila.textContent.toLowerCase();
        fila.style.display = textoFila.includes(busqueda) ? '' : 'none';
    });
});