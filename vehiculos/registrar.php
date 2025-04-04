<?php
$base_path = dirname(dirname(__FILE__));
include $base_path . '/config/db.php';
include $base_path . '/includes/header.php';
$mensaje = '';

// Obtener conductores y propietarios para los select
$sql_conductores = "SELECT id_conductor, cedula, primer_nombre, segundo_nombre, apellidos FROM conductores ORDER BY apellidos";
$result_conductores = mysqli_query($conn, $sql_conductores);

$sql_propietarios = "SELECT id_propietario, cedula, primer_nombre, segundo_nombre, apellidos FROM propietarios ORDER BY apellidos";
$result_propietarios = mysqli_query($conn, $sql_propietarios);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $placa = strtoupper($_POST['placa']);
    $color = $_POST['color'];
    $marca = $_POST['marca'];
    $tipo_vehiculo = $_POST['tipo_vehiculo'];
    $id_conductor = $_POST['id_conductor'];
    $id_propietario = $_POST['id_propietario'];
    
    // Verificar si la placa ya existe
    $sql_check = "SELECT placa FROM vehiculos WHERE placa = '$placa'";
    $result_check = mysqli_query($conn, $sql_check);
    
    if (mysqli_num_rows($result_check) > 0) {
        $mensaje = "<div class='alert alert-danger'>Error: La placa ya está registrada.</div>";
    } else {
        $sql = "INSERT INTO vehiculos (placa, color, marca, tipo_vehiculo, id_conductor, id_propietario) 
                VALUES ('$placa', '$color', '$marca', '$tipo_vehiculo', $id_conductor, $id_propietario)";
        
        if (mysqli_query($conn, $sql)) {
            $mensaje = "<div class='alert alert-success'>Vehículo registrado correctamente.</div>";
        } else {
            $mensaje = "<div class='alert alert-danger'>Error: " . mysqli_error($conn) . "</div>";
        }
    }
}
?>

<h2>Registro de Vehículos</h2>

<?php echo $mensaje; ?>

<div class="form-container">
    <form method="POST" onsubmit="return validarVehiculo()">
        <div class="mb-3">
            <label for="placa" class="form-label">Placa *</label>
            <input type="text" class="form-control" id="placa" name="placa" placeholder="Ejemplo: ABC123" required>
        </div>
        
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="marca" class="form-label">Marca *</label>
                <input type="text" class="form-control" id="marca" name="marca" required>
            </div>
            
            <div class="col-md-6 mb-3">
                <label for="color" class="form-label">Color *</label>
                <input type="text" class="form-control" id="color" name="color" required>
            </div>
        </div>
        
        <div class="mb-3">
            <label for="tipo_vehiculo" class="form-label">Tipo de Vehículo *</label>
            <select class="form-select" id="tipo_vehiculo" name="tipo_vehiculo" required>
                <option value="">Seleccione...</option>
                <option value="particular">Particular</option>
                <option value="publico">Público</option>
            </select>
        </div>
        
        <div class="mb-3">
            <label for="id_conductor" class="form-label">Conductor *</label>
            <div class="d-flex align-items-center">
            <div id="loading-conductores" style="display: none;">Cargando...</div>
                <select class="form-select" id="id_conductor" name="id_conductor" required>
                    <option value="">Seleccione un conductor...</option>
                    <?php 
                    if (mysqli_num_rows($result_conductores) > 0) {
                        while ($conductor = mysqli_fetch_assoc($result_conductores)) {
                            $nombre_completo = $conductor['primer_nombre'];
                            if (!empty($conductor['segundo_nombre'])) {
                                $nombre_completo .= ' ' . $conductor['segundo_nombre'];
                            }
                            $nombre_completo .= ' ' . $conductor['apellidos'];
                            echo "<option value='" . $conductor['id_conductor'] . "'>" . $nombre_completo . " (CC: " . $conductor['cedula'] . ")</option>";
                        }
                    }
                    ?>
                </select>
                <button type="button" class="btn btn-info ms-2" onclick="actualizarConductores()">Actualizar</button>
            </div>
            <div class="form-text">Si el conductor no está registrado, <a href="../conductores/registrar.php" target="_blank">regístrelo aquí</a>.</div>
        </div>
        
        <div class="mb-3">
            <label for="id_propietario" class="form-label">Propietario *</label>
            <div class="d-flex align-items-center">
                <select class="form-select" id="id_propietario" name="id_propietario" required>
                    <option value="">Seleccione un propietario...</option>
                    <?php 
                    if (mysqli_num_rows($result_propietarios) > 0) {
                        while ($propietario = mysqli_fetch_assoc($result_propietarios)) {
                            $nombre_completo = $propietario['primer_nombre'];
                            if (!empty($propietario['segundo_nombre'])) {
                                $nombre_completo .= ' ' . $propietario['segundo_nombre'];
                            }
                            $nombre_completo .= ' ' . $propietario['apellidos'];
                            echo "<option value='" . $propietario['id_propietario'] . "'>" . $nombre_completo . " (CC: " . $propietario['cedula'] . ")</option>";
                        }
                    }
                    ?>
                </select>
                <button type="button" class="btn btn-info ms-2" onclick="actualizarPropietarios()">Actualizar</button>
            </div>
            <div class="form-text">Si el propietario no está registrado, <a href="../propietarios/registrar.php" target="_blank">regístrelo aquí</a>.</div>
        </div>
            <div class="form-text">Si el propietario no está registrado, <a href="../propietarios/registrar.php" target="_blank">regístrelo aquí</a>.</div>
        </div>
        
        <button type="submit" class="btn btn-primary">
            <i class="fas fa-save"></i> Registrar Conductor
        </button>
        <a href="listar.php" class="btn btn-secondary">
            <i class="fas fa-list"></i> Ver Conductores
        </a>
    </form>
</div>

<?php
include '../includes/footer.php';
?>