<?php
// Conexión a la base de datos
$conn = mysqli_connect("localhost", "root", "", "acme");

if (!$conn) {
    die("Error al conectar: " . mysqli_connect_error());
}

mysqli_set_charset($conn, "utf8");
?>
