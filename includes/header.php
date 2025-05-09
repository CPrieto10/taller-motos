<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Taller Virtual de Motos</title>
    <link rel="stylesheet" href="/proyectomotos/assets/css/style.css">
</head>
<body>
<header>
    <h1>Taller Virtual de Motos</h1>
    <nav>
        <ul>
            <?php if (isset($_SESSION['usuario_id'])): ?>
                <li><a href="/proyectomotos/index.php">Inicio</a></li>
                <li><a href="/proyectomotos/views/dashboard.php">Panel</a></li>
                <li><a href="/proyectomotos/logout.php">Cerrar sesión (<?= htmlspecialchars($_SESSION['usuario_nombre']) ?>)</a></li>
                <?php if (isset($_SESSION['usuario_rol']) && $_SESSION['usuario_rol'] === 'admin'): ?>
                    <li><a href="/proyectomotos/admin_usuarios.php">Usuarios</a></li>
                <?php endif; ?>
            <?php else: ?>
                <li><a href="/proyectomotos/index.php">Inicio</a></li>
                <li><a href="/proyectomotos/login.php">Iniciar sesión</a></li>
                <li><a href="/proyectomotos/registro.php">Registrarse</a></li>
            <?php endif; ?>
        </ul>
    </nav>
</header>

