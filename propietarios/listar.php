<?php
include '../config/db.php';
include '../includes/header.php';

// Eliminar propietario
if (isset($_GET['eliminar'])) {
    $id = $_GET['eliminar'];
    
    // Verificar si el propietario está asociado a algún vehículo
    $sql_check = "SELECT id_vehiculo FROM vehiculos WHERE id_propietario = $id";
    $result_check = mysqli_query($conn, $sql_check);
    
    if (mysqli_num_rows($result_check) > 0) {
        echo "<div class='alert alert-danger'>No se puede eliminar el propietario porque está asociado a uno o más vehículos.</div>";
    } else {
        $sql_delete = "DELETE FROM propietarios WHERE id_propietario = $id";
        if (mysqli_query($conn, $sql_delete)) {
            echo "<div class='alert alert-success'>Propietario eliminado correctamente.</div>";
        } else {
            echo "<div class='alert alert-danger'>Error al eliminar: " . mysqli_error($conn) . "</div>";
        }
    }
}

// Obtener la lista de propietarios
$sql = "SELECT * FROM propietarios ORDER BY apellidos";
$result = mysqli_query($conn, $sql);
?>

<h2>Listado de Propietarios</h2>

<div class="mb-3">
    <a href="registrar.php" class="btn btn-primary">Registrar Nuevo Propietario</a>
</div>

<div class="table-container">
    <?php if (mysqli_num_rows($result) > 0) { ?>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Cédula</th>
                    <th>Nombre Completo</th>
                    <th>Teléfono</th>
                    <th>Ciudad</th>
                    <th>Dirección</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result)) { 
                    $nombre_completo = $row['primer_nombre'];
                    if (!empty($row['segundo_nombre'])) {
                        $nombre_completo .= ' ' . $row['segundo_nombre'];
                    }
                    $nombre_completo .= ' ' . $row['apellidos'];
                ?>
                    <tr>
                        <td><?php echo $row['cedula']; ?></td>
                        <td><?php echo $nombre_completo; ?></td>
                        <td><?php echo $row['telefono']; ?></td>
                        <td><?php echo $row['ciudad']; ?></td>
                        <td><?php echo $row['direccion']; ?></td>
                        <td>
                        <a href="editar.php?id=<?php echo $row['id_conductor']; ?>" class="btn btn-sm btn-warning">
                            <i class="fas fa-edit"></i> Editar
                        </a>
                        <a href="listar.php?eliminar=<?php echo $row['id_conductor']; ?>" class="btn btn-sm btn-danger" onclick="return confirmarEliminar()">
                            <i class="fas fa-trash"></i> Eliminar
                        </a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    <?php } else { ?>
        <div class="alert alert-info">No hay propietarios registrados.</div>
    <?php } ?>
</div>

<?php
include '../includes/footer.php';
?>