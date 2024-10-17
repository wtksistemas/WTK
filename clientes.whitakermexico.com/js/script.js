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




		else{
				window.alert("Regitro exitoso !!");
		
		}
	}


