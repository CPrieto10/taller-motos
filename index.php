<?php
session_start();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Taller de Motos</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

<?php include 'includes/header.php'; ?>

<main>
    <?php
    // Si el usuario está logueado, mostrar el dashboard
    if (isset($_SESSION['usuario_id'])) {
        include 'views/dashboard.php';
    } else {
        // Página de bienvenida para usuarios no registrados
        echo "<section class='bienvenida'>";
        echo "<h2>Bienvenido al Taller Virtual de Mantenimiento de Motos</h2>";
        echo "<p>Gestiona tus mantenimientos, tus motos y tus registros fácilmente.</p>";
        echo "<a href='login.php' class='btn'>Iniciar sesión</a> ";
        echo "<a href='views/registro.php' class='btn'>Registrarse</a>";
        echo "</section>";
    }
    ?>
</main>

<?php include 'includes/footer.php'; ?>

</body>
</html>

