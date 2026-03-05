<?php
include 'conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre  = mysqli_real_escape_with_str($conn, $_POST['nombre']);
    $email   = mysqli_real_escape_with_str($conn, $_POST['email']);
    $mensaje = mysqli_real_escape_with_str($conn, $_POST['mensaje']);

    $sql = "INSERT INTO contactos (nombre, email, mensaje) VALUES ('$nombre', '$email', '$mensaje')";

    if (mysqli_query($conn, $sql)) {
        echo json_encode(['status' => 'success', 'message' => '¡Datos guardados!']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Error al guardar']);
    }
}

function mysqli_real_escape_with_str($conn, $str) {
    return mysqli_real_escape_string($conn, htmlspecialchars($str));
}
?>
