<?php
session_start();
include '../includes/db.php';
include '../includes/header.php';

// Verifica si el usuario ha iniciado sesión y es administrador
if (!isset($_SESSION['usuario_id']) || $_SESSION['usuario_rol'] !== 'admin') {
    echo "<p style='color:red;'>Acceso denegado. Esta sección es solo para administradores.</p>";
    include '../includes/footer.php';
    exit();
}


// Eliminar usuario si se envía una petición con ID
if (isset($_GET['delete_id'])) {
    $id = intval($_GET['delete_id']);
    $stmt = $conn->prepare("DELETE FROM usuarios WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();

    echo "<p style='color: green;'>Usuario eliminado correctamente.</p>";
}

// Mostrar lista de usuarios
$resultado = $conn->query("SELECT id, nombre, email FROM usuarios");

echo "<h2>Lista de usuarios registrados</h2>";
echo "<table border='1' cellpadding='10'>";
echo "<tr><th>ID</th><th>Nombre</th><th>Email</th><th>Acciones</th></tr>";

while ($fila = $resultado->fetch_assoc()) {
    echo "<tr>";
    echo "<td>" . $fila['id'] . "</td>";
    echo "<td>" . htmlspecialchars($fila['nombre']) . "</td>";
    echo "<td>" . htmlspecialchars($fila['email']) . "</td>";
    echo "<td><a href='admin_usuarios.php?delete_id=" . $fila['id'] . "' onclick=\"return confirm('¿Estás seguro de que quieres eliminar este usuario?');\">Eliminar</a></td>";
    echo "</tr>";
}

echo "</table>";

include '../includes/footer.php';
$conn->close();
?>
