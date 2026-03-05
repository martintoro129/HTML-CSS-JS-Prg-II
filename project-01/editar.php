<?php
include 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id_editar'];
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $rol = $_POST['rol'];

    $sql = "UPDATE usuarios SET nombre = ?, email = ?, rol = ? WHERE id = ?";
    $stmt = $pdo->prepare($sql);

    if (isset($_FILES['foto']) && $_FILES['foto']['error'] == 0) {
    $ruta = "uploads/" . time() . "_" . $_FILES['foto']['name'];
    move_uploaded_file($_FILES['foto']['tmp_name'], $ruta);
} else {
    $ruta = "uploads/default.png"; // Imagen por defecto
}
// Luego incluyes $ruta en tu INSERT o UPDATE de SQL

    if ($stmt->execute([$nombre, $email, $rol, $id])) {
        header("Location: modulo_usuarios.php?status=updated");
    } else {
        echo "Error al actualizar";
    }
}
?>
