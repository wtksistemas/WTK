// Seccion para desplegar los clientes en la pagina " alta de instrumentos notariales"
function leer_clientes(id,cliente)
{
var selector=document.getElementById("ncliente");
html='<option value="0">Selecciona un cliente</option>';
for(i=0;i<id.length;i++)
{
html=html+'<option value="'+id[i]+'">'+cliente[i]+'</option>';

console.log("ID: "+id[i]+" nombre de cliente: "+cliente[i]);
}
selector.innerHTML=html;
}



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



function concatenarTestimonio() {
    const numero = document.getElementById("numcertificado").value;
    const resultado = document.getElementById("resultadoTestimonio");
    resultado.textContent = `Testimonio ${numero}`;
}


function mostrarCampoTestimonio() {
    const tipoDocumentoSelect = document.getElementById("ntipdocum");
    const formulario = document.querySelector(".formulario-nuevo-instrumento form");

    // Función para crear el div con los campos adicionales
    function agregarCamposAdicionales() {
        // Comprueba si ya existe el div para evitar duplicados
        if (document.getElementById("div-extra")) return;

        // Crea el contenedor del div
        const divExtra = document.createElement("div");
        divExtra.className = "campo-formulario";
        divExtra.id = "div-extra";

        // Crea el input para "Número de Testimonio"
        const inputTestimonio = document.createElement("input");
        inputTestimonio.id = "ntestimonio";
        inputTestimonio.name = "testimonio";
        inputTestimonio.type = "number";
        inputTestimonio.placeholder = "Número de Testimonio";

        
        // Crea el input para "concatenacion"
        const inputConca = document.createElement("input");
        inputConca.id = "contestimonio";
        inputConca.name = "ncontestimonio";
        inputConca.type = "text";
        inputConca.placeholder = "Testimonio x";
        inputConca.disabled = true;

        // Actualiza el valor de concatenacion cuando se escribe en "Número de Testimonio"
        inputTestimonio.addEventListener("input", () => {
            const numero = inputTestimonio.value;
            inputConca.value = numero ? `Testimonio ${numero}` : "";
        });

        // Añade los inputs al div
        divExtra.appendChild(inputTestimonio);
        divExtra.appendChild(inputConca);

        // Inserta el div extra antes del botón "Registrar"
        const botonRegistrar = document.getElementById("comenta");
        formulario.insertBefore(divExtra, botonRegistrar.parentElement);
    }

    // Función para eliminar el div con los campos adicionales
    function eliminarCamposAdicionales() {
        const divExtra = document.getElementById("div-extra");
        if (divExtra) {
            divExtra.remove();
        }
    }

    // Event listener para mostrar u ocultar los campos adicionales
    tipoDocumentoSelect.addEventListener("change", () => {
        if (tipoDocumentoSelect.value === "testimonio") {
            agregarCamposAdicionales();
        } else {
            eliminarCamposAdicionales();
        }
    });
}

document.addEventListener('DOMContentLoaded', function () {
    const select = document.getElementById('grpempre');
    const buttonContainer = document.getElementById('btn_pdf'); // Contenedor de los botones

    function mostrarCampoGrupoEmpre() {
        let existingDiv = document.getElementById('otroDiv'); // Div contenedor del nuevo input

        if (select.value === '9999') {
            if (!existingDiv) {
                // Crear un nuevo div y input si no existe
                const div = document.createElement('div');
                div.id = 'otroDiv';
                div.className = 'campo-formulario'; // Clases para estilos

                const input = document.createElement('input');
                input.type = 'text';
                input.name = 'notroGrupo';
                input.id = 'otroGrupo';
                input.placeholder = 'Especificar Grupo Empresarial';
                input.className = 'input-adicional'; // Clase para estilos
                input.required = true;

                div.appendChild(input); // Agregar input al div
                buttonContainer.parentNode.insertBefore(div, buttonContainer); // Insertar div antes de los botones
            }
        } else if (existingDiv) {
            // Remover el div completo si existe y se selecciona otra opción
            existingDiv.parentNode.removeChild(existingDiv);
        }
    }

    // Asociar la función al evento 'change' del select
    select.addEventListener('change', mostrarCampoGrupoEmpre);
});


//leer grupos existentes
function leer_grpempresa(id,cliente)
{
var selector=document.getElementById("ncliente");
html='<option value="0">Selecciona un cliente</option>';
for(i=0;i<id.length;i++)
{
html=html+'<option value="'+id[i]+'">'+cliente[i]+'</option>';

console.log("ID: "+id[i]+" nombre de cliente: "+cliente[i]);
}
selector.innerHTML=html;
}B