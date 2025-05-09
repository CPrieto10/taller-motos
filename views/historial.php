<?php
session_start();

// Redirigir si no ha iniciado sesión
if (!isset($_SESSION['usuario_id'])) {
    header("Location: ../login.php");
    exit();
}

include '../includes/header.php';
include '../includes/db.php';

// Obtener el historial de mantenimientos del usuario
$stmt = $conn->prepare("SELECT m.marca, m.modelo, mt.descripcion, mt.fecha FROM mantenimientos mt
                        JOIN motos m ON mt.moto_id = m.id
                        WHERE mt.usuario_id = ? ORDER BY mt.fecha DESC");
$stmt->bind_param("i", $_SESSION['usuario_id']);
$stmt->execute();
$result = $stmt->get_result();
?>

<main class="container">
    <h2>Historial de Mantenimientos</h2>

    <table>
        <thead>
            <tr>
                <th>Moto</th>
                <th>Descripción</th>
                <th>Fecha</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>{$row['marca']} - {$row['modelo']}</td>
                            <td>{$row['descripcion']}</td>
                            <td>{$row['fecha']}</td>
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='3'>No tienes mantenimientos registrados.</td></tr>";
            }
            ?>
        </tbody>
    </table>
</main>

<?php include '../includes/footer.php'; ?>
