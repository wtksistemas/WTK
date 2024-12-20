function mostrarCampoTestimonio() {
    const seleccion = document.getElementById("ntipdocum").value;
    const campoTestimonio = document.getElementById("testimonioCampo");

    if (seleccion === "testimonio") {
        campoTestimonio.style.display = "block";
    } else {
        campoTestimonio.style.display = "none";
        document.getElementById("resultadoTestimonio").textContent = ""; // Limpiar el resultado si no es testimonio
    }
}

function concatenarTestimonio() {
    const numero = document.getElementById("numcertificado").value;
    const resultado = document.getElementById("resultadoTestimonio");
    resultado.textContent = `Testimonio ${numero}`;
}


