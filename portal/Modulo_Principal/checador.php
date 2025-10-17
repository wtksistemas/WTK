<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checador</title>
    <link rel="stylesheet" href="css/style.css">
	<link rel="shortcut icon" href="../img/Principales/favicon.ico">
</head>

<body>
	
	<?php
	//	session_start();
	  //include "../php/control.php";
	//if (/$_SESSION['id'] == '888')
	//	{
	//	}
	//	else{
	//		header("Location:../index.html");
	//	}	
	?>

<!--<header>
		<nav class="top-nav">
			<div class="perfil">
				<button class="btn-perfil">Perfil</button>
				<button class="btn-cerrar">Cerrar Sesión</button>
			</div>
		</nav>
	</header>-->
	   
	
    <!-- Contenedor principal -->
    <div class="contenedor-principal">
		
		<!-- Menú superior -->
		<div class="menu-superior">
			<!-- Opciones del menú -->
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
                    
										
				<button class="area-tarjeta" id="btn-abrir-modal">
					<img src="../img/modulo_checador/vacaciones.png" alt="Solicitar Vacaciones">
					<span>Vacaciones</span>
				</button>

                <div class="area-tarjeta">
                    <img src="../img/modulo_checador/permisos.png" alt="Permisos">
                    <p>Permisos y Justificaciones</p>
                </div>

            </div>

            <div class="contenedor-central">
                    
                <div class="reloj-minimalista" id="reloj">
                    <div class="hora" id="hora-actual"></div>
                    <div class="fecha" id="fecha-actual"></div>
                    <div class="icono" id="icono-dia-noche"></div>
                </div>

                <div class="contenedor-boton-horas">
                    
                    <button class="boton-checar" id="boton-checar">Registrar Entrada/Salida</button>
                  
                    <button class="boton-correccion" id="modificacion-checada">¿Deseas realizar una corrección de checada?</button>

                    <form class="formulario-correccion" id="formulario-correccion">

                        <h3>Realizar corrección de checada</h3>

                            <label for="opcion-hora">Selecciona qué hora corregir:</label>
                                <select id="opcion-hora" required>
                                    <option value="entrada">Hora de entrada</option>
                                    <option value="entrada-comida">Entrada de comida</option>
                                    <option value="salida-comida">Salida de comida</option>
                                    <option value="salida">Hora de salida</option>
                                </select>

                            <label for="hora-correcta">Hora correcta:</label>
                            <input type="time" id="hora-correcta" required>

                            <label for="comentarios">Comentarios:</label>
                            <textarea id="comentarios" rows="3" placeholder="Describe la razón de la corrección" required></textarea>

                            <button type="submit">Enviar corrección</button>
                    </form>
                </div>
            
            </div>

            <div class="contenedor-registros" id="contenedor-registros">
                <div class="registro-horas">
                    <h3>Hora de entrada</h3>
                </div>

                <div class="registro-horas">
                    <h3>Hora de salida</h3>
                </div>

                <div class="registro-horas">
                    <h3>Tiempo transcurrido</h3>
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
                
                <form id="form-permisos">
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

<script src="js/checador.js"></script>
</body>
</html>