<?php session_start(); ?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Acceso al Sistema</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
    body {
        background: #e9ecef;
        height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .login-card {
        width: 400px;
        border-radius: 10px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }
    </style>
</head>

<body>

    <div class="card login-card p-4">
        <div class="text-center mb-4">
            <h3><b>Admin</b>LTE Lite</h3>
            <p class="text-muted">Inicia sesión para continuar</p>
        </div>

        <?php if(isset($_GET['error'])): ?>
        <div class="alert alert-danger p-2 text-center">Credenciales incorrectas</div>
        <?php endif; ?>

        <form action="auth.php" method="POST">
            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control" placeholder="admin@correo.com" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Contraseña</label>
                <input type="password" name="password" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Entrar</button>
        </form>
    </div>

</body>

</html>
