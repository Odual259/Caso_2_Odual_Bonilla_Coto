<?php
$servername = "localhost";
$username = "root";
$password = "root12345";
$database = "Caso_2_Odual_Bonilla_Coto";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}
?>