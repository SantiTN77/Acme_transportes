<?php
$conn = mysqli_connect("sql105.infinityfree.com", "if0_38661486", "JZPrq3gpUGLLnBf", "if0_38661486_acmetrans");

if (!$conn) {
    die("Error al conectar: " . mysqli_connect_error());
}

mysqli_set_charset($conn, "utf8");
?>