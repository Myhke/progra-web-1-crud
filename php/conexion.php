<?php
// Parámetros de conexión a la base de datos
$servidor = "161.132.68.64";
$usuario = "carlosdaniel";
$password = "carlos60005";
$basedatos = "noticias_tacna";

// Crear conexión
$conexion = new mysqli($servidor, $usuario, $password, $basedatos);

// Verificar conexión
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Establecer charset
$conexion->set_charset("utf8");
?>