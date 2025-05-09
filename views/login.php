<?php
session_start();
include '../includes/header.php';
?>

<h2>Iniciar Sesión</h2>

<?php if (isset($_SESSION['login_error'])): ?>
    <p style="color: red;"><?= $_SESSION['login_error'] ?></p>
    <?php unset($_SESSION['login_error']); ?>
<?php endif; ?>

<form action="../controllers/login_usuario.php" method="post">
    <label for="email">Correo electrónico:</label><br>
    <input type="email" id="email" name="email" required><br><br>

    <label for="contrasena">Contraseña:</label><br>
    <input type="password" id="contrasena" name="contrasena" required><br><br>

    <button type="submit">Entrar</button>
</form>

<p>¿No tienes cuenta? <a href="registro.php">Regístrate aquí</a></p>

<?php include '../includes/footer.php'; ?>

