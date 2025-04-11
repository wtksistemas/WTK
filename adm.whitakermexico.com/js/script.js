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
			window.alert("Contraseña y/o Usuario incorrecto y/o invalidos, verefique sus datos ! ");

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
    // Obtener todos los campos del formulario
    const nombre = document.getElementById('nombre').value.trim();
    const empresa = document.getElementById('empresa').value;
    const division = document.getElementById('division').value.trim();
    const mail = document.getElementById('mail').value.trim();
    const pass = document.getElementById('pass').value.trim();
    const tel = document.getElementById('tel').value.trim();

    // Verificar si todos los campos están llenos y que se haya seleccionado una empresa
    const isFormComplete = nombre && empresa !== "0" && division && mail && pass && tel;

    // Habilitar o deshabilitar el botón de registro
    document.getElementById('btn-registrate').disabled = !isFormComplete;


}










  

  function netoaobjetivo() {
	const piramida = document.getElementById("piramida").value;
	const labelMensual = document.getElementById("vmensual");
	const labelNeto = document.getElementById("v_net");

	if (piramida === "Bruto a Neto") {
		labelMensual.innerText = "Bruto Mensual";
		labelNeto.innerText = "Neto a pagar";
	} else if (piramida === "Neto a Bruto") {
		labelMensual.innerText = "Neto Mensual";
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



	// Función para mostrar u ocultar el submenú

	document.addEventListener('DOMContentLoaded', function() {
		// Manejar dropdowns
		const dropdowns = document.querySelectorAll('.dropdown');
		
		dropdowns.forEach(dropdown => {
			const toggle = dropdown.querySelector('.dropdown-toggle');
			
			toggle.addEventListener('click', function(e) {
				e.preventDefault();
				e.stopPropagation();
				dropdown.classList.toggle('active');
				
				// Cerrar otros dropdowns
				dropdowns.forEach(other => {
					if(other !== dropdown) other.classList.remove('active');
				});
			});
		});
	
		// Cerrar dropdowns al hacer clic fuera
		document.addEventListener('click', function(e) {
			if(!e.target.closest('.dropdown')) {
				dropdowns.forEach(dropdown => {
					dropdown.classList.remove('active');
				});
			}
		});
	});



	