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
        // Página de bienvenida para usuarios no registrados con banner
        echo "
        <section class='banner'>
            <div class='overlay'>
                <div class='content'>
                    <h1>Bienvenido al Taller Virtual de Motos</h1>
                    <p>Gestiona tus mantenimientos, tus motos y tus registros fácilmente.</p>
                    <a href='views/registro.php' class='btn-registro'>Registrarse</a>
                </div>
            </div>
        </section>";
    }
    ?>
</main>

<?php include 'includes/footer.php'; ?>

</body>
</html>

