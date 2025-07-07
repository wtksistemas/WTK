// Datos simulados de notificaciones
const notificacionesData = {
    vacaciones: [
        { mensaje: "Tienes 3 días pendientes de aprobación", link: "vacaciones.php" },
        { mensaje: "Tu solicitud de vacaciones fue aceptada", link: "vacaciones.php" }
    ],
    facturas: [
        { mensaje: "Factura 00235 está pendiente de validación", link: "facturas.php" },
        { mensaje: "Nueva factura disponible para revisión", link: "facturas.php" }
    ],
    rh: [
        { mensaje: "Actualización de datos personales requerida", link: "rh.php" }
    ],
    ti: [
        { mensaje: "Soporte programado para el viernes", link: "ti.php" }
    ],
    legal: [
        { mensaje: "Revisión de contrato pendiente", link: "legal/legal.php" }
    ],
    contabilidad: [
        { mensaje: "Recibo de nómina de este mes disponible", link: "contabilidad.php" }
    ],
    gastos: [
        { mensaje: "Reporte de gastos del mes listo", link: "gastos.php" }
    ],
    permisos: [
        { mensaje: "Solicitud de permiso pendiente de revisión", link: "permisos.php" }
    ]
};

// Función para mostrar notificaciones
function mostrarNotificaciones(area) {
    const contenedor = document.getElementById("contenedor-notificaciones");
    contenedor.innerHTML = "";

    if (notificacionesData[area] && notificacionesData[area].length > 0) {
        notificacionesData[area].forEach((notif, index) => {
            const tarjeta = document.createElement("div");
            tarjeta.className = "tarjeta-notificacion";
            tarjeta.innerHTML = `
                <p>${notif.mensaje}</p>
                <div class="botones-notificacion">
                    <a href="${notif.link}" class="btn-vermas" target="_blank">Ver más</a>
                    <button onclick="eliminarNotificacion('${area}', ${index})" class="btn-eliminar">Eliminar</button>
                </div>
            `;
            contenedor.appendChild(tarjeta);
        });
    } else {
        contenedor.innerHTML = "<p style='text-align:center;'>No hay notificaciones en esta área.</p>";
    }
}


// Función para actualizar los contadores de notificaciones
function actualizarBadges() {
    for (const area in notificacionesData) {
        const badge = document.getElementById(`badge-${area}`);
        if (badge) {
            const count = notificacionesData[area].length;
            
            if (count > 0) {
                badge.textContent=count;
                badge.style.display = "inline-block";
            } else {
                badge.style.display = "none";   
            }
        }
    }
}

// Ejecutar al cargar la página
window.onload = actualizarBadges;

// Ejecutar cada vez que eliminas notificaciones
function eliminarNotificacion(area, index) {
    notificacionesData[area].splice(index, 1);
    mostrarNotificaciones(area);
    actualizarBadges();
}

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
  const registros = document.getElementById('registro-horas');

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
});


document.addEventListener('DOMContentLoaded', () => {
  const btnCorreccion = document.getElementById('modificacion-checada');
  const formularioCorreccion = document.getElementById('formulario-correccion');
  
  btnCorreccion.addEventListener('click', () => {
    const isVisible = formularioCorreccion.style.display === 'flex';
    formularioCorreccion.style.display = isVisible ? 'none' : 'flex';

  });
});



