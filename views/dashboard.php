<?php
session_start();
include '../includes/db.php';
include '../includes/header.php';

// Verificar si el usuario está logueado
if (!isset($_SESSION['usuario_id'])) {
    header('Location: ../login.php');
    exit();
}

// Aquí podrías agregar las funcionalidades para mostrar las motos del usuario
?>

<h2>Bienvenido, <?php echo $_SESSION['usuario_nombre']; ?>!</h2>
<p>Esta es tu página principal. Desde aquí podrás gestionar tus motos.</p>

<!-- Opciones de gestión -->
<ul>
    <li><a href="add_moto.php">Registrar nueva moto</a></li>
    <li><a href="mantenimiento.php">Añadir mantenimiento a moto</a></li>
    <li><a href="historial.php">Ver historial de mantenimiento</a></li>
</ul>

<p><a href="../logout.php">Cerrar sesión</a></p>

<?php include '../includes/footer.php'; ?>


