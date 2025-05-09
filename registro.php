<?php include 'includes/header.php'; ?>

<h2>Registro de Usuario</h2>

<?php
if (isset($_GET["mensaje"])) {
    if ($_GET["mensaje"] == "ok") {
        echo "<p style='color:green;'>Usuario registrado con éxito.</p>";
    } elseif ($_GET["mensaje"] == "error") {
        echo "<p style='color:red;'>Error al registrar el usuario.</p>";
    } elseif ($_GET["mensaje"] == "vacio") {
        echo "<p style='color:red;'>Todos los campos son obligatorios.</p>";
    }
}
?>

<form action="views/procesar_registro.php" method="post">
    <label for="nombre">Nombre:</label>
    <input type="text" name="nombre" required><br><br>

    <label for="email">Email:</label>
    <input type="email" name="email" required><br><br>

    <label for="contrasena">Contraseña:</label>
    <input type="password" name="contrasena" required><br><br>

    <input type="submit" value="Registrarse">
</form>

<?php include 'includes/footer.php'; ?>
