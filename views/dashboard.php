<?php
session_start();

// Redirigir si no ha iniciado sesión
if (!isset($_SESSION['usuario_id'])) {
    header("Location: ../login.php");
    exit();
}

include '../includes/db.php';
include '../includes/header.php';

// Obtener las motos del usuario desde la base de datos
$usuario_id = $_SESSION['usuario_id'];
$stmt = $conn->prepare("SELECT * FROM motos WHERE usuario_id = ?");
$stmt->bind_param("i", $usuario_id);
$stmt->execute();
$resultado = $stmt->get_result();
?>

<main class="container">
    <h2>Bienvenido, <?= htmlspecialchars($_SESSION['usuario_nombre']) ?>!</h2>
    <p>Desde este panel puedes gestionar tu moto, registrar mantenimientos y consultar el historial.</p>

    <div class="card-container">
        <div class="card">
            <h3><a href="add_moto.php">Añadir Moto</a></h3>
            <p>Registra tu moto para llevar un seguimiento personalizado.</p>
        </div>
        <div class="card">
            <h3><a href="mantenimiento.php">Registrar Mantenimiento</a></h3>
            <p>Lleva el control de mantenimientos y revisiones.</p>
        </div>
        <div class="card">
            <h3><a href="historial.php">Ver Historial</a></h3>
            <p>Consulta todos los registros anteriores.</p>
        </div>
    </div>

    <div class="motos-registradas">
        <h3>Motos Registradas</h3>

        <?php if ($resultado->num_rows > 0): ?>
            <table>
                <thead>
                    <tr>
                        <th>Marca</th>
                        <th>Modelo</th>
                        <th>Año</th>
                        <th>Color</th>
                        <th>Matricula</th>
                        <th>Fecha de Registro</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($moto = $resultado->fetch_assoc()): ?>
                        <tr>
                            <td><?= htmlspecialchars($moto['marca']) ?></td>
                            <td><?= htmlspecialchars($moto['modelo']) ?></td>
                            <td><?= htmlspecialchars($moto['anio']) ?></td>
                            <td><?= htmlspecialchars($moto['color']) ?></td>
                            <td><?= htmlspecialchars($moto['matricula']) ?></td>
                            <td><?= htmlspecialchars($moto['fecha_registro']) ?></td>
                            <td>
                                <a href="edit_moto.php?id=<?= $moto['id'] ?>">Editar</a> | 
                                <a href="eliminar_moto.php?id=<?= $moto['id'] ?>">Eliminar</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>No tienes motos registradas.</p>
        <?php endif; ?>
    </div>
</main>

<?php
$stmt->close();
$conn->close();
include '../includes/footer.php';
?>
