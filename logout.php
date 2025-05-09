<?php
session_start();

// Destruir todas las variables de sesión
$_SESSION = [];
session_unset();
session_destroy();

// Redirigir al inicio
header("Location: index.php");
exit();
