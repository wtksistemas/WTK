class Instrumento {
    div = document.createElement("div");//creamos el div
    div_contenido = document.createElement("div");
    span = document.createElement("span");
    div_hijo = document.createElement("div");
    boton_ver = document.createElement("Button");
    boton_reservar = document.createElement("Button");
    boton_historico = document.createElement("Button");
    boton_detalles = document.createElement("Button");


    constructor() { }

    armado_expediente() {
        this.boton_ver.innerText = "Ver";
        this.boton_reservar.innerText = "Reservar";
        this.boton_historico.innerText = "Historico";
        this.boton_detalles.innerText = "Detalles";
        this.div.className += "expediente";
        this.span.innerText = "Expediente";
        this.div.appendChild(this.span);
        this.div_hijo.appendChild(this.boton_ver);
        this.div_hijo.appendChild(this.boton_reservar);
        this.div_hijo.appendChild(this.boton_historico);
        this.div_hijo.appendChild(this.boton_detalles);
        this.div.appendChild(this.div_hijo);
        this.div_contenido.appendChild(this.div);
        return globalThis;
    }
}

function agregarfilas() {
    var fila = document.getElementById("busqueda").value; // 3
    var i = 1;
    var div_contenido = document.getElementById("contenido_expedientes");
    div_contenido.innerHTML = "";
    while (i <= fila) {
        var div = document.createElement("div");//creamos el div
        div.className += "expediente";
        var span = document.createElement("span");
        span.innerText = "Expediente " + i;
        div.appendChild(span);
        var div_hijo = document.createElement("div");
        var boton_ver = document.createElement("Button");
        var boton_reservar = document.createElement("Button");
        var boton_historico = document.createElement("Button");
        var boton_detalles = document.createElement("Button");
        boton_ver.innerText = "Ver";
        boton_reservar.innerText = "Reservar";
        boton_historico.innerText = "Historico";
        boton_detalles.innerText = "Detalles";
        div_hijo.appendChild(boton_ver);
        div_hijo.appendChild(boton_reservar);
        div_hijo.appendChild(boton_historico);
        div_hijo.appendChild(boton_detalles);
        div.appendChild(div_hijo);
        div_contenido.appendChild(div);
        i++;
    }
}



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

