const valores = window.location.search;

const urlParams = new URLSearchParams(valores);

if(valores != "" )
	{			
		var validacion = urlParams.get('v');
		if( validacion == "0")
			{
				window.alert("Error: Registro no existoso, vuelva a intentarlo, si el problema persiste comunicate a: sistemas@whitakermexico.com");
			}
		else if (validacion == "3")
			{
			window.alert("Contraseña y/o Usuario incorrecto, verefique sus datos ! ");

			}
		
		else if(validacion == "4")
			{
				
				window.alert("Revisa tu bandeja de correo ! :3");
			}
			else if(validacion=="9")
			{
				window.alert("Usuario no registrado, favor de verificar");


			}
			else if(validacion=="10")
				{
					window.alert("Token invalido, favor de verificar o realizar el procedimiento nuevamente");
	
	
				}
				else if(validacion=="11")
					{
						window.alert("Token invalido, Recuerda que debes ingresar desde el link que te llego a  tu mail, los mails de recuperacion tienen una vigencia de 5 minutos.");
		
		
					}
					else if(validacion=="20")
						{
							window.alert("Usuario ya registrado en esta plataforma, favor de verificar");
			
			
						}
						else if(validacion=="21")
							{
								window.alert("Registro Exitoso!");
				
				
							}
							else if(validacion=="22")
								{
									window.alert("Proceso invalido, Repite el proceso.");
					
					
								}
								else if(validacion=="23")
									{
										window.alert("Proceso invalido, solo se admiten numeros");
						
						
									}
	




		else{
				
		}
	}

	function no_atras()
{
   window.location.hash="no-back-button";
   window.location.hash="Again-No-back-button"
   window.onhashchange=function(){window.location.hash="no-back-button";}   
}


function validarCampos() {
	const campo1 = document.getElementById('contrasena1').value;
	const campo2 = document.getElementById('contrasena2').value;
	const submit = document.getElementById('btn');
	submit.disabled=true;
  
	if (campo1 === campo2) {
	  // Los campos son iguales, puedes mostrar un mensaje, habilitar un botón, etc.
	  document.getElementById("mensaje").textContent = "Las contraseñas coinciden";
	  submit.disabled=false;
	  
	} else {
	  // Los campos son diferentes, puedes mostrar un mensaje de error.
	  document.getElementById("mensaje").textContent = "Las contraseñas no coinciden";
	  submit.disabled=true;
	}
  }


  function ValidarRegistro() {
	const empresa = document.getElementById('empresa').value;
	const mail = document.getElementById('mail').value;
	const pass = document.getElementById('pass').value;
	const tel = document.getElementById('tel').value;
	const submit = document.getElementById('btn');

  
	if ( empresa === '0' || mail === '' ||  pass=== ''  ||  tel=== '') {

		document.getElementById("a").textContent = "Formulario incompleto";
		submit.disabled=true;
	    
	} 
	else 
	{
	  
		document.getElementById("a").textContent = "Formulario completo";
		submit.disabled=false;
	    


	} 
  }

  function netoaobjetivo() {
	const piramida = document.getElementById("piramida").value;
	const labelMensual = document.getElementById("v_mensual");
	const labelNeto = document.getElementById("v_neto");

	if (piramida === "Bruto a Neto") {
		labelMensual.innerText = "Bruto Objetivo Mensual";
		labelNeto.innerText = "Neto a pagar";
	} else if (piramida === "Neto a Bruto") {
		labelMensual.innerText = "Neto Mensual objetivo";
		labelNeto.innerText = "Bruto objetivo";
	} else {
		labelMensual.innerText = "Base Mensual";
		labelNeto.innerText = "Neto a pagar";
	}
}
	function validarform(){
		const seleccion = document.getElementById("piramida").value;
		const salario = document.querySelector("input[name='salario']").value;

		if(seleccion === "nada" || salario === ""){
			alert("Debe seleccionar una opción valida y llenar todos los campos requeridos.");
			window.location.reload();//recarga la pagina
			return false;//evita el envio del formulario
		}
		return true;//permite envio exitoso
	}
