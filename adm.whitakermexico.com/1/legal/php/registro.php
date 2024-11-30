<?php
require_once("dbconnect.php");

// Variables de formulario
$cliente = $_POST['ncliente'];
$rfc = $_POST['rfc'];
$regimen = $_POST['rf'];
$calle = $_POST['calle'];
$nexterior = $_POST['exterior'];
$ninterior = $_POST['interior'];
$cp = $_POST['cp'];
$estatus = '1'; // Define un valor por defecto
$espacio = " ";

// Consulta para insertar
$query = "INSERT INTO tb_clientes 
(ID, c_razonsocial, c_rfc, c_regimen, c_calle, c_nexterior, c_ninterior, c_cp, c_estatus) 
VALUES 
('$espacio', '$cliente', '$rfc', '$regimen', '$calle', '$nexterior', '$ninterior', '$cp', '$estatus')";

// Consulta para verificar
$query2 = "SELECT c_razonsocial FROM tb_clientes WHERE c_rfc='$rfc'";
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
