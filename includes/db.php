<?php
$host = "localhost";
$usuario = "root";
$contrasena = "";
$base_datos = "taller_motos";

$conn = new mysqli($host, $usuario, $contrasena, $base_datos);

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}
?>