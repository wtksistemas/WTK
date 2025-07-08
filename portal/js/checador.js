// GENERAL


// Script para manejar el menú desplegable

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

// RELOJ CHECADOR   

function actualizarReloj() {
  const horaElemento = document.getElementById('hora-actual');
  const fechaElemento = document.getElementById('fecha-actual');
  const iconoElemento = document.getElementById('icono-dia-noche');
  const now = new Date();

  const hora = now.toLocaleTimeString('es-MX', { hour: '2-digit', minute: '2-digit', second: '2-digit' });
  const fecha = now.toLocaleDateString('es-MX', { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' });

    horaElemento.textContent = hora;
    fechaElemento.textContent = fecha;

  const horaActual = now.getHours();
  iconoElemento.textContent = (horaActual >= 6 && horaActual < 18) ? '☀️' : '🌙';
}

setInterval(actualizarReloj, 1000);
actualizarReloj();



document.addEventListener('DOMContentLoaded', () => {
    // registrar horas
    const btnChecar = document.getElementById('boton-checar');
    const registros = document.getElementById('registro-horas');
    // Modificar horas
    const btnCorreccion = document.getElementById('modificacion-checada');
    const formularioCorreccion = document.getElementById('formulario-correccion');


  btnChecar.addEventListener('click', () => {
    const hora = new Date().toLocaleTimeString('es-MX', { hour: '2-digit', minute: '2-digit' });
    registros.innerHTML = `
      <p>Hora de entrada: ${hora}</p>
      <p>Entrada de comida: --:--</p>
      <p>Salida de comida: --:--</p>
      <p>Hora de salida: --:--</p>
    `;
    alert(`¡Entrada/Salida registrada a las ${hora}!`);    
  });

    btnCorreccion.addEventListener('click', () => {
    const isVisible = formularioCorreccion.style.display === 'flex';
    formularioCorreccion.style.display = isVisible ? 'none' : 'flex';
  });

});


















