function modificar_cn() {
    const checkbox = document.getElementById('che');
    const input1 = document.getElementById('nncliente');
    const input2 = document.getElementById('ncalle');
    const boton = document.getElementById('btn-registrarcli');

    if (checkbox.checked) {
        input1.disabled = false;
        input2.disabled = false;
        boton.textContent = "Guardar Cambios"; // Cambia el texto del botón
    } else {
        input1.disabled = true;
        input2.disabled = true;
        boton.textContent = "Cargar PDF"; // Restaura el texto del botón
    }
}

