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
  "21": "Registro Exitoso",
  "22": "Proceso inválido, repite el proceso.",
  "23": "Proceso inválido, solo se admiten números."
};

// Mostrar alerta si existe mensaje para ese código
if (validacion && mensajes[validacion]) {
  window.alert(mensajes[validacion]);
}
 
//const valores = window.location.search;

//const urlParams = new URLSearchParams(valores);


//if(valores != "" )
//	{			
//		var validacion = urlParams.get('v');
//		if( validacion == "0")
//			{
//				window.alert("Error: Registro no existoso, vuelva a intentarlo, si el problema persiste comunicate a: sistemas@whitakermexico.com");
//			}
//		else if (validacion == "3")
//			{
//			window.alert("Contraseña y/o Usuario incorrecto y/o invalidos, verefique sus datos ! ");
//
//			}
//		
//		else if(validacion == "4")
//			{
//				
//				window.alert("Revisa tu bandeja de correo ! :3");
//			}
//			else if(validacion=="9")
//			{
//				window.alert("Usuario no registrado, favor de verificar");
//
//
//			}
//			else if(validacion=="10")
//				{
//					window.alert("Token invalido, favor de verificar o realizar el procedimiento nuevamente");
//	
//	
//				}
//				else if(validacion=="11")
//					{
//						window.alert("Token invalido, Recuerda que debes ingresar desde el link que te llego a  tu mail, los mails de recuperacion tienen una vigencia de 5 minutos.");
//		
//		
//					}
//					else if(validacion=="20")
//						{
//							window.alert("Usuario ya registrado en esta plataforma, favor de verificar");
//			
//			
//						}
//						else if(validacion=="21")
//							{
//								window.alert("Registro Exitoso!");
//				
				
//							}
//							else if(validacion=="22")
//								{
//									window.alert("Proceso invalido, Repite el proceso.");
					
					
//								}
//								else if(validacion=="23")
//									{
//										window.alert("Proceso invalido, solo se admiten numeros");
						
						
//									}

//		else{
				
//		}
//	}

function no_atras()
{
   window.location.hash="no-back-button";
   window.location.hash="Again-No-back-button"
   window.onhashchange=function(){window.location.hash="no-back-button";}   
}


//function validarCampos() {
//	const campo1 = document.getElementById('contrasena1').value;
//	const campo2 = document.getElementById('contrasena2').value;
//	const submit = document.getElementById('btn');
//	submit.disabled=true;
  
//	if (campo1 === campo2) {
	  // Los campos son iguales, puedes mostrar un mensaje, habilitar un botón, etc.
//	  document.getElementById("mensaje").textContent = "Las contraseñas coinciden";
//	  submit.disabled=false;
	  
//	} else {
	  // Los campos son diferentes, puedes mostrar un mensaje de error.
//	  document.getElementById("mensaje").textContent = "Las contraseñas no coinciden";
//	  submit.disabled=true;
//	}
  //}


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
	