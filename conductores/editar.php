<?php
include '../config/db.php';
include '../includes/header.php';

$mensaje = '';
$id = isset($_GET['id']) ? $_GET['id'] : 0;

// Verificar si existe el conductor
if ($id > 0) {
    $sql = "SELECT * FROM conductores WHERE id_conductor = $id";
    $result = mysqli_query($conn, $sql);
    
    if (mysqli_num_rows($result) == 1) {
        $conductor = mysqli_fetch_assoc($result);
    } else {
        header('Location: listar.php');
        exit();
    }
} else {
    header('Location: listar.php');
    exit();
}

// Procesar el formulario de actualización
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $cedula = $_POST['cedula'];
    $primer_nombre = $_POST['primer_nombre'];
    $segundo_nombre = isset($_POST['segundo_nombre']) ? $_POST['segundo_nombre'] : '';
    $apellidos = $_POST['apellidos'];
    $direccion = $_POST['direccion'];
    $telefono = $_POST['telefono'];
    $ciudad = $_POST['ciudad'];
    
    // Verificar si la cédula existe y no es la misma del conductor actual
    $sql_check = "SELECT cedula FROM conductores WHERE cedula = '$cedula' AND id_conductor != $id";
    $result_check = mysqli_query($conn, $sql_check);
    
    if (mysqli_num_rows($result_check) > 0) {
        $mensaje = "<div class='alert alert-danger'>Error: La cédula ya está registrada para otro conductor.</div>";
    } else {
        $sql_update = "UPDATE conductores SET 
                        cedula = '$cedula', 
                        primer_nombre = '$primer_nombre', 
                        segundo_nombre = '$segundo_nombre', 
                        apellidos = '$apellidos', 
                        direccion = '$direccion', 
                        telefono = '$telefono', 
                        ciudad = '$ciudad' 
                      WHERE id_conductor = $id";
                      
        if (mysqli_query($conn, $sql_update)) {
            $mensaje = "<div class='alert alert-success'>Datos del conductor actualizados correctamente.</div>";
            $conductor['cedula'] = $cedula;
            $conductor['primer_nombre'] = $primer_nombre;
            $conductor['segundo_nombre'] = $segundo_nombre;
            $conductor['apellidos'] = $apellidos;
            $conductor['direccion'] = $direccion;
            $conductor['telefono'] = $telefono;
            $conductor['ciudad'] = $ciudad;
        } else {
            $mensaje = "<div class='alert alert-danger'>Error: " . mysqli_error($conn) . "</div>";
        }
    }
}
?>

<h2>Editar Conductor</h2>

<?php echo $mensaje; ?>

<div class="form-container">
    <form method="POST" onsubmit="return validarPersona()">
        <div class="mb-3">
            <label for="cedula" class="form-label">Número de Cédula *</label>
            <input type="text" class="form-control" id="cedula" name="cedula" value="<?php echo $conductor['cedula']; ?>" required>
        </div>
        
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="primer_nombre" class="form-label">Primer Nombre *</label>
                <input type="text" class="form-control" id="primer_nombre" name="primer_nombre" value="<?php echo $conductor['primer_nombre']; ?>" required>
            </div>
            
            <div class="col-md-6 mb-3">
                <label for="segundo_nombre" class="form-label">Segundo Nombre</label>
                <input type="text" class="form-control" id="segundo_nombre" name="segundo_nombre" value="<?php echo $conductor['segundo_nombre']; ?>">
            </div>
        </div>
        
        <div class="mb-3">
            <label for="apellidos" class="form-label">Apellidos *</label>
            <input type="text" class="form-control" id="apellidos" name="apellidos" value="<?php echo $conductor['apellidos']; ?>" required>
        </div>
        
        <div class="mb-3">
            <label for="direccion" class="form-label">Dirección *</label>
            <input type="text" class="form-control" id="direccion" name="direccion" value="<?php echo $conductor['direccion']; ?>" required>
        </div>
        
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="telefono" class="form-label">Teléfono *</label>
                <input type="text" class="form-control" id="telefono" name="telefono" value="<?php echo $conductor['telefono']; ?>" required>
            </div>
            
            <div class="col-md-6 mb-3">
                <label for="ciudad" class="form-label">Ciudad *</label>
                <input type="text" class="form-control" id="ciudad" name="ciudad" value="<?php echo $conductor['ciudad']; ?>" required>
            </div>
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