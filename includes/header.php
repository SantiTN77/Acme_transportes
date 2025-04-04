<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transportes ACME S.A.</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="/">
                <img src="/img/logo.jfif" alt="ACME Logo"> Transportes ACME
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="/">Inicio</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="vehiculosDropdown" role="button" data-bs-toggle="dropdown">
                            Vehículos
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="/vehiculos/registrar.php">Registrar</a></li>
                            <li><a class="dropdown-item" href="/vehiculos/listar.php">Listar</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="conductoresDropdown" role="button" data-bs-toggle="dropdown">
                            Conductores
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="/conductores/registrar.php">Registrar</a></li>
                            <li><a class="dropdown-item" href="/conductores/listar.php">Listar</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="propietariosDropdown" role="button" data-bs-toggle="dropdown">
                            Propietarios
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="/propietarios/registrar.php">Registrar</a></li>
                            <li><a class="dropdown-item" href="/propietarios/listar.php">Listar</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/informe.php">Informe</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    
    <div class="container mt-4">