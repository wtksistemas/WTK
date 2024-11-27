<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel Principal</title>
    <link rel="stylesheet" href="css/style.css">
	<script src="../../clases_prueba.js"></script>
    <!-- Include pdf.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.11.338/pdf.min.js"></script>
</head>
<body>
    <?php
        session_start();
        include "../php/control.php";
        error_reporting(0);
        if ($_SESSION['id'] != '888')
        {
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
            <script src="js/legal.js"></script>
            <div class="formulario-nuevo-instrumento">
                <form action="php/registro_cliente.php" method="post" enctype="multipart/form-data">
				<h1 class="titulo-formulario">Nuevo Cliente</h1>
                    <div class="campo-formulario">
                        <label>Carga la constancia Fiscal <br>(2 hojas minimo)</label>
                        <input id="pdf" name="constancia" type="file" size="250" maxlength="250" accept=".pdf">
					</div>
					<div class="campo-formulario">
						<input id="nncliente" name="ncliente" type="text" placeholder="Nombre de Cliente" disabled value="">
                        <input id="nrfc" name="rfc" type="text" placeholder="RFC" disabled value="">
					</div>
                    <div class="campo-formulario">
						<input id="nrf" name="rf" type="text" placeholder="Régimen Fiscal" disabled value="">
                        <input id="ncalle" name="calle" type="text" placeholder="Calle" disabled value="">
					</div>
                    <div class="campo-formulario">
						<input id="nexterior" name="exterior" type="text" placeholder="N° Exterior" disabled value="">
                        <input id="ninterior" name="interior" type="text" placeholder="N° Interior" disabled value="">
					</div>
                    <div class="campo-formulario">
						<input id="ncp" name="cp" type="text" placeholder="C.P" disabled value="">
                       <div class="check">
                            <label>¿Deseas modificar?</label>
                            <input id="che" name="check" type="checkbox" onclick="modificar_cn()">
                       </div>
					</div>
                    <div class="boton-contenedor-formulario" id="btn_pdf">
                        <button type="button" id="btn-regre" class="boton-formulario" onclick="window.location.href='altainstrumentos.php'">Regresar</button>
                        <button id="btn-registrarcli" class="boton-formulario" type="button" onclick="limpia_form()">limpiar formulario</button>
                       <button type="button" id="btn-alta" class="boton-formulario">Registrar cliente</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
<script src="../1/js/lector_pdf.js"> </script>
</html>

