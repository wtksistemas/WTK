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
			window.alert("Contraseña y/0 Usuario incorrecto, verefique sus datos ! ");

			}
		
		else if(validacion == "4")
			{
				
				window.alert("Revisa tu bandeja de correo ! :3");
			}
		else{
				window.alert("Regitro exitoso !!");
		
		}
	}

