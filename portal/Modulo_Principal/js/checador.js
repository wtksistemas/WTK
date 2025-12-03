// Espera a que todo el contenido de la página se cargue
document.addEventListener('DOMContentLoaded', function() {

    // --- LÓGICA PARA MANEJAR MENÚS DESPLEGABLES ---
    const dropdowns = document.querySelectorAll('.dropdown');
    dropdowns.forEach(dropdown => {
        const toggle = dropdown.querySelector('.dropdown-toggle');
        toggle.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            dropdown.classList.toggle('active');
            // Cierra otros menús desplegables
            dropdowns.forEach(other => {
                if (other !== dropdown) other.classList.remove('active');
            });
        });
    });

    // Cierra los menús si se hace clic fuera de ellos
    document.addEventListener('click', function(e) {
        if (!e.target.closest('.dropdown')) {
            dropdowns.forEach(dropdown => {
                dropdown.classList.remove('active');
            });
        }
    });

    // --- LÓGICA DEL RELOJ CHECADOR ---
    function actualizarReloj() {
        const horaElemento = document.getElementById('hora-actual');
        const fechaElemento = document.getElementById('fecha-actual');
        const iconoElemento = document.getElementById('icono-dia-noche');
        if (horaElemento) { // Asegurarse de que el elemento exista
            const now = new Date();
            horaElemento.textContent = now.toLocaleTimeString('es-MX', { hour: '2-digit', minute: '2-digit', second: '2-digit' });
            fechaElemento.textContent = now.toLocaleDateString('es-MX', { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' });
            iconoElemento.textContent = (now.getHours() >= 6 && now.getHours() < 18) ? '☀️' : '🌙';
        }
    }
    setInterval(actualizarReloj, 1000);
    actualizarReloj();

    // --- LÓGICA PARA REGISTRAR ENTRADAS/SALIDAS ---
    const btnChecar = document.getElementById('boton-checar');
    if (btnChecar) {
        const entradasContainer = document.querySelector('.contenedor-registros .registro-horas:nth-child(1)');
        const salidasContainer = document.querySelector('.contenedor-registros .registro-horas:nth-child(2)');
        const tiemposContainer = document.querySelector('.contenedor-registros .registro-horas:nth-child(3)');
        const registrosDeTiempo = []; // Lista para guardar los registros

        // Limpiamos los contenedores al iniciar
    //    entradasContainer.innerHTML = '<h3>Hora de entrada</h3>';
      //  salidasContainer.innerHTML = '<h3>Hora de salida</h3>';
        //tiemposContainer.innerHTML = '<h3>Tiempo transcurrido</h3>';

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
            registrosDeTiempo.push(ahora);

            if (registrosDeTiempo.length % 2 !== 0) { // Es una entrada (impar)
                const nuevaEntradaP = document.createElement('p');
                nuevaEntradaP.textContent = horaFormateada;
                entradasContainer.appendChild(nuevaEntradaP);

                const nuevaSalidaP = document.createElement('p');
                nuevaSalidaP.textContent = '--:--';
                salidasContainer.appendChild(nuevaSalidaP);

                const nuevoTiempoP = document.createElement('p');
                nuevoTiempoP.textContent = '--:--';
                tiemposContainer.appendChild(nuevoTiempoP);

                alert(`Entrada registrada a las ${horaFormateada}!`);
            } else { // Es una salida (par)
                const ultimaSalidaP = salidasContainer.querySelector('p:last-child');
                if (ultimaSalidaP) ultimaSalidaP.textContent = horaFormateada;

                const tiempoSalidaActual = registrosDeTiempo[registrosDeTiempo.length - 1];
                const tiempoEntradaPrevia = registrosDeTiempo[registrosDeTiempo.length - 2];
                const diff = tiempoSalidaActual - tiempoEntradaPrevia;

                const ultimoTiempoP = tiemposContainer.querySelector('p:last-child');
                if (ultimoTiempoP) ultimoTiempoP.textContent = formatearMilisegundos(diff);

                alert(`Salida registrada a las ${horaFormateada}!`);
            }
        });
    }
    
    // --- LÓGICA PARA CORRECCIÓN DE CHECADA ---
    const btnCorreccion = document.getElementById('modificacion-checada');
    if (btnCorreccion) {
        const formularioCorreccion = document.getElementById('formulario-correccion');
        const contenedorRegistros = document.getElementById('contenedor-registros');
        
        btnCorreccion.addEventListener('click', () => {
            const isVisible = formularioCorreccion.style.display === 'flex';
            formularioCorreccion.style.display = isVisible ? 'none' : 'flex';
            contenedorRegistros.classList.toggle('desplazar-abajo');
        });
    }

    // --- LÓGICA DEL MODAL DE PERMISOS Y JUSTIFICACIONES ---
    const modal = document.getElementById('modal-formulario');
    const btnAbrirModal = document.getElementById('btn-abrir-modal');
    const btnsCerrarModal = document.querySelectorAll('.modal-cerrar, .btn-cerrar-modal');

    if (modal && btnAbrirModal) {
        const abrirModal = () => modal.classList.remove('oculto');
        const cerrarModal = () => modal.classList.add('oculto');

        btnAbrirModal.addEventListener('click', abrirModal);
        btnsCerrarModal.forEach(btn => btn.addEventListener('click', cerrarModal));
        
        // Cierra el modal si se hace clic en el fondo oscuro

        modal.addEventListener('click', (e) => {
            if (e.target === modal) {
                cerrarModal();
            }
        });

        const cargaLinks = document.querySelectorAll('.carga-link');
        const tabContents = document.querySelectorAll('.modal-contenido .tab-content');
        
        cargaLinks.forEach(link => {
            link.addEventListener('click', () => {
                cargaLinks.forEach(l => l.classList.remove('active'));
                tabContents.forEach(t => t.classList.remove('active'));
                link.classList.add('active');
                const tabId = link.getAttribute('data-tab');
                document.getElementById(tabId).classList.add('active');
            });
        });
        
        const motivoPermisoSelect = document.getElementById('motivo-permiso');
        const otroMotivoContainer = document.getElementById('otro-motivo-permiso-container');

        if (motivoPermisoSelect) {
            motivoPermisoSelect.addEventListener('change', function() {
                otroMotivoContainer.style.display = (this.value === 'otro') ? 'flex' : 'none';
            });
        }
    }
});