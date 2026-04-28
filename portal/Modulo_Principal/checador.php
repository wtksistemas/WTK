<!DOCTYPE html>
<html lang="es">


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checador</title>
    <link rel="stylesheet" href="css/style.css">
	<link rel="shortcut icon" href="../img/Principales/favicon.ico">
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
</head>


<body>	

<?php
		session_start();
		if(!isset($_SESSION['logeado']) || $_SESSION['logeado'] !== true)
			{
				session_unset();
    			session_destroy();
				header("Location: ../../index.html?v=28");
				exit;
			}
	    include "../../php/dbconnect.php";
        $mail=$_SESSION['username'];
        $id=$_SESSION['user_id'];
        $hoy=date("Y-m-d");
        $sql="SELECT c_fecha, c_horaregistro, c_tiporegistro FROM tb_checador WHERE c_idusuario=? and c_fecha>=? ORDER BY c_fecha desc , c_horaregistro desc LIMIT 10";

        $stmt = $conn->prepare($sql);
	    // Si la consulta no se prepara correctamente
	    if(!$stmt)
	{
		header("Location: ../index.html?v=0");
		exit();
	}
	$stmt->bind_param("is",$id,$hoy);
	$stmt->execute();
	$result = $stmt->get_result();
    $num_rows = $result->num_rows;

    $i=0;
    //$registros_checador=[];
    // Guardamos los datos del usuario
    
    while($row = $result->fetch_assoc()){
       $registros_checador[] = $row["c_tiporegistro"]."/".$row["c_horaregistro"];

        
        echo $registros_checador[$i]."<br>";
        $i=$i+1;
    }

 	$arreglo_entradas=json_encode($registros_checador);


?>
<script>
        // Creamos un objeto global para guardar los datos.
        window.AppConfig = <?php echo $arreglo_entradas?>;
        
        console.log("Datos inyectados en la página: ", window.AppConfig);
    </script>

  
    <div class="contenedor-principal">
		<div class="menu-superior">
			<div class="opciones">
				<ul class="menu">
					<li class="dropdown">
						<a href="#" class="dropdown-toggle">Checador</a>
						<ul class="submenu">
							<li><a id="submenu" href="checador.php">Ver Checador</a></li>
							<li><a id="submenu" href="vacaciones.php">Vacaciones</a></li>
						</ul>
					</li>
				</ul>
			
				<ul class="menu">
					<li><a href="notificaciones.php">Notificaciones</a></li>
				</ul>

				<ul class="menu">
					<li class="dropdown">
						<a href="#" class="dropdown-toggle">Nóminas</a>
						<ul class="submenu">
							<li><a id="submenu" href="../Modulo_Nominas/nomina.php">Cotizador</a></li>
							<li><a id="submenu" href="../Modulo_Nominas/validacion.php">Validación de cuentas</a></li>
						</ul>
					</li>
				</ul>
			
				<ul class="menu">
					<li><a href="../Modulo_Legal/legal.php">Legal</a></li>
				</ul>
			</div>
        
			<div class="perfil">

				<a href="menu.php">
					<img src="../img/Principales/home.png" class="img-perfil">
				</a>

				<?php
					//echo "<span style='color: white;'>".$_SESSION['username']."</span>";
				?>

				<a href="../../php/logout.php"><button type="button">Cerrar sesión</button></a>
			</div>

		</div>
            
        <!------------------------------------------------ BODY ----------------------------------------------	 -->
		
        <div class="grid-checador">

            <div class="lado-izquierdo">
                    							
                <button class="area-tarjeta" id="btn-abrir-vacaciones">
                    <img src="../img/modulo_checador/vacaciones.png" alt="Solicitar Vacaciones">
                    <p>Vacaciones</p>
                </button>

                <button class="area-tarjeta" id="btn-abrir-modal">
                    <img src="../img/modulo_checador/permisos.png" alt="Permisos">
                    <p>Permisos y justificaciones</p>
                </button>

            </div>

            <div class="contenedor-central">
                    
                <div class="reloj-minimalista" id="reloj">
                    <div class="hora" id="hora-actual"></div>
                    <div class="fecha" id="fecha-actual"></div>
                    <div class="icono" id="icono-dia-noche"></div>
                </div>

                <div class="contenedor-boton-horas">

                    <div id="modal-correccion" class="modal-overlay oculto">
                        <div class="modal-contenido">
                            <button class="modal-cerrar">&times;</button>
                        
                            <h2>Solicitud de Modificación</h2>
                        
                            <div class="tabs-modal">
                                <button type="button" class="tab-btn active" data-tab="view-omision">Omisión (Olvidé checar)</button>
                                <button type="button" class="tab-btn" data-tab="view-correccion">Corrección (Hora incorrecta)</button>
                            </div>

                            <form id="form-correccion-global" method="POST" action="#">
                                <input type="hidden" name="tipo_operacion" id="tipo-operacion" value="omision">

                                <div id="view-omision" class="tab-contenido active">
                                    <p class="subtitulo-modal">Registra una checada que no existe en el sistema.</p>
                                    <div class="form-row">
                                        <div class="form-group half-width">
                                            <label for="fecha-omision">Fecha del olvido</label>
                                            <input type="date" id="fecha-omision" name="fecha_omision">
                                        </div>
                                        <div class="form-group half-width">
                                            <label for="tipo-registro-omision">Tipo de registro</label>
                                            <select id="tipo-registro-omision" name="tipo_registro_omision">
                                                <option value="entrada">Entrada Laboral</option>
                                                <option value="salida_comida">Salida a Comer</option>
                                                <option value="entrada_comida">Regreso de Comer</option>
                                                <option value="salida">Salida Laboral</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group half-width">
                                            <label for="hora-omision">Hora Real</label>
                                            <input type="time" id="hora-omision" name="hora_omision">
                                        </div>
                                    </div>
                                </div>

                                <div id="view-correccion" class="tab-contenido">
                                    <p class="subtitulo-modal">Selecciona el día para ver tus registros y corregir la hora.</p>
                                    
                                    <div class="form-row">
                                        <div class="form-group full-width">
                                            <label for="fecha-busqueda">Selecciona Fecha a Corregir</label>
                                            <input type="date" id="fecha-busqueda" name="fecha_busqueda">
                                        </div>
                                    </div>

                                    <div id="lista-checadas-dia" class="lista-checadas-container">
                                        <p style="text-align:center; color:#999; padding:20px;">
                                            Selecciona una fecha para cargar registros...
                                        </p>
                                    </div>
                                    
                                    <input type="hidden" id="id-checada-editar" name="id_checada_editar">
                                </div>

                                <hr style="border:0; border-top:1px solid #eee; margin:15px 0;">
                                
                                <div class="form-row">
                                    <div class="form-group full-width">
                                        <label for="motivo-solicitud">Motivo (Requerido)</label>
                                        <textarea id="motivo-solicitud" name="motivo_solicitud" rows="2" 
                                            placeholder="Explica brevemente la razón..." required></textarea>
                                    </div>
                                </div>

                                <div class="form-acciones">
                                    <button type="button" class="btn-secundario btn-cerrar-modal-accion">Cancelar</button>
                                    <button type="submit" class="btn-primario">Enviar Solicitud</button>
                                </div>
                            </form>
                        </div>
                    </div>

		        </div>
            </div>    

            <div class="lado-derecho">
    
                <form action="php/registro_checada.php" method="post">
            
                    <button class="area-tarjeta" id="boton-checar" type="submit">
                        <img src="../img/modulo_checador/reloj.png" alt="Permisos">
                        <p>Registrar Entrada/Salida</p>
                    </button>

                </form>  

                <button class="area-tarjeta" id="modificacion-checada">
                    <img src="../img/modulo_checador/correccion.png" alt="Permisos">
                    <p>Corrección de Checadas</p>
                </button>

            </div>

        
            <div class="contenedor-registros" id="contenedor-registros">
                <div class="registro-horas">
                    <h3>Hora de entrada</h3>
                        <p>--:-- --</p>
                        <p>--:-- --</p>
                        <p>--:-- --</p>
                </div>

                <div class="registro-horas">
                    <h3>Hora de salida</h3>
                        <p name="">--:-- --</p>
                        <p>--:-- --</p>
                        <p>--:-- --</p>
                </div>

                <div class="registro-horas">
                    <h3>Tiempo transcurrido</h3>
                        <p>--:-- --</p>
                        <p>--:-- --</p>
                        <p>--:-- --</p>
                </div>
            </div>

            <div id="modal-vacaciones" class="modal-overlay oculto">
                <div class="modal-contenido">
                    <button class="modal-cerrar" id="cerrar-vacaciones">&times;</button>
                
                    <h2>Gestión de Vacaciones</h2>
                
                    <div class="tabs-modal">
                        <button type="button" class="tab-btn active" data-tab="view-solicitud-vac">Solicitar</button>
                        <button type="button" class="tab-btn" data-tab="view-historial-vac">Historial</button>
                    </div>

                    <div id="view-solicitud-vac" class="tab-contenido active">
                        
                        <div class="vac-header-info">
                            <div class="badge-antiguedad">
                                Días por antigüedad: <strong id="val-antiguedad">12 días</strong>
                            </div>
                        </div>



                        <form id="form-vacaciones" method="POST" action="#">
                            <div class="cards-resumen">
                                <div class="card-dato">
                                    <span>Días Disponibles</span>
                                    <strong class="texto-naranja" id="dias-disponibles">10</strong>
                                </div>
                                <div class="card-dato">
                                    <span>Descontar</span>
                                    <strong class="texto-gris" id="dias-solicitados">0</strong>
                                </div>
                                <div class="card-dato">
                                    <span>Saldo final</span>
                                    <strong class="texto-verde" id="saldo-restante">10</strong>
                                </div>
                            </div>

                            <div class="vac-layout-container">
                                
                                <div class="vac-col-calendario">
                                    <label>Selecciona tus días en el calendario:</label>
                                    <div id="vac-calendar-inline"></div>
                                    <input type="hidden" id="vac-fechas-hidden" name="vac_fechas">
                                </div>

                                <div class="vac-col-detalles">
                                    <div class="form-group">
                                        <label for="vac-comentarios">Observaciones / Pendientes</label>
                                        <textarea id="vac-comentarios" name="vac_comentarios" rows="8" placeholder="Escribe aquí tus pendientes o notas..."></textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="form-acciones">
                                <button type="button" class="btn-secundario" id="btn-cancelar-vac">Cancelar</button>
                                <button type="submit" class="btn-primario">Enviar Solicitud</button>
                            </div>
                        </form>
                    </div>
                    <div id="view-historial-vac" class="tab-contenido">
                        
                        <div style="margin-bottom: 30px;">
                            <p class="subtitulo-modal" style="color: #F65100; font-weight: bold;">Trámites Recientes</p>
                            <div class="contenedor-tabla-historial">
                                <table class="tabla-historial">
                                    <thead>
                                        <tr>
                                            <th>Fecha de Solicitud</th>
                                            <th>Fechas Seleccionadas</th>
                                            <th>Total Días</th>
                                            <th>Estado</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody id="lista-solicitudes-recientes">
                                        <tr>
                                            <td>2026-05-12</td>
                                            <td><small>2026-05-12, 2026-05-13</small></td>
                                            <td>2</td>
                                            <td><span class="badge-estado badge-pendiente">Pendiente</span></td>
                                            <td>
                                                <button class="btn-secundario" style="padding: 4px 8px; font-size: 0.75rem; background-color: #ffcccc; color: #cc0000; border: none;">Cancelar</button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>2026-04-12</td>
                                            <td><small>2026-04-10, 2026-04-11</small></td>
                                            <td>2</td>
                                            <td><span class="badge-estado badge-aprobado">Aprobado</span></td>
                                            <td>
                                                <button class="btn-secundario" style="padding: 4px 8px; font-size: 0.75rem;">Recordar</button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div>
                            <p class="subtitulo-modal" style="color: #28a745; font-weight: bold;">Histórico de Vacaciones Disfrutadas</p>
                            <div cl|ass="contenedor-tabla-historial">
                                <table class="tabla-historial">
                                    <thead>
                                        <tr>
                                            <th>Fecha de Solicitud</th>
                                            <th>Ciclo Afectado</th>
                                            <th>Días Consumidos</th>
                                            <th>Autorizó</th>
                                            <th>Acuse</th>
                                        </tr>
                                    </thead>
                                    <tbody id="lista-vacaciones-historico">
                                        <tr>
                                            <td>2026-05-12</td>
                                            <td>2024-2025</td>
                                            <td>6</td>
                                            <td>Liliana Escalante</td>
                                            <td>
                                                <button class="btn-secundario" style="padding: 4px 8px; font-size: 0.75rem;">VER</button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>2026-04-12</td>
                                            <td>2023-2024</td>
                                            <td>12</td>
                                            <td>Tania Guzman</td>
                                            <td>
                                                <button class="btn-secundario" style="padding: 4px 8px; font-size: 0.75rem;">VER</button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        

			                        <!--	---------------------------------------------- modal permisos y justificaciones ----------------------------------------------	 -->

            <div id="modal-formulario" class="modal-overlay oculto">
                <div class="modal-contenido">
                    <button class="modal-cerrar">&times;</button>

                    <div class="mod-carga">
                        <button class="carga-link active" data-tab="tab-permisos">Permisos</button>
                        <button class="carga-link" data-tab="tab-justificaciones">Justificaciones</button>
                    </div>            
                    
                    <div id="tab-permisos" class="tab-content active">

                        <div class="form-header">
                            <h2>Registro de Permisos</h2>
                            <p>Introduce la información para solicitar un permiso</p>
                        </div>
                        
                        <form  id="form-permisos">
                            <div class="form-row">
                                <div class="form-group">
                                    <label for="tipo-permiso">Tipo de Permiso</label>
                                    <select id="tipo-permiso" name="tipo-permiso" required>
                                        <option value="">Seleccione una opcion</option>
                                        <option value="con-goce">Con Goce de Sueldo</option>
                                        <option value="sin-goce">Sin Goce de Sueldo</option>
                                    </select>
                                </div>
                                
                                <div class="form-group">
                                    <label for="motivo-permiso">Motivo</label>
                                    <select id="motivo-permiso" name="motivo-permiso" required>
                                        <option value="">Seleccione un Motivo</option>
                                        <option value="cita-medica">Cita Médica</option>
                                        <option value="asuntos-personales">Asuntos Personales</option>
                                        <option value="falla-transporte">Falla de Transporte</option>
                                        <option value="otro">Otro</option>
                                    </select>
                                </div>
                            </div>
                            

                            <div class="form-row" id="otro-motivo-permiso-container" style="display: none;">
                                <div class="form-group full-width">
                                    <label for="otro-motivo-permiso">Especifique el motivo</label>
                                    <input type="text" id="otro-motivo-permiso" name="otro-motivo-permiso">
                                </div>
                            </div>

                            

                            <div class="form-row">
                                <div class="form-group">
                                    <label class="fecha-inicio-permiso">Fecha de Incio del Permiso</label>
                                    <input type="date" id="fecha-inicio-permiso" name="fecha-inicio-permiso" required>
                                </div>
                                <div class="form-group">
                                    <label class="fecha-fin-permiso">Fecha de Fin del Permiso</label>
                                    <input type="date" id="fecha-fin-permiso" name="fecha-fin-permiso" required>
                                </div>
                            </div>


                            <div class="form-row">
                                <div class="form-group full-width">
                                    <label for="comentarios-permiso">Comentarios Adicionales</label>
                                    <textarea id="comentarios-permiso" name="comentarios-permiso" rows="4" placeholder="Añade comentarios adicionales..."></textarea>
                                </div>
                            </div>

                            <div class="form-acciones">
                                <button type="button" class="btn-secundario btn-cerrar-modal">Cancelar</button>
                                <button type="submit" class="btn-primario">Solicitar Permiso</button>       
                            </div>

                        </form>
                    </div>

                    <div id="tab-justificaciones" class="tab-content">
                        <div class="form-header">
                            <h2>Registro de Justificaciones</h2>
                            <p>Justifica una falta o retardo</p>
                        </div>
                        
                        <form id="form-justificaciones">
                            <div class="form-row">
                                <div class="form-group">
                                    <label for="tipo-justificacion">Tipo de Justificación</label>
                                    <select id="tipo-justificacion" name="tipo-justificacion" required>
                                        <option value="">Seleccione una opcion</option>
                                        <option value="falta">Falta</option>
                                        <option value="retardo">Retardo</option>
                                    </select>
                                </div>
                            
                                <div class="form-group">
                                    <label for="fecha-incidencia">Fecha de la Incidencia</label>
                                    <input type="date" id="fecha-incidencia" name="fecha-incidencia" required>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group full-width">
                                    <label for="motivo-justificacion">Motivo de la Justificación</label>
                                    <textarea id="motivo-justificacion" name="motivo-justificacion" rows="4" placeholder="Describe brevemente el motivo..." required></textarea>
                                </div>
                            </div> 

                            <div class="form-row">
                                <div class="form-group full-width">
                                    <label for="archivo-justificacion">Adjuntar Comprobante (opcional)</label>
                                    <input type="file" id="archivo-justificacion" name="archivo-justificacion" class="input-file" accept=".pdf,.jpg,.png"> <!-- Acepta archivos PDF e imágenes?? -->
                                </div>
                            </div> 

                            <div class="form-acciones">
                                <button type="button" class="btn-secundario btn-cerrar-modal">Cancelar</button>
                                <button type="submit" class="btn-primario">Enviar Justificación</button>       
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

<script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/es.js"></script>
<script src="js/checador.js"></script>
</body>
</html>
