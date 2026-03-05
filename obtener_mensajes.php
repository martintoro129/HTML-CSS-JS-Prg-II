<?php
include 'conexion.php';

// Consultamos los últimos 10 mensajes
$sql = "SELECT id, nombre, email, mensaje, fecha FROM contactos ORDER BY fecha DESC LIMIT 10";
$result = mysqli_query($conn, $sql);

$mensajes = [];
while($row = mysqli_fetch_assoc($result)) {
    $mensajes[] = $row;
}

echo json_encode($mensajes);
?>
