// Seccion para desplegar los estados de la republica, municipios y clientes  en las altas notariales "
// Listener para esperar a que todo el HTML este cargado.. 
document.addEventListener('DOMContentLoaded', () => 
{
    //Obtenemos el selector y consultamos con AJAX la BD para desplegar estados de la republica
    const selector_estado=document.getElementById('estado');
    const opcion_1=document.createElement('option');
    opcion_1.value='0';
    opcion_1.text="Selecciona un estado";
    selector_estado.appendChild(opcion_1);
    // Peticion AJAX para obtener los estados de la republica
    fetch('../legal/php/estados.php')
    .then(response => response.json())
    .then(data => 
    {
        data.forEach(estado =>
        {
            const option_estado = document.createElement('option');
            option_estado.value = estado.ID;
            option_estado.text = estado.c_estado;
            selector_estado.appendChild(option_estado);        
        });
    })
    .catch(error => 
    {
        console.log('Error:', error);
    });
    // Peticion AJAX para obtener los clientes dados de alta...
    selector_cliente=document.getElementById('ncliente');
    fetch('../legal/php/consulta_clientes.php')
    .then(response => response.json())
    .then(data => 
    {
        data.forEach(cliente =>
        {
            const option_cliente = document.createElement('option');
            option_cliente.value = cliente.ID;
            option_cliente.text = cliente.c_razonsocial;
            selector_estado.appendChild(option_estado);        
        });
    })
    .catch(error =>
    {
        console.log('Error:', error);
    });

    // Listener para obtener los municipios dado que se selecciona un estado..
    selector_estado.addEventListener('change',()=>
    {
        id_estado=document.getElementById('estado').value;
        // Peticion AJAX para obtener los municipios de un estado seleccionado 
        // Crear la solicitud AJAX
        const xhr = new XMLHttpRequest();
        xhr.open('GET','../legal/php/municipios.php?estado='+id_estado, true);
        xhr.onload = function()
        {
            if (xhr.status === 200)
            {
                const municipios = JSON.parse(xhr.responseText);
                const selector_municipios = document.getElementById('nciudad');
                selector_municipios.innerHTML = ''; // Limpiamos las opciones anteriores
                municipios.forEach(municipio =>
                {
                    const option = document.createElement('option');
                    option.value = municipio.id;
                    option.text = municipio.c_municipio;
                    selector_municipios.appendChild(option);
                });
              } 
              else 
              {
                console.error('Error al obtener los municipios');
              }
        };
        xhr.send();
    });











    const tipoDocumentoSelect = document.getElementById("ntipdocum");
    const formulario = document.querySelector(".formulario-nuevo-instrumento form");    

    // Event listener para mostrar u ocultar los campos adicionales
    tipoDocumentoSelect.addEventListener("change", () =>
    {
        const divExtra = document.getElementById("div-extra");
        
        if (tipoDocumentoSelect.value === "testimonio")
        {
            // Comprueba si ya existe el div para evitar duplicados
            if (document.getElementById("div-extra")) 
            return;
            
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
            inputTestimonio.addEventListener("input", () => 
            {
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
        else
        {

            divExtra.remove();
            
        }
         });




});

//Funcion para agregar filas en la busqueda de expediente (legal.php)
function agregarfilas() {
    var fila = document.getElementById("busqueda").value; 
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





function mostrarCampoGrupoEmpre() {
    const selectGrupoEmpre = document.getElementById('grpempre');
    const botonContenedor = document.getElementById('btn_pdf');

    // Verificar si ya existe el div para evitar duplicados
    let divExistente = document.getElementById('div-otro-grupo');
    if (selectGrupoEmpre.value === '9999') {
        if (!divExistente) {
            // Crear el nuevo div
            const nuevoDiv = document.createElement('div');
            nuevoDiv.id = 'div-otro-grupo';
            nuevoDiv.style.display = 'flex';
            nuevoDiv.style.gap = '1rem';
            nuevoDiv.style.marginTop = '1rem';
            nuevoDiv.style.marginLeft = '1rem';

            // Crear el input
            const inputOtro = document.createElement('input');
            inputOtro.type = 'text';
            inputOtro.placeholder = 'Especificar otro grupo';
            inputOtro.name = 'otroGrupo';
            inputOtro.style.flex = '1';
            inputOtro.id = "otrogrp";

            // Crear el botón
            const botonGuardar = document.createElement('button');
            botonGuardar.type = 'button';
            botonGuardar.textContent = 'Guardar';
            botonGuardar.className = 'boton-formulario'; // Asigna las clases necesarias
            botonGuardar.style.flex = '0.64';
            botonGuardar.style.marginLeft = '4rem';
            botonGuardar.style.marginRight = '4rem';

            // Agregar input y botón al nuevo div
            nuevoDiv.appendChild(inputOtro);
            nuevoDiv.appendChild(botonGuardar);

            // Insertar el div antes del contenedor de los botones
            botonContenedor.parentNode.insertBefore(nuevoDiv, botonContenedor);
        }
    } else {
        // Eliminar el div si se selecciona otra opción
        if (divExistente) {
            divExistente.remove();
        }
    }
}



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
}