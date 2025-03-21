<!DOCTYPE html>
<html lang="es">
<head>
<?php	 
    session_start();
    include "../../php/control.php";
    if ($_SESSION['id'] != '888') 
    {
        header("Location: ../../index.html");
    }
    else
    {
       
    }
?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Corporativo - Instrumentos Notariales</title>
    <link rel="stylesheet" href="../css/style.css">
    <script src="js/legal.js"></script>
    <script src="../../js/script.js"></script>
</head>
<body>
    <div class="contenedor-principal">
        <div class="menu-superior">
            <div class="opciones">
                <ul class="menu">
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle">Nóminas</a>
                            <ul class="submenu">
                                <li><a id="submenu" href="../nominas/nomina.php">Cotizador</a></li>
                                <li><a id="submenu" href="../nominas/validacion.php">Validación de cuentas</a></li>
                            </ul>
                        </li>
                    </ul>
                
                    <ul class="menu">
                        <li><a href="../legal/legal.php">Legal</a></li>
                    </ul>
            </div>
            <div class="perfil">
                <a href="../menu.php">
                    <img src="../img/home.png" class="img-perfil">
                </a>
                <?php echo "<span style='color: white;'>".$_SESSION['username']."</span>";  ?>
                <a href="../../php/logout.php"><button type="button" class="btn">Cerrar sesión</button></a>
            </div>
        </div>
        <div class="contenido formulario-contenido">
            <div class="formulario-nuevo-instrumento">
                <form action="php/altainstr.php" method="post">
                    <h1 class="titulo-formulario">Nuevo Instrumento Notarial</h1>
                    <div class="campo-formulario" id="contenedor_primera_fila">
                        <select id="ncliente" name="cliente">
                            <option value="0">Selecciona un cliente</option>
                        </select>
                        <input id="nnotaria" name="notaria" type="number" placeholder="Notaria">
                    </div>
                    <div class="campo-formulario">
                        <input id="nuescritura" name="escritura" type="number" placeholder="N° de Escritura">
                        <select id="estado" name="nestado"></select>
                    </div>
                    <div class="campo-formulario">
                        <input id="ninstrumentacion" name="instrumentacion" type="text" placeholder="Instrumentación">
                        <select id="nciudad" name="ciudad">
                            <option value="0">Ciudad o Municipio</option>
                        </select>
                    </div>
                    <div class="campo-formulario">
                        <input id="nejemplares" name="ejemplares" type="text" placeholder="Número de ejemplares">
                        <select id="nubifisica" name="ubifisica">
                            <option value="0">Selecciona Ubicacion Fisica</option>
                            <option value="homero">Homero</option>
                            <option value="campos">Campos</option>
                            <option value="archivo">Archivo</option>
                        </select>
                    </div>
                    <div class="campo-formulario">
                        <select id="ntipdocum" name="tipdocum">
                            <option value="0">Tipo de Documento</option>
                            <option value="testimonio">Testimonio</option>
                            <option value="copia certificada">Copia Certificada</option>
                            <option value="copia simple">Copia Simple</option>
                        </select>
                        <input id="ncodinter" name="codinter" type="text" placeholder="Codigo Interno" disabled>
                    </div>
                    <div class="campo-formulario">
                        <textarea id="comenta" name="ncomenta" rows="3" placeholder=" Comentario"></textarea>
                        <input id="nrutadrive" name="rutadrive" placeholder="Ruta en Drive">
                    </div>
                    <div class="boton-contenedor-formulario">
                        <button type="button" id="btn-ncliente" class="boton-formulario" onclick="window.location.href='altaclientes.php'">Nuevo Cliente</button>
                        <button id="btn-registrar" class="boton-formulario">Registrar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>