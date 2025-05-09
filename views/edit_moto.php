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

    // Obtener la moto de la base de datos
    $usuario_id = $_SESSION['usuario_id'];
    $stmt = $conn->prepare("SELECT * FROM motos WHERE id = ? AND usuario_id = ?");
    $stmt->bind_param("ii", $moto_id, $usuario_id);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows === 1) {
        // Si la moto existe y pertenece al usuario, mostrar el formulario de edición
        $moto = $resultado->fetch_assoc();
    } else {
        echo "<p style='color:red;'>No tienes permiso para editar esta moto.</p>";
        exit();
    }

    $stmt->close();
} else {
    echo "<p style='color:red;'>ID de moto no proporcionado.</p>";
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener los datos del formulario
    $marca = $_POST['marca'];
    $modelo = $_POST['modelo'];
    $anio = $_POST['anio'];
    $color = $_POST['color'];
    $matricula = $_POST['matricula'];

    // Actualizar la moto en la base de datos
    $stmt_update = $conn->prepare("UPDATE motos SET marca = ?, modelo = ?, anio = ?, color = ?, matricula = ? WHERE id = ?");
    $stmt_update->bind_param("sssssi", $marca, $modelo, $anio, $color, $matricula, $moto_id);
    $stmt_update->execute();

    // Redirigir al dashboard después de actualizar
    header("Location: dashboard.php");
    exit();
}
?>

<form action="edit_moto.php?id=<?= $moto['id'] ?>" method="post">
    <h2>Editar Moto</h2>
    <label for="marca">Marca:</label>
    <input type="text" id="marca" name="marca" value="<?= htmlspecialchars($moto['marca']) ?>" required><br>

    <label for="modelo">Modelo:</label>
    <input type="text" id="modelo" name="modelo" value="<?= htmlspecialchars($moto['modelo']) ?>" required><br>

    <label for="anio">Año:</label>
    <input type="number" id="anio" name="anio" value="<?= htmlspecialchars($moto['anio']) ?>" required><br>

    <label for="color">Color:</label>
    <input type="text" id="color" name="color" value="<?= htmlspecialchars($moto['color']) ?>" required><br>

    <label for="matricula">Matrícula:</label>
    <input type="text" id="matricula" name="matricula" value="<?= htmlspecialchars($moto['matricula']) ?>" required><br>

    <button type="submit">Guardar Cambios</button>
</form>
