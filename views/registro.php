<?php
session_start();
include '../includes/header.php';
?>

<h2>Registro de Usuario</h2>

<?php if (isset($_SESSION['registro_error'])): ?>
    <p style="color: red;"><?= $_SESSION['registro_error'] ?></p>
    <?php unset($_SESSION['registro_error']); ?>
<?php endif; ?>

<?php if (isset($_SESSION['registro_exito'])): ?>
    <p style="color: green;"><?= $_SESSION['registro_exito'] ?></p>
    <?php unset($_SESSION['registro_exito']); ?>
<?php endif; ?>

<form action="../controllers/registrar_usuario.php" method="post">
    <label for="nombre">Nombre:</label><br>
    <input type="text" id="nombre" name="nombre" required><br><br>

    <label for="email">Correo electrónico:</label><br>
    <input type="email" id="email" name="email" required><br><br>

    <label for="contrasena">Contraseña:</label><br>
    <input type="password" id="contrasena" name="contrasena" required><br><br>

    <button type="submit">Registrarse</button>
</form>

<p>¿Ya tienes cuenta? <a href="../login.php">Inicia sesión aquí</a></p>

<?php include '../includes/footer.php'; ?>

