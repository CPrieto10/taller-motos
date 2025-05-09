<?php
session_start();

// Redirigir si no ha iniciado sesión
if (!isset($_SESSION['usuario_id'])) {
    header("Location: ../login.php");
    exit();
}

include '../includes/db.php';

// Verificar si se pasó un ID de moto en la URL
if (isset($_GET['id'])) {
    $moto_id = $_GET['id'];

    // Verificar que la moto pertenece al usuario
    $usuario_id = $_SESSION['usuario_id'];
    $stmt = $conn->prepare("SELECT * FROM motos WHERE id = ? AND usuario_id = ?");
    $stmt->bind_param("ii", $moto_id, $usuario_id);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows === 1) {
        // Si la moto existe y pertenece al usuario, eliminarla
        $stmt_delete = $conn->prepare("DELETE FROM motos WHERE id = ?");
        $stmt_delete->bind_param("i", $moto_id);
        $stmt_delete->execute();

        // Redirigir al dashboard después de eliminar
        header("Location: dashboard.php");
        exit();
    } else {
        echo "<p style='color:red;'>No tienes permiso para eliminar esta moto.</p>";
    }

    $stmt->close();
    $stmt_delete->close();
} else {
    echo "<p style='color:red;'>ID de moto no proporcionado.</p>";
}

$conn->close();
?>
