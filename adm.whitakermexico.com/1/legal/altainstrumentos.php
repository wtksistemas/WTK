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
        include_once("../legal/php/dbconnect.php");
        $sql = "select ID,c_razonsocial from tb_clientes;";
        $result = mysqli_query($conn,$sql);
        $num_rows = mysqli_num_rows($result);
        $id= array();
        $cliente= array();

        while($row= mysqli_fetch_array($result))
        {
        $id[]=$row["ID"];
        $cliente[]=$row["c_razonsocial"];
        }
        $json_id= json_encode($id);
        $json_cliente=json_encode($cliente);
    }
?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel Principal</title>
    <link rel="stylesheet" href="../css/style.css">
    <script src="js/legal.js"></script>
</head>
<body onload='leer_clientes(<?php echo $json_id; ?>,<?php echo $json_cliente; ?>)'>
    <div class="contenedor-principal">
        <div class="menu-superior">
            <div class="opciones">
                <a href="../nominas/nomina.php">Nómina</a>
                <a href="legal.php">Legal</a>
            </div>
            <div class="perfil">
                <a href="../menu.php">
                    <img src="../img/home.png" class="img-perfil">
                </a>
                <?php
                    echo "<span style='color: white;'>".$_SESSION['username']."</span>";
                ?>
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

                        <select id="estado" name="nestado">
                            <option value="0">Estado</option>
                        </select>

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
                        <select id="ntipdocum" name="tipdocum" onchange="mostrarCampoTestimonio()">
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

