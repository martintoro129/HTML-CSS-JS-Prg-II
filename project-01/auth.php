<?php
session_start();
include 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $pass  = $_POST['password'];

    $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();
    //$user && (password_verify($pass, $user['password']))
    $pwd=password_hash($pass, PASSWORD_BCRYPT); // Encriptación
    if (password_verify($pass, $user['password'])) {
        // Guardamos datos importantes en la sesión
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['nombre']  = $user['nombre'];
        $_SESSION['rol']     = $user['rol'];

        header("Location: index.php");
    } else {
        header("Location: login.php?error=1"." LOGICAL ".$pwd." db ".$user['password']);
    }
}
?>
