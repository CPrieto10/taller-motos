<?php
include 'includes/db.php';
include 'includes/header.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = trim($_POST['nombre']);
    $email = trim($_POST['email']);
    $contrasena = $_POST['contrasena'];

    // Validación básica
    if (empty($nombre) || empty($email) || empty($contrasena)) {
        echo "<p style='color: red;'>Todos los campos son obligatorios.</p>";
    } else {
        // Encriptar la contraseña
        $contrasena_segura = password_hash($contrasena, PASSWORD_DEFAULT);

        // Insertar usuario en la base de datos
        $stmt = $conn->prepare("INSERT INTO usuarios (nombre, email, contrasena) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $nombre, $email, $contrasena_segura);

        if ($stmt->execute()) {
            echo "<p style='color: green;'>Usuario registrado con éxito. <a href='login.php'>Iniciar sesión</a></p>";
        } else {
            echo "<p style='color: red;'>Error al registrar: " . $stmt->error . "</p>";
        }

        $stmt->close();
    }

    $conn->close();
}
?>

<h2>Registro de Usuario</h2>
<form action="registro.php" method="POST">
    <label for="nombre">Nombre:</label><br>
    <input type="text" id="nombre" name="nombre" required><br><br>

    <label for="email">Correo electrónico:</label><br>
    <input type="email" id="email" name="email" required><br><br>

    <label for="contrasena">Contraseña:</label><br>
    <input type="password" id="contrasena" name="contrasena" required><br><br>

    <label for="contrasena_confirmar">Confirmar Contraseña:</label><br>
    <input type="password" id="contrasena_confirmar" name="contrasena_confirmar" required><br><br>

    <button type="submit">Registrar</button>
</form>

<p>¿Ya tienes cuenta? <a href="login.php">Inicia sesión aquí</a></p>

<?php include 'includes/footer.php'; ?>
