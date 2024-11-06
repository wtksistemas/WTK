<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel Principal</title>
    <link rel="stylesheet" href="css/style.css">
	<script src="../../clases_prueba.js"></script>
</head>
<body>
    <?php
        session_start();
        include "../php/control.php";
        if ($_SESSION['id'] != '888') {
            header("Location: ../index.html");
        }
    ?>

    <div class="contenedor-principal">
        <div class="menu-superior">
            <div class="opciones">
                <a href="nomina.php">Nómina</a>
                <a href="legal.php">Legal</a>
            </div>
            <div class="perfil">
                <a href="menu.php">
                    <img src="img/home.png" class="img-perfil">
                </a>
                <?php
                    echo "<span style='color: white;'>".$_SESSION['username']."</span>";
                ?>
                <a href="../php/logout.php"><button type="button" class="btn">Cerrar sesión</button></a>
            </div>
        </div>

        <div class="contenido formulario-contenido">
            <div class="formulario-nuevo-instrumento">
                <form>
				<h1 class="titulo-formulario">Nuevo Instrumento Notarial</h1>

                    <div class="campo-formulario">
                        <input id="ncliente" name="cliente" type="text" placeholder="Nombre de Cliente">
						<input id="nnotaria" name="notaria" type="number" placeholder="Notaria">
					</div>

                    <div class="campo-formulario">
                        <input id="nuescritura" name="escritura" type="number" placeholder="N° de Escritura">
						<input id="nciudad" name="ciudad" type="text" placeholder="Ciudad">
                    </div>

                    <div class="campo-formulario">
                        <input id="ninstrumentacion" name="instrumentacion" type="text" placeholder="Instrumentación">
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
						<!--<input id="numcertificado" name="ncertificado" placeholder="N° Certificado">-->
						<input id="nrutadrive" name="rutadrive" placeholder="Ruta en Drive">
                    </div>

					<div class="campo-formulario">
                        <input id="nejemplares" name="ejemplares" type="text" placeholder="Número de ejemplares">
						<input id="ncodinter" name="codinter" type="text" placeholder="Codigo Interno" disabled>
					
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
