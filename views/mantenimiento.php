<?php
session_start();

// Redirigir si no ha iniciado sesión
if (!isset($_SESSION['usuario_id'])) {
    header("Location: ../login.php");
    exit();
}

include '../includes/header.php';
include '../includes/db.php';

// Manejo del formulario de mantenimiento
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $moto_id = $_POST['moto_id'];
    $descripcion = $_POST['descripcion'];
    $fecha = $_POST['fecha'];

    // Insertar mantenimiento
    $stmt = $conn->prepare("INSERT INTO mantenimientos (usuario_id, moto_id, descripcion, fecha) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("iiss", $_SESSION['usuario_id'], $moto_id, $descripcion, $fecha);
    $stmt->execute();


    echo "<p>Mantenimiento registrado con éxito.</p>";
    $stmt->close();
}

?>

<main class="container">
    <h2>Registrar Mantenimiento</h2>
    
    <form action="mantenimiento.php" method="post">
        <label for="moto_id">Seleccionar moto:</label>
        <select name="moto_id" id="moto_id" required>
            <?php
            // Obtener las motos del usuario
            $stmt = $conn->prepare("SELECT id, marca, modelo FROM motos WHERE usuario_id = ?");
            $stmt->bind_param("i", $_SESSION['usuario_id']);
            $stmt->execute();
            $result = $stmt->get_result();

            while ($row = $result->fetch_assoc()) {
                echo "<option value='{$row['id']}'>{$row['marca']} - {$row['modelo']}</option>";
            }
            $stmt->close();
            ?>
        </select>

        <label for="descripcion">Descripción del mantenimiento:</label>
        <input type="text" id="descripcion" name="descripcion" required>

        <label for="fecha">Fecha del mantenimiento:</label>
        <input type="date" id="fecha" name="fecha" required>

        <button type="submit">Registrar Mantenimiento</button>
    </form>
</main>

<?php include '../includes/footer.php'; ?>
