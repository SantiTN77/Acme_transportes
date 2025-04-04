<?php
include '../config/db.php';

$type = isset($_GET['type']) ? $_GET['type'] : '';

if ($type === 'conductores') {
    $sql = "SELECT id_conductor, cedula, primer_nombre, segundo_nombre, apellidos FROM conductores ORDER BY apellidos";
} elseif ($type === 'propietarios') {
    $sql = "SELECT id_propietario, cedula, primer_nombre, segundo_nombre, apellidos FROM propietarios ORDER BY apellidos";
} else {
    echo json_encode(['error' => 'Tipo no válido']);
    exit();
}

$result = mysqli_query($conn, $sql);

$data = [];
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $nombre_completo = $row['primer_nombre'];
        if (!empty($row['segundo_nombre'])) {
            $nombre_completo .= ' ' . $row['segundo_nombre'];
        }
        $nombre_completo .= ' ' . $row['apellidos'];
        $data[] = [
            'id' => $type === 'conductores' ? $row['id_conductor'] : $row['id_propietario'],
            'nombre' => $nombre_completo,
            'cedula' => $row['cedula']
        ];
    }
}

echo json_encode($data);
?>