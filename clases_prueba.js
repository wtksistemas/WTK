class Instrumento
{



}




function agregarfilas()
{
    var fila=document.getElementById("busqueda").value;

var i=1;
var div_contenido=document.getElementById("contenido_expedientes");
div_contenido.innerHTML="";

while(i<=fila)
{

    var div = document.createElement("div");//creamos el div
    div.className+="expediente";
    var span=document.createElement("span");
    span.innerText="Expediente "+i;

    div.appendChild(span);

    var div_hijo=document.createElement("div");
    var boton_ver=document.createElement("Button");
    var boton_reservar=document.createElement("Button");
    var boton_historico=document.createElement("Button");
    var boton_detalles=document.createElement("Button");

    boton_ver.innerText="Ver";
    boton_reservar.innerText="Reservar";
    boton_historico.innerText="Historico";
    boton_detalles.innerText="Detalles";

div_hijo.appendChild(boton_ver);
div_hijo.appendChild(boton_reservar);
div_hijo.appendChild(boton_historico);
div_hijo.appendChild(boton_detalles);

div.appendChild(div_hijo);
    div_contenido.appendChild(div);


    i++;
}   
    



}

