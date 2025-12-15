// Espera a que todo el contenido de la página se cargue
document.addEventListener('DOMContentLoaded', function() {

//         ------------------------------------   VACIADO DE CHECADAS EN TABLAS  -------------------------------------           
    // --- Vaciado de horas
    const userData = window.AppConfig;
    console.log('Datos del usuario cargados desde AppConfig:', userData);


    const contenedorEntradas = document.querySelector('.contenedor-registros .registro-horas:nth-child(1)');
    const contenedorSalidas  = document.querySelector('.contenedor-registros .registro-horas:nth-child(2)');
    const contenedorTiempos  = document.querySelector('.contenedor-registros .registro-horas:nth-child(3)');

    // Función para limpiar 
    function limpiarTablas() {
        contenedorEntradas.innerHTML = '<h3>Hora de entrada</h3>';
        contenedorSalidas.innerHTML  = '<h3>Hora de salida</h3>';
        contenedorTiempos.innerHTML  = '<h3>Tiempo transcurrido</h3>';
    }

    // Función quitar segundos
    function formatearHora(horaString) {
        if (!horaString) return "--:--";
        // Si viene como 09:00:00, cortamos los últimos 3 caracteres
        return horaString.length > 5 ? horaString.substring(0, 5) : horaString;
    }

    // Función Calcular diferencia de tiempo
    function calcularDiferencia(horaInicio, horaFin) {
        const d1 = new Date("2000-01-01T" + horaInicio);
        const d2 = new Date("2000-01-01T" + horaFin);
        
        let diff = d2 - d1; 
        if (diff < 0) return "--:--"; // Validación por si eerror de dato

        const totalMinutos = Math.floor(diff / 60000);
        const horas = Math.floor(totalMinutos / 60);
        const minutos = totalMinutos % 60;
        
        // Formato 00:00
        return `${String(horas).padStart(2, '0')}:${String(minutos).padStart(2, '0')}`;
        
    }

// Ejecutamos la lógica si hay datos
    if (userData && Array.isArray(userData)) {
        console.log("Procesando registros de BD...", userData);
        limpiarTablas(); // Borramos los guiones estáticos

        // Variables temporales para alinear filas
        let ultimaEntrada = null; 

        userData.forEach(registro => {
            // Division de /
            const partes = registro.split('/');
            
            // Validamos que funcionó
            if (partes.length < 2) return; 

            const tipo = partes[0].toLowerCase().trim(); 
            const hora = partes[1];

            // 
            const p = document.createElement('p');
            p.textContent = formatearHora(hora);

            // vaceado de entradas y salidas
            if (tipo.includes('entrada') || tipo == '1') { 

                contenedorEntradas.appendChild(p);
                ultimaEntrada = hora; // Guardamos esta hora para calcular tiempo cuando llegue la salida
                

            } else if (tipo.includes('salida') || tipo == '2') {
                
                contenedorSalidas.appendChild(p);

                // Calcular tiempo transcurrido si tenemos una entrada previa
                const pTiempo = document.createElement('p');
                if (ultimaEntrada) {
                    pTiempo.textContent = calcularDiferencia(ultimaEntrada, hora);
                    ultimaEntrada = null; 
                } else {
                    pTiempo.textContent = "--:--"; // Salida sin entrada registrada
                }
                contenedorTiempos.appendChild(pTiempo);
            }
        });
        
        const numEntradas = contenedorEntradas.querySelectorAll('p').length;
        const numSalidas = contenedorSalidas.querySelectorAll('p').length;

        if (numEntradas > numSalidas) {
            const pPendiente = document.createElement('p');
            pPendiente.textContent = "--:--"; 
            pPendiente.style.color = "#aaa"; 
            contenedorSalidas.appendChild(pPendiente);

            const pTiempoPendiente = document.createElement('p');
            pTiempoPendiente.textContent = "Contando...";
            contenedorTiempos.appendChild(pTiempoPendiente);
        }
    }

// ------------------------------------------- TERMINACION DE FUNCIONES PARA VACEADO DE CHECADAS ----------------------------- ---



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
            iconoElemento.textContent = (now.getHours() >= 6 && now.getHours() < 18) ? '☀' : '🌙';
        }
    }
    setInterval(actualizarReloj, 1000);
    actualizarReloj();

   
    
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