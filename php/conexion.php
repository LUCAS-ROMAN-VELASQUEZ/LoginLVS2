
<?php
$host = "localhost";             // Servidor de base de datos
$usuario = "root";              // Usuario de MySQL (por defecto en WAMP)
$contrasena = "";               // Contraseña (vacía por defecto)
$basedatos = "FirmaCorporativa"; // Nombre de tu base de datos

$conexion = new mysqli($host, $usuario, $contrasena, $basedatos);

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

echo "Conexión exitosa"; // <-- esto muestra si todo va bien
?>

