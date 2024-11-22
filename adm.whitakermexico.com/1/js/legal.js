function modificar_cn(){
    const checkbox = document.getElementById('che');
    const input1 = document.getElementById('nncliente');
    const input2 = document.getElementById('ncalle');

    if(checkbox.checked){
        input1.disabled = false;
        input2.disabled = false;
    }else{
        input1.disabled = true;
        input2.disabled = true;
    }
}

function cambio_btn(){
      // Seleccionar el contenedor del botón
      const contenedor = document.getElementById('btn_pdf');
      
      // Crear un nuevo botón
      const nuevoBoton = document.createElement('button');
      nuevoBoton.type = 'submit';
      nuevoBoton.className = 'boton-formulario'; // Mismo estilo que los demás botones
      nuevoBoton.textContent = 'Enviar';
      // Agregar el nuevo botón al contenedor
      contenedor.appendChild(nuevoBoton);
}

