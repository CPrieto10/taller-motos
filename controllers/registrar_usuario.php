<?php
session_start();
require_once '../includes/db.php';

// Validar que se haya enviado el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = trim($_POST['nombre']);
    $email = trim($_POST['email']);
    $contrasena = $_POST['contrasena'];

    // Validaciones básicas
    if (empty($nombre) || empty($email) || empty($contrasena)) {
        $_SESSION['registro_error'] = "Todos los campos son obligatorios.";
        header("Location: ../views/registro.php");
        exit();
    }

    // Encriptar contraseña
    $hash = password_hash($contrasena, PASSWORD_DEFAULT);

    // Insertar en la base de datos con rol "user"
    $stmt = $conn->prepare("INSERT INTO usuarios (nombre, email, contrasena, usuario_rol) VALUES (?, ?, ?, 'user')");
    $stmt->bind_param("sss", $nombre, $email, $hash);

    if ($stmt->execute()) {
        $_SESSION['registro_exito'] = "Usuario registrado correctamente. Ahora puedes iniciar sesión.";
        header("Location: ../views/login.php");
    } else {
        $_SESSION['registro_error'] = "Error al registrar el usuario: " . $conn->error;
        header("Location: ../views/registro.php");
    }

    $stmt->close();
    $conn->close();
} else {
    header("Location: ../views/registro.php");
    exit();
}
