<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Taller Virtual de Motos</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <header>
    <nav>
        <ul>
            <li><a href="index.php">Inicio</a></li>
            <li><a href="registro.php">Registro</a></li>
            <li><a href="login.php">Login</a></li>
            <?php if (isset($_SESSION['usuario_id'])): ?>
                <li><a href="dashboard.php">Dashboard</a></li>
            <?php endif; ?>
        </ul>
    </nav>
</header>

