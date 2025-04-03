<?php
include '../config/db.php';
include '../includes/header.php';

$mensaje = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $cedula = $_POST['cedula'];
    $primer_nombre = $_POST['primer_nombre'];
    $segundo_nombre = isset($_POST['segundo_nombre']) ? $_POST['segundo_nombre'] : '';
    $apellidos = $_POST['apellidos'];
    $direccion = $_POST['direccion'];
    $telefono = $_POST['telefono'];
    $ciudad = $_POST['ciudad'];
    
    // Verificar si la cédula ya existe
    $sql_check = "SELECT cedula FROM propietarios WHERE cedula = '$cedula'";
    $result_check = mysqli_query($conn, $sql_check);
    
    if (mysqli_num_rows($result_check) > 0) {
        $mensaje = "<div class='alert alert-danger'>Error: La cédula ya está registrada.</div>";
    } else {
        $sql = "INSERT INTO propietarios (cedula, primer_nombre, segundo_nombre, apellidos, direccion, telefono, ciudad) 
                VALUES ('$cedula', '$primer_nombre', '$segundo_nombre', '$apellidos', '$direccion', '$telefono', '$ciudad')";
        
        if (mysqli_query($conn, $sql)) {
            $mensaje = "<div class='alert alert-success'>Propietario registrado correctamente.</div>";
        } else {
            $mensaje = "<div class='alert alert-danger'>Error: " . mysqli_error($conn) . "</div>";
        }
    }
}
?>

<h2>Registro de Propietarios</h2>

<?php echo $mensaje; ?>

<div class="form-container">
    <form method="POST" onsubmit="return validarPersona()">
        <div class="mb-3">
            <label for="cedula" class="form-label">Número de Cédula *</label>
            <input type="text" class="form-control" id="cedula" name="cedula" required>
        </div>
        
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="primer_nombre" class="form-label">Primer Nombre *</label>
                <input type="text" class="form-control" id="primer_nombre" name="primer_nombre" required>
            </div>
            
            <div class="col-md-6 mb-3">
                <label for="segundo_nombre" class="form-label">Segundo Nombre</label>
                <input type="text" class="form-control" id="segundo_nombre" name="segundo_nombre">
            </div>
        </div>
        
        <div class="mb-3">
            <label for="apellidos" class="form-label">Apellidos *</label>
            <input type="text" class="form-control" id="apellidos" name="apellidos" required>
        </div>
        
        <div class="mb-3">
            <label for="direccion" class="form-label">Dirección *</label>
            <input type="text" class="form-control" id="direccion" name="direccion" required>
        </div>
        <div class="mb-3">
            <label for="telefono" class="form-label">Teléfono *</label>
            <input type="text" class="form-control" id="telefono" name="telefono" required>
        </div>
        <div class="mb-3">
            <label for="ciudad" class="form-label">Ciudad *</label>
            <input type="text" class="form-control" id="ciudad" name="ciudad" required>
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