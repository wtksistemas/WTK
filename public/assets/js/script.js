// Obtener parámetros de la URL
const urlParams = new URLSearchParams(window.location.search);
const validacion = urlParams.get("v");
// Diccionario de mensajes
const mensajes = 
{
  "0": "Error: Registro no exitoso, vuelva a intentarlo. Si el problema persiste comunícate a: sistemas@whitakermexico.com",
  "campos_vacios": "Error: Porfavor, llena todos los campos.",
  "login_fallido": "Contraseña y/o Usuario incorrecto, verifica tus datos.",
  "error_tecnico": "Ocurrió un error técnico, por favor intenta de nuevo más tarde. Si el problema persiste comunícate a: sistemas@whitakermexico.com",
  "no_autorizado": "Acceso no autorizado, verifica tu informacion",
  "correo_enviado": "Revisa tu bandeja de correo",
  "error_mail": "Ocurrió un error al enviar el correo electrónico, por favor intenta de nuevo más tarde, si el problema persiste comunícate a: sistemas@whitakermexico.com",
  "9": "Usuario no registrado, favor de verificar.",
  "token_invalido": "Token inválido o expirado, favor de verificar o realizar el procedimiento nuevamente.",
  "20": "Usuario ya registrado en esta plataforma, favor de verificar.",
  "registro_exitoso": "Registro Exitoso :))",
  "22": "Proceso inválido, repite el proceso.",
  "23": "Proceso inválido, solo se admiten números.",
  "sesion_invalida": "Sesion caducada o invalida, por favor inicia sesión nuevamente.",
  "pass_no_coincide": "Las contraseñas no coinciden o están vacías, por favor verifica tu información.",
  "pass_invalido": "La contraseña debe tener al menos 8 caracteres, por favor verifica tu información.",
  "pass_cambiada": "Contraseña actualizada exitosamente.",
  "datos_duplicados": "Algunos de los datos ingresados ya están registrados en el sistema, por favor verifica tu información o inicia sesión si ya tienes una cuenta."
};
// Mostrar alerta si existe mensaje para ese código
if (validacion && mensajes[validacion])
{
  window.alert(mensajes[validacion]);
}
// Función para validar el registro de usuarios nuevos en tiempo real y habilitar el botón de registro solo cuando todos los campos estén llenos y las contraseñas coincidan..
function ValidarRegistro()
{
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
	if (!mensaje)
    {
	    mensaje = document.createElement("p");
        mensaje.id = "msg-pass";
        mensaje.style.fontSize = "14px";
        mensaje.style.marginTop = "5px";
        document.getElementById("idcfpass").insertAdjacentElement("afterend", mensaje);
    }
    // Validar contraseñas
    if (idcfpass.length > 0)
    {
        if (pass !== idcfpass)
        {
            mensaje.textContent = "❌ No coincide";
            mensaje.style.color = "red";
        } 
        else
        {
            mensaje.textContent = "✅ Correcto";
            mensaje.style.color = "green";
        }
    } 
    else
    {
        mensaje.textContent = "";
    }
    // Verificar que todos los campos estén llenos y contraseñas coincidan
    const formularioCompleto = nombre && mail && pass && idrfc && tel && idcfpass;
    const contrasenasIguales = pass === idcfpass && pass !== "";
    // Habilitar o deshabilitar el botón
    boton.disabled = !(formularioCompleto && contrasenasIguales);
}
	



















 
function no_atras()
{
   window.location.hash="no-back-button";
   window.location.hash="Again-No-back-button"
   window.onhashchange=function(){window.location.hash="no-back-button";}   
}
