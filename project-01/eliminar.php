<?php
session_start();
include 'conexion.php';

// Verificamos si está logueado Y si es Admin
if (!isset($_SESSION['user_id']) || $_SESSION['rol'] !== 'Admin') {
    header("Location: index.php?error=sin_permiso");
    exit();
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $pdo->prepare("DELETE FROM usuarios WHERE id = ?");
    $stmt->execute([$id]);
    header("Location: modulo_usuarios.php?status=deleted");
}
?>
