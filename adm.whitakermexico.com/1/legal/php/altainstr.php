<?php
require_once("dbconnect1.php");

// Variables de formulario
$cliente = $_POST['cliente'];
$escritura = $_POST['escritura'];
$instrumentacion = $_POST['instrumentacion'];
$tipodocum = $_POST['tipdocum'];
$notaria = $_POST['notaria'];
$ciudad = $_POST['ciudad'];
$ubicacion = $_POST['ubifisica'];
$rutadigital = $POST['rutadrive'];
$comentarios = $POST['ncomenta'];
$cdinter = $POST['codinter'];
$espacio = " ";

// Consulta para insertar
$query = "INSERT INTO tb_intrumentos 
(ID, c_cliente, c_nescritura, c_instrumento, c_tipodoc, c_notaria, c_ciudad, c_ubicacion, c_ruta, c_comentarios, c_cdinterno) 
VALUES 
('$espacio', '$cliente', '$escritura', '$instrumentacion', '$tipodocum', '$notaria', '$ciudad', '$ubicacion', '$rutadigital', '$comentarios', '$cdinter')";

// Consulta para verificar
$query2 = "SELECT c_cliente FROM tb_instrumentos WHERE c_rfc='$rfc'";
$resultado = mysqli_query($conn, $query2);
$num_rows = mysqli_num_rows($resultado);

if ($num_rows === 0) {
    $nuevo_registro = mysqli_query($conn, $query);
    if ($nuevo_registro) {
        echo "<script>
            alert('Registro exitoso.');
            window.location.href = '../altainstrumentos.php';
        </script>";
    } else {
        echo "<script>
            alert('Error al registrar el cliente. Por favor, inténtalo de nuevo.');
            window.location.href = '../altainstrumentos.php';
        </script>";
    }
} else {
    echo "<script>
        alert('El cliente ya está registrado.');
        window.location.href = '../altainstrumentos.php';
    </script>";
}

// Cierra la conexión
mysqli_close($conn);
?>
