<?php
include '../config/db.php';
include '../includes/header.php';

$mensaje = '';
$id = isset($_GET['id']) ? $_GET['id'] : 0;

// Verificar si existe el vehículo
if ($id > 0) {
    $sql = "SELECT * FROM vehiculos WHERE id_vehiculo = $id";
    $result = mysqli_query($conn, $sql);
    
    if (mysqli_num_rows($result) == 1) {
        $vehiculo = mysqli_fetch_assoc($result);
    } else {
        header('Location: listar.php');
        exit();
    }
} else {
    header('Location: listar.php');
    exit();
}

// Obtener conductores y propietarios para los select
$sql_conductores = "SELECT id_conductor, cedula, primer_nombre, segundo_nombre, apellidos FROM conductores ORDER BY apellidos";
$result_conductores = mysqli_query($conn, $sql_conductores);

$sql_propietarios = "SELECT id_propietario, cedula, primer_nombre, segundo_nombre, apellidos FROM propietarios ORDER BY apellidos";
$result_propietarios = mysqli_query($conn, $sql_propietarios);

// Procesar el formulario de actualización
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $placa = strtoupper($_POST['placa']);
    $color = $_POST['color'];
    $marca = $_POST['marca'];
    $tipo_vehiculo = $_POST['tipo_vehiculo'];
    $id_conductor = $_POST['id_conductor'];
    $id_propietario = $_POST['id_propietario'];
    
    // Verificar si la placa existe y no es la misma del vehículo actual
    $sql_check = "SELECT placa FROM vehiculos WHERE placa = '$placa' AND id_vehiculo != $id";
    $result_check = mysqli_query($conn, $sql_check);
    
    if (mysqli_num_rows($result_check) > 0) {
        $mensaje = "<div class='alert alert-danger'>Error: La placa ya está registrada para otro vehículo.</div>";
    } else {
        $sql_update = "UPDATE vehiculos SET 
                        placa = '$placa', 
                        color = '$color', 
                        marca = '$marca', 
                        tipo_vehiculo = '$tipo_vehiculo', 
                        id_conductor = $id_conductor, 
                        id_propietario = $id_propietario
                      WHERE id_vehiculo = $id";
                      
        if (mysqli_query($conn, $sql_update)) {
            $mensaje = "<div class='alert alert-success'>Datos del vehículo actualizados correctamente.</div>";
            // Actualizar datos en la variable
            $vehiculo['placa'] = $placa;
            $vehiculo['color'] = $color;
            $vehiculo['marca'] = $marca;
            $vehiculo['tipo_vehiculo'] = $tipo_vehiculo;
            $vehiculo['id_conductor'] = $id_conductor;
            $vehiculo['id_propietario'] = $id_propietario;
        } else {
            $mensaje = "<div class='alert alert-danger'>Error: " . mysqli_error($conn) . "</div>";
        }
    }
}
?>

<h2>Editar Vehículo</h2>

<?php echo $mensaje; ?>

<div class="form-container">
    <form method="POST" onsubmit="return validarVehiculo()">
        <div class="mb-3">
            <label for="placa" class="form-label">Placa *</label>
            <input type="text" class="form-control" id="placa" name="placa" value="<?php echo $vehiculo['placa']; ?>" required>
        </div>
        
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="marca" class="form-label">Marca *</label>
                <input type="text" class="form-control" id="marca" name="marca" value="<?php echo $vehiculo['marca']; ?>" required>
            </div>
            
            <div class="col-md-6 mb-3">
                <label for="color" class="form-label">Color *</label>
                <input type="text" class="form-control" id="color" name="color" value="<?php echo $vehiculo['color']; ?>" required>
            </div>
        </div>
        
        <div class="mb-3">
            <label for="tipo_vehiculo" class="form-label">Tipo de Vehículo *</label>
            <select class="form-select" id="tipo_vehiculo" name="tipo_vehiculo" required>
                <option value="particular" <?php echo ($vehiculo['tipo_vehiculo'] == 'particular') ? 'selected' : ''; ?>>Particular</option>
                <option value="publico" <?php echo ($vehiculo['tipo_vehiculo'] == 'publico') ? 'selected' : ''; ?>>Público</option>
            </select>
        </div>
        
        <div class="mb-3">
            <label for="id_conductor" class="form-label">Conductor *</label>
            <select class="form-select" id="id_conductor" name="id_conductor" required>
                <?php 
                if (mysqli_num_rows($result_conductores) > 0) {
                    while ($conductor = mysqli_fetch_assoc($result_conductores)) {
                        $nombre_completo = $conductor['primer_nombre'];
                        if (!empty($conductor['segundo_nombre'])) {
                            $nombre_completo .= ' ' . $conductor['segundo_nombre'];
                        }
                        $nombre_completo .= ' ' . $conductor['apellidos'];
                        $selected = ($vehiculo['id_conductor'] == $conductor['id_conductor']) ? 'selected' : '';
                        echo "<option value='" . $conductor['id_conductor'] . "' $selected>" . $nombre_completo . " (CC: " . $conductor['cedula'] . ")</option>";
                    }
                }
                ?>
            </select>
        </div>
        
        <div class="mb-3">
            <label for="id_propietario" class="form-label">Propietario *</label>
            <select class="form-select" id="id_propietario" name="id_propietario" required>
                <?php 
                if (mysqli_num_rows($result_propietarios) > 0) {
                    while ($propietario = mysqli_fetch_assoc($result_propietarios)) {
                        $nombre_completo = $propietario['primer_nombre'];
                        if (!empty($propietario['segundo_nombre'])) {
                            $nombre_completo .= ' ' . $propietario['segundo_nombre'];
                        }
                        $nombre_completo .= ' ' . $propietario['apellidos'];
                        $selected = ($vehiculo['id_propietario'] == $propietario['id_propietario']) ? 'selected' : '';
                        echo "<option value='" . $propietario['id_propietario'] . "' $selected>" . $nombre_completo . " (CC: " . $propietario['cedula'] . ")</option>";
                    }
                }
                ?>
            </select>
        </div>
        
        <button type="submit" class="btn btn-primary">
    <i class="fas fa-save"></i> Guardar Cambios
</button>
<a href="listar.php" class="btn btn-secondary">
    <i class="fas fa-arrow-left"></i> Cancelar
</a>
    </form>
</div>

<?php
include '../includes/footer.php';
?>