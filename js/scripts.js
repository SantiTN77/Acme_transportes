// Validar elformulario de registro de vehiculos
function validarVehiculo() {
    let placa = document.getElementById('placa').value;
    let marca = document.getElementById('marca').value;
    let color = document.getElementById('color').value;
    
    if (placa === '') {
        alert('Por favor ingrese la placa del vehículo');
        return false;
    }
    
    if (marca === '') {
        alert('Por favor ingrese la marca del vehículo');
        return false;
    }
    
    if (color === '') {
        alert('Por favor ingrese el color del vehículo');
        return false;
    }
    
    return true;
}

// Validar formulario de registro de personass
function validarPersona() {
    let cedula = document.getElementById('cedula').value;
    let primer_nombre = document.getElementById('primer_nombre').value;
    let apellidos = document.getElementById('apellidos').value;
    let telefono = document.getElementById('telefono').value;
    
    if (cedula === '') {
        alert('Por favor ingrese el número de cédula');
        return false;
    }
    
    if (primer_nombre === '') {
        alert('Por favor ingrese el primer nombre');
        return false;
    }
    
    if (apellidos === '') {
        alert('Por favor ingrese los apellidos');
        return false;
    }
    
    if (telefono === '') {
        alert('Por favor ingrese el número de teléfono');
        return false;
    }
    
    return true;
}

// Confirmar eliminación
function confirmarEliminar() {
    return confirm('¿Está seguro de que desea eliminar este registro?');
}