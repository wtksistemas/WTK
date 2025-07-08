<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel Principal</title>
    <link rel="stylesheet" href="css/style.css">
    <script defer src="js/checador.js"></script>
</head>
<body>
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
                        <li><a id="submenu" href="nominas/nomina.php">Cotizador</a></li>
                        <li><a id="submenu" href="nominas/validacion.php">Validación de cuentas</a></li>
                    </ul>
                </li>
            </ul>
            <ul class="menu">
                <li><a href="legal/legal.php">Legal</a></li>
            </ul>
        </div>
        <div class="perfil">
            <a href="menu.php">
                <img src="img/home.png" class="img-perfil" alt="Inicio">
            </a>
            <a href="../php/logout.php"><button type="button">Cerrar sesión</button></a>
        </div>
    </div>

    <div class="contenedor-principal">
        <div class="grid-checador">
            <div class="lado-izquierdo">
                <div class="area-tarjeta">
                    <img src="img/vacaciones.png" alt="Vacaciones">
                    <p>Vacaciones</p>
                </div>
                <div class="area-tarjeta">
                    <img src="img/permisos.png" alt="Permisos">
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
<!--
                    <div class="registro-horas" id="registro-horas">
                        <p>Hora de entrada: --:--</p>
                        <p>Entrada de comida: --:--</p>
                        <p>Salida de comida: --:--</p>
                        <p>Hora de salida: --:--</p>
                    </div> -->
                    
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

            <div class="registro-horas" id="registro-horas">
                <p>Hora de entrada: --:--</p>
                <p>Entrada de comida: --:--</p>
                <p>Salida de comida: --:--</p>
                <p>Hora de salida: --:--</p>
            </div>

        </div>
    </div>
</body>
</html>
