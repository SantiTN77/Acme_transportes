-- Crear la base de datos
CREATE DATABASE IF NOT EXISTS acme;
USE acme;

-- Crear tabla para los conductores
CREATE TABLE conductores (
    id_conductor INT AUTO_INCREMENT PRIMARY KEY,
    cedula VARCHAR(20) UNIQUE,
    primer_nombre VARCHAR(50) NOT NULL,
    segundo_nombre VARCHAR(50),
    apellidos VARCHAR(100) NOT NULL,
    direccion VARCHAR(150) NOT NULL,
    telefono VARCHAR(20) NOT NULL,
    ciudad VARCHAR(50) NOT NULL,
    fecha_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Crear tabla para los propietarios
CREATE TABLE propietarios (
    id_propietario INT AUTO_INCREMENT PRIMARY KEY,
    cedula VARCHAR(20) UNIQUE,
    primer_nombre VARCHAR(50) NOT NULL,
    segundo_nombre VARCHAR(50),
    apellidos VARCHAR(100) NOT NULL,
    direccion VARCHAR(150) NOT NULL,
    telefono VARCHAR(20) NOT NULL,
    ciudad VARCHAR(50) NOT NULL,
    fecha_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Crear tabla para los vehículos
CREATE TABLE vehiculos (
    id_vehiculo INT AUTO_INCREMENT PRIMARY KEY,
    placa VARCHAR(10) UNIQUE NOT NULL,
    color VARCHAR(30) NOT NULL,
    marca VARCHAR(50) NOT NULL,
    tipo_vehiculo ENUM('particular', 'publico') NOT NULL,
    id_conductor INT,
    id_propietario INT,
    fecha_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_conductor) REFERENCES conductores(id_conductor),
    FOREIGN KEY (id_propietario) REFERENCES propietarios(id_propietario)
);