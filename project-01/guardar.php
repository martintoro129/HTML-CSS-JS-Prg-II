<?php
include 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $pass = password_hash($_POST['password'], PASSWORD_BCRYPT); // Encriptación
    $rol = $_POST['rol'];

    if (isset($_FILES['foto']) && $_FILES['foto']['error'] == 0) {
    $ruta = "uploads/" . time() . "_" . $_FILES['foto']['name'];
    move_uploaded_file($_FILES['foto']['tmp_name'], $ruta);
} else {
    $ruta = "uploads/default.png"; // Imagen por defecto
}
// Luego incluyes $ruta en tu INSERT o UPDATE de SQL

    $sql = "INSERT INTO usuarios (nombre, email, password, rol) VALUES (?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);

    if ($stmt->execute([$nombre, $email, $pass, $rol])) {
        header("Location: modulo_usuarios.php?status=success");
    }
}
?>
