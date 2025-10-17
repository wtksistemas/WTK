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
    // --- LÓGICA MODAL DE PERMISOS Y JUSTIFICACIONES   ---
 const modal = document.getElementById('modal-formulario');    
    if (modal) {
        const cargaLinks = document.querySelectorAll('.carga-link');
        const tabContents = document.querySelectorAll('.modal-contenido .tab-content');
        
        cargaLinks.forEach(link => {
            link.addEventListener('click', () => {
                // Remover clase 'active' de todos los links y tabs
                cargaLinks.forEach(l => l.classList.remove('active'));
                tabContents.forEach(t => t.classList.remove('active'));

                // Añadir 'active' al link y tab seleccionados
                link.classList.add('active');
                const tabId = link.getAttribute('data-tab');
                document.getElementById(tabId).classList.add('active');
            });
        });
        
        // --- LÓGICA PARA EL CAMPO "OTRO" EN PERMISOS ---
        const motivoPermisoSelect = document.getElementById('motivo-permiso');
        const otroMotivoContainer = document.getElementById('otro-motivo-permiso-container');

        if (motivoPermisoSelect) {
            motivoPermisoSelect.addEventListener('change', function() {
                if (this.value === 'otro') {
                    otroMotivoContainer.style.display = 'flex';
                } else {
                    otroMotivoContainer.style.display = 'none';
                }
            });
        }

    }
	});

//  ------------------------------------------- MODULOS  ------------------------------------------

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
    const btnChecar = document.getElementById('boton-checar');
    const entradasContainer = document.querySelector('.contenedor-registros .registro-horas:nth-child(1)');
    const salidasContainer = document.querySelector('.contenedor-registros .registro-horas:nth-child(2)');
    const tiemposContainer = document.querySelector('.contenedor-registros .registro-horas:nth-child(3)');

    const btnCorreccion = document.getElementById('modificacion-checada');
    const formularioCorreccion = document.getElementById('formulario-correccion');
    const contenedorRegistros = document.getElementById('contenedor-registros');

    const registrosDeTiempo=[];//lista para guardar los registros

    // Función para convertir milisegundos a formato HH:MM 
    function formatearMilisegundos(ms) {
        if (isNaN(ms) || ms < 0) return "--:--";
        const totalMinutos = Math.floor(ms / 60000);
        const horas = Math.floor(totalMinutos / 60);
        const minutos = totalMinutos % 60;
        return `${String(horas).padStart(2, '0')}:${String(minutos).padStart(2, '0')}`;
    }
    

    btnChecar.addEventListener('click', () => {
        const ahora = new Date();
        const horaFormateada = ahora.toLocaleTimeString('es-MX', { hour: '2-digit', minute: '2-digit' });

        // Agregamos el registro actual 
        registrosDeTiempo.push(ahora);
//impar 
        
if(entradasContainer.length === "--:--"){
    entradasContainer.textContent = horaFormateada;
    alert(`Entrada registrada a las ${horaFormateada}!`);
    return;
}


if (registrosDeTiempo.length % 2 !== 0) {
            //creacion de espacios para nueva entrada, salida y tiempo
            const nuevaEntradaP = document.createElement('p');
            nuevaEntradaP.textContent = horaFormateada;
            entradasContainer.appendChild(nuevaEntradaP); // Lo agregamos al DOM.

            const nuevaSalidaP = document.createElement('p');
            nuevaSalidaP.textContent = '--:--';
            salidasContainer.appendChild(nuevaSalidaP);

            const nuevoTiempoP = document.createElement('p');
            nuevoTiempoP.textContent = '--:--';
            tiemposContainer.appendChild(nuevoTiempoP);

            alert(`Entrada registrada a las ${horaFormateada}!`);
        } else {
            // Actualizamos el último <p> vacío en la columna de salidas.
            const ultimaSalidaP = salidasContainer.querySelector('p:last-child');
            ultimaSalidaP.textContent = horaFormateada;
            // Calculamos la diferencia con el registro anterior.
            const tiempoSalidaActual = registrosDeTiempo[registrosDeTiempo.length - 1]; // El último
            const tiempoEntradaPrevia = registrosDeTiempo[registrosDeTiempo.length - 2]; // El penúltimo
            const diff = tiempoSalidaActual - tiempoEntradaPrevia;

            // Actualizamos el último <p> vacío en la columna de tiempo.
            const ultimoTiempoP = tiemposContainer.querySelector('p:last-child');
            ultimoTiempoP.textContent = formatearMilisegundos(diff);

            alert(`Salida registrada a las ${horaFormateada}!`);
        }
    });

    btnCorreccion.addEventListener('click', () => {
        const isVisible = formularioCorreccion.style.display === 'flex';
        formularioCorreccion.style.display = isVisible ? 'none' : 'flex';
        contenedorRegistros.classList.toggle('desplazar-abajo');
    });
});
