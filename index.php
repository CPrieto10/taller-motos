<?php
session_start();
include 'includes/header.php';

// Si el usuario está logueado, redirigir al dashboard
if (isset($_SESSION['usuario_id'])) {
    header("Location: views/dashboard.php");
    exit();
}
?>

<h1>Bienvenido al Taller Virtual de Motos</h1>
<p>Gestiona tus motos, mantenimientos e historial fácilmente.</p>

<div class="inicio-links">
    <a href="login.php" class="btn">Iniciar sesión</a>
    <a href="registro.php" class="btn">Registrarse</a>
</div>

<?php include 'includes/footer.php'; ?>
