// Obtener parámetros de la URL
const urlParams = new URLSearchParams(window.location.search);
const validacion = urlParams.get("v");

// Diccionario de mensajes
const mensajes = {
  "0": "Error: Registro no exitoso, vuelva a intentarlo. Si el problema persiste comunícate a: sistemas@whitakermexico.com",
  "3": "Contraseña y/o Usuario incorrecto, verifica tus datos.",
  "4": "Revisa tu bandeja de correo",
  "9": "Usuario no registrado, favor de verificar.",
  "10": "Token inválido, favor de verificar o realizar el procedimiento nuevamente.",
  "11": "Token inválido. Recuerda ingresar desde el link de tu correo (vigencia: 5 minutos).",
  "20": "Usuario ya registrado en esta plataforma, favor de verificar.",
  "21": "Registro Exitoso :))",
  "22": "Proceso inválido, repite el proceso.",
  "23": "Proceso inválido, solo se admiten números.",
  "24": "Usuario ya registrado en esta plataforma, favor de verificar, RFC Duplicado.",    
  "25": "Usuario ya registrado en esta plataforma, favor de verificar, Nombre Duplicado.",
  "26": "Usuario ya registrado en esta plataforma, favor de verificar, Correo Electrónico Duplicado.",
  "27": "Usuario ya registrado en esta plataforma, favor de verificar, Teléfono Duplicado.",
};

// Mostrar alerta si existe mensaje para ese código
if (validacion && mensajes[validacion]) {
  window.alert(mensajes[validacion]);
}
 
function no_atras()
{
   window.location.hash="no-back-button";
   window.location.hash="Again-No-back-button"
   window.onhashchange=function(){window.location.hash="no-back-button";}   
}

function ValidarRegistro() {
    // Obtener valores de los inputs
    const nombre = document.getElementById("nombre").value.trim();
    const mail = document.getElementById("mail").value.trim();
    const pass = document.getElementById("pass").value.trim();
    const idrfc = document.getElementById("idrfc").value.trim();
    const tel = document.getElementById("tel").value.trim();
    const idcfpass = document.getElementById("idcfpass").value.trim();
    const boton = document.getElementById("btn-registrate");

    // Crear o ubicar mensaje de validación para contraseñas
	let mensaje = document.getElementById("msg-pass");
	if (!mensaje) {
		mensaje = document.createElement("p");
        mensaje.id = "msg-pass";
        mensaje.style.fontSize = "14px";
        mensaje.style.marginTop = "5px";
        document.getElementById("idcfpass").insertAdjacentElement("afterend", mensaje);
    }

    // Validar contraseñas
    if (idcfpass.length > 0) {
        if (pass !== idcfpass) {
            mensaje.textContent = "❌ No coincide";
            mensaje.style.color = "red";
        } else {
            mensaje.textContent = "✅ Correcto";
            mensaje.style.color = "green";
        }
    } else {
        mensaje.textContent = "";
    }

    // Verificar que todos los campos estén llenos y contraseñas coincidan
    const formularioCompleto = nombre && mail && pass && idrfc && tel && idcfpass;
    const contrasenasIguales = pass === idcfpass && pass !== "";

    // Habilitar o deshabilitar el botón
    boton.disabled = !(formularioCompleto && contrasenasIguales);
}
	