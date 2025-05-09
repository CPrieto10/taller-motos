<?php
session_start();
include 'includes/db.php';
include 'includes/header.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);
    $contrasena = $_POST['contrasena'];

    // Buscar al usuario por email
// Buscar al usuario por email
$stmt = $conn->prepare("SELECT id, nombre, contrasena, rol FROM usuarios WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$resultado = $stmt->get_result();

if ($resultado->num_rows === 1) {
    $usuario = $resultado->fetch_assoc();

    // Verificar la contraseña
    if (password_verify($contrasena, $usuario['contrasena'])) {
        // Contraseña correcta -> iniciar sesión
        $_SESSION['usuario_id'] = $usuario['id'];
        $_SESSION['usuario_nombre'] = $usuario['nombre'];
        $_SESSION['usuario_rol'] = $usuario['rol'];

        header("Location: views/dashboard.php");
        exit();
    } else {
        echo "<p style='color:red;'>Contraseña incorrecta.</p>";
    }
} else {
    echo "<p style='color:red;'>Usuario no encontrado.</p>";
}

    $stmt->close();
    $conn->close();
}
?>

<h2>Iniciar Sesión</h2>
<form action="login.php" method="POST">
    <label for="email">Correo electrónico:</label><br>
    <input type="email" id="email" name="email" required><br><br>

    <label for="contrasena">Contraseña:</label><br>
    <input type="password" id="contrasena" name="contrasena" required><br><br>

    <button type="submit">Entrar</button>
</form>

<p>¿No tienes cuenta? <a href="registro.php">Regístrate aquí</a></p>

<?php include 'includes/footer.php'; ?>
