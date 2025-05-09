<?php
session_start();
require_once '../includes/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);
    $contrasena = $_POST['contrasena'];

    if (empty($email) || empty($contrasena)) {
        $_SESSION['login_error'] = "Debes completar todos los campos.";
        header("Location: ../views/login.php");
        exit();
    }

    // Buscar al usuario por email
    $stmt = $conn->prepare("SELECT id, nombre, contrasena, usuario_rol FROM usuarios WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows === 1) {
        $usuario = $resultado->fetch_assoc();

        // Verificar la contraseña
        if (password_verify($contrasena, $usuario['contrasena'])) {
            $_SESSION['usuario_id'] = $usuario['id'];
            $_SESSION['usuario_nombre'] = $usuario['nombre'];
            $_SESSION['usuario_rol'] = $usuario['usuario_rol'];

            header("Location: ../views/dashboard.php");
            exit();
        } else {
            $_SESSION['login_error'] = "Contraseña incorrecta.";
        }
    } else {
        $_SESSION['login_error'] = "Usuario no encontrado.";
    }

    $stmt->close();
    $conn->close();

    header("Location: ../views/login.php");
    exit();
} else {
    header("Location: ../views/login.php");
    exit();
}
