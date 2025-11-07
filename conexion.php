<?php
$host = "localhost";
$db = "asistencia_salas";
$user = "root";
$pass = ""; // Cambia si tu XAMPP tiene contraseña

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
?>
