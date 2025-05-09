<?php
session_start();
include '../includes/db.php';
include '../includes/header.php';

// Verificamos si el usuario está logueado
if (!isset($_SESSION['usuario_id'])) {
    header("Location: ../login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario_id = $_SESSION['usuario_id'];
    $marca = $_POST['marca'];
    $modelo = $_POST['modelo'];
    $anio = $_POST['anio'];  // Cambiado a 'anio' en lugar de 'año'
    $color = $_POST['color'];
    $matricula = $_POST['matricula'];
    $fecha_registro = date('Y-m-d H:i:s');  // Fecha actual

    // Consulta para insertar los datos en la tabla de motos
    $stmt = $conn->prepare("INSERT INTO motos (usuario_id, marca, modelo, anio, color, matricula, fecha_registro) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("issssss", $usuario_id, $marca, $modelo, $anio, $color, $matricula, $fecha_registro);
    
    if ($stmt->execute()) {
        echo "Moto registrada correctamente.";
    } else {
        echo "Error al registrar la moto: " . $stmt->error;
    }

    $stmt->close();

    }


$conn->close();
?>

<h2>Añadir Moto</h2>
<form action="add_moto.php" method="post">
    <label for="marca">Marca:</label><br>
    <input type="text" id="marca" name="marca" required><br><br>

    <label for="modelo">Modelo:</label><br>
    <input type="text" id="modelo" name="modelo" required><br><br>

    <label for="anio">Año:</label><br>
    <input type="number" id="anio" name="anio" required><br><br>

    <label for="color">Color:</label><br>
    <input type="text" id="color" name="color" required><br><br>

    <label for="matricula">Matrícula:</label><br>
    <input type="text" id="matricula" name="matricula" required><br><br>

    <button type="submit">Añadir Moto</button>
</form>

<?php include '../includes/footer.php'; ?>
