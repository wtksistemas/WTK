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
