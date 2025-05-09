<?php
require_once __DIR__ . '/../includes/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST["nombre"] ?? '';
    $email = $_POST["email"] ?? '';
    $contrasena = $_POST["contrasena"] ?? '';

    if (!empty($nombre) && !empty($email) && !empty($contrasena)) {
        $sql = "INSERT INTO usuarios (nombre, email, contrasena) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $nombre, $email, $contrasena);

        if ($stmt->execute()) {
            header("Location: ../registro.php?mensaje=ok");
            exit();
        } else {
            header("Location: ../registro.php?mensaje=error");
            exit();
        }
    } else {
        header("Location: ../registro.php?mensaje=vacio");
        exit();
    }
}

$conn->close();
