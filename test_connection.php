<?php
// Verifica si se incluye correctamente
if (!file_exists('includes/db.php')) {
    die('No se encontró el archivo db.php');
}

require_once __DIR__ . '/includes/db.php';

// Verifica si $conn está definido
if (!isset($conn)) {
    die('Error: la conexión \$conn no está disponible.');
}

$sql = "SELECT * FROM usuarios";
$resultado = $conn->query($sql);

if ($resultado) {
    echo "Conexión exitosa a la base de datos. Aquí está el contenido de la tabla 'usuarios':<br>";
    while ($fila = $resultado->fetch_assoc()) {
        echo "ID: " . $fila['id'] . " - Nombre: " . $fila['nombre'] . "<br>";
    }
} else {
    echo "Error en la consulta: " . $conn->error;
}

$conn->close();
?>
