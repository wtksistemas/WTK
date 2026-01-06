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

   
 
// --- LÓGICA MODAL CORRECCIÓN Y PESTAÑAS ---
    const modalCorreccion = document.getElementById('modal-correccion');
    const btnAbrirCorreccion = document.getElementById('modificacion-checada');
    const btnsCerrar = modalCorreccion ? modalCorreccion.querySelectorAll('.modal-cerrar, .btn-cerrar-modal-accion') : [];
    
    // Referencias Tabs
    const tabBtns = modalCorreccion ? modalCorreccion.querySelectorAll('.tab-btn') : [];
    const tabContenidos = modalCorreccion ? modalCorreccion.querySelectorAll('.tab-contenido') : [];
    const inputOperacion = document.getElementById('tipo-operacion');

    // Referencias Corrección
    const inputFechaBusqueda = document.getElementById('fecha-busqueda');
    const contenedorLista = document.getElementById('lista-checadas-dia');

    // 1. Abrir Modal
    if (btnAbrirCorreccion && modalCorreccion) {
        btnAbrirCorreccion.addEventListener('click', () => {
            modalCorreccion.classList.remove('oculto');
            // Resetear a pestaña por defecto (Omisión)
            activarPestana('view-omision');
        });
    }

    // 2. Cerrar Modal
    btnsCerrar.forEach(btn => {
        btn.addEventListener('click', () => {
            modalCorreccion.classList.add('oculto');
            document.getElementById('form-correccion-global').reset();
            contenedorLista.innerHTML = '<p style="text-align:center; color:#999; padding:20px;">Selecciona una fecha...</p>';
        });
    });

    // 3. Sistema de Pestañas
    tabBtns.forEach(btn => {
        btn.addEventListener('click', () => {
            const targetId = btn.getAttribute('data-tab');
            activarPestana(targetId);
        });
    });

    function activarPestana(idTab) {
        // Actualizar botones visualmente
        tabBtns.forEach(b => {
            if(b.getAttribute('data-tab') === idTab) b.classList.add('active');
            else b.classList.remove('active');
        });

        // Mostrar contenido correspondiente
        tabContenidos.forEach(c => {
            if(c.id === idTab) c.classList.add('active');
            else c.classList.remove('active');
        });

        // Actualizar input oculto para el backend
        if (idTab === 'view-omision') {
            inputOperacion.value = 'omision';
            // Validaciones HTML5 dinámicas
            document.getElementById('fecha-omision').setAttribute('required', 'true');
            document.getElementById('hora-omision').setAttribute('required', 'true');
            document.getElementById('fecha-busqueda').removeAttribute('required');
        } else {
            inputOperacion.value = 'correccion';
            document.getElementById('fecha-omision').removeAttribute('required');
            document.getElementById('hora-omision').removeAttribute('required');
            document.getElementById('fecha-busqueda').setAttribute('required', 'true');
        }
    }

    if (inputFechaBusqueda) {
        inputFechaBusqueda.addEventListener('change', (e) => {
            const fechaSeleccionada = e.target.value;
            if(!fechaSeleccionada) return;

            contenedorLista.innerHTML = '<p style="text-align:center; color:#F65100;">Buscando registros...</p>';

            setTimeout(() => {
                
                const mockChecadas = [
                    { id: 101, tipo: 'Entrada', hora: '09:05:00' },
                    { id: 102, tipo: 'Salida Comida', hora: '14:10:00' },
                    { id: 103, tipo: 'Salida', hora: '18:00:00' }
                ];

                renderizarChecadas(mockChecadas);

            }, 600); 
        });
    }

    function renderizarChecadas(lista) {
        if (lista.length === 0) {
            contenedorLista.innerHTML = '<p style="text-align:center;">No hay registros este día.</p>';
            return;
        }

        let html = '';
        lista.forEach(item => {
            html += `
            <div class="item-checada">
                <div class="info-checada">
                    <span class="tipo">${item.tipo}</span>
                    <span class="hora-orig">Registrado: ${item.hora}</span>
                </div>
                <div class="accion-editar">
                    <label style="font-size:0.8rem;">Cambiar a:</label>
                    <input type="time" class="input-correccion-tiempo" 
                           value="${item.hora}" 
                           data-id="${item.id}"
                           onchange="seleccionarChecadaEditar(this)">
                </div>
            </div>`;
        });
        contenedorLista.innerHTML = html;
    }

    window.seleccionarChecadaEditar = function(input) {
        const id = input.getAttribute('data-id');
        const nuevaHora = input.value;
        
        document.getElementById('id-checada-editar').value = id;
        
        document.querySelectorAll('.input-correccion-tiempo').forEach(i => {
            if(i !== input) i.style.borderColor = '#ccc';
            else i.style.borderColor = '#F65100'; 
        });

        console.log(`Listo para enviar corrección: ID ${id} -> Nueva Hora ${nuevaHora}`);
    };







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