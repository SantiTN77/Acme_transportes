<?php
include 'config/db.php';
include 'includes/header.php';

// Obtener el informe de vehículos con conductor y propietario
$sql = "SELECT 
            v.placa, 
            v.marca,
            CONCAT(c.primer_nombre, ' ', IFNULL(CONCAT(c.segundo_nombre, ' '), ''), c.apellidos) AS conductor,
            CONCAT(p.primer_nombre, ' ', IFNULL(CONCAT(p.segundo_nombre, ' '), ''), p.apellidos) AS propietario
        FROM vehiculos v
        LEFT JOIN conductores c ON v.id_conductor = c.id_conductor
        LEFT JOIN propietarios p ON v.id_propietario = p.id_propietario
        ORDER BY v.placa";
        
$result = mysqli_query($conn, $sql);
?>

<h2>Informe de Vehículos</h2>

<div class="mb-3">
    <a href="vehiculos/registrar.php" class="btn btn-primary">Registrar Nuevo Vehículo</a>
    <button onclick="window.print()" class="btn btn-info">Imprimir</button>
</div>

<div class="table-container">
    <?php if (mysqli_num_rows($result) > 0) { ?>
        <table class="table table-striped table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>Placa</th>
                    <th>Marca</th>
                    <th>Nombre Completo del Conductor</th>
                    <th>Nombre Completo del Propietario</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                    <tr>
                        <td><?php echo $row['placa']; ?></td>
                        <td><?php echo $row['marca']; ?></td>
                        <td><?php echo $row['conductor']; ?></td>
                        <td><?php echo $row['propietario']; ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    <?php } else { ?>
        <div class="alert alert-info">No hay vehículos registrados.</div>
    <?php } ?>
</div>

<?php
include 'includes/footer.php';
?>