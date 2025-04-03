<?php
include 'includes/header.php';
?>

<div class="jumbotron">
    <h1 class="display-4">Bienvenido a Transportes ACME S.A.</h1>
    <p class="lead">Sistema de gestión de vehículos, conductores y propietarios</p>
    <hr class="my-4">
    <p>Utilice el menú superior para navegar por las diferentes opciones.</p>
</div>

<div class="row mt-4">
    <div class="col-md-4">
        <div class="card mb-4">
            <div class="card-body">
                <h5 class="card-title">Vehículos</h5>
                <p class="card-text">Gestione los vehículos de la empresa.</p>
                <a href="vehiculos/registrar.php" class="btn btn-primary">Registro de Vehículos</a>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card mb-4">
            <div class="card-body">
                <h5 class="card-title">Conductores</h5>
                <p class="card-text">Gestione los conductores de la empresa.</p>
                <a href="conductores/registrar.php" class="btn btn-primary">Registro de Conductores</a>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card mb-4">
            <div class="card-body">
                <h5 class="card-title">Propietarios</h5>
                <p class="card-text">Gestione los propietarios de vehículos.</p>
                <a href="propietarios/registrar.php" class="btn btn-primary">Registro de Propietarios</a>
            </div>
        </div>
    </div>
</div>

<?php
include 'includes/footer.php';
?>