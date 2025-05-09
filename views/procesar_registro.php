<?php
require_once __DIR__ . '/../includes/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST["nombre"] ?? '';
    $email = $_POST["email"] ?? '';
    $contrasena = $_POST["contrasena"] ?? '';

    if (!empty($nombre) && !empty($email) && !empty($contrasena)) {
        // Encriptar contraseña
        $contrasena_hash = password_hash($contrasena, PASSWORD_DEFAULT);

        $sql = "INSERT INTO usuarios (nombre, email, contrasena) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $nombre, $email, $contrasena_hash);

        if ($stmt->execute()) {
            // Redirige al login (ajustado correctamente)
            header("Location: login.php?registro=ok");
            exit();
        } else {
            header("Location: registro.php?mensaje=error");
            exit();
        }
    } else {
        header("Location: registro.php?mensaje=vacio");
        exit();
    }
}

$conn->close();

