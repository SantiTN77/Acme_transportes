<?php
include '../config/db.php';
include '../includes/header.php';

// Eliminar vehículo
if (isset($_GET['eliminar'])) {
    $id = $_GET['eliminar'];
    $sql_delete = "DELETE FROM vehiculos WHERE id_vehiculo = $id";
    
    if (mysqli_query($conn, $sql_delete)) {
        echo "<div class='alert alert-success'>Vehículo eliminado correctamente.</div>";
    } else {
        echo "<div class='alert alert-danger'>Error al eliminar: " . mysqli_error($conn) . "</div>";
    }
}

// Obtener la lista de vehículos con información de conductor y propietario
$sql = "SELECT v.*, 
               c.primer_nombre AS c_primer_nombre, c.segundo_nombre AS c_segundo_nombre, c.apellidos AS c_apellidos, 
               p.primer_nombre AS p_primer_nombre, p.segundo_nombre AS p_segundo_nombre, p.apellidos AS p_apellidos 
        FROM vehiculos v 
        LEFT JOIN conductores c ON v.id_conductor = c.id_conductor 
        LEFT JOIN propietarios p ON v.id_propietario = p.id_propietario 
        ORDER BY v.placa";
        
$result = mysqli_query($conn, $sql);
?>

<h2>Listado de Vehículos</h2>

<div class="mb-3">
    <a href="registrar.php" class="btn btn-primary">Registrar Nuevo Vehículo</a>
</div>

<div class="table-container">
    <?php if (mysqli_num_rows($result) > 0) { ?>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Placa</th>
                    <th>Marca</th>
                    <th>Color</th>
                    <th>Tipo</th>
                    <th>Conductor</th>
                    <th>Propietario</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result)) { 
                    // Nombre completo del conductor
                    $conductor = $row['c_primer_nombre'];
                    if (!empty($row['c_segundo_nombre'])) {
                        $conductor .= ' ' . $row['c_segundo_nombre'];
                    }
                    $conductor .= ' ' . $row['c_apellidos'];
                    
                    // Nombre completo del propietario
                    $propietario = $row['p_primer_nombre'];
                    if (!empty($row['p_segundo_nombre'])) {
                        $propietario .= ' ' . $row['p_segundo_nombre'];
                    }
                    $propietario .= ' ' . $row['p_apellidos'];
                ?>
                    <tr>
                        <td><?php echo $row['placa']; ?></td>
                        <td><?php echo $row['marca']; ?></td>
                        <td><?php echo $row['color']; ?></td>
                        <td><?php echo ucfirst($row['tipo_vehiculo']); ?></td>
                        <td><?php echo $conductor; ?></td>
                        <td><?php echo $propietario; ?></td>
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
        <div class="alert alert-info">No hay vehículos registrados.</div>
    <?php } ?>
</div>

<?php
include '../includes/footer.php';
?>