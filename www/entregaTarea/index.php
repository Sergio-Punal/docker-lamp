
<?php
require_once 'conexiones/mysqli.php';

// Crear la conexión a la base de datos
$conexion = new mysqli('db', 'root', 'test');

// Comprobar la conexión
if ($conexion->connect_error) {
    die('Fallo en la conexión: ' . $conexion->connect_error);
}

// Llamar a init.php para inicializar la base de datos y las tablas si es necesario
include_once 'init.php';  // Este archivo se encarga de crear la base de datos y las tablas

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Gestión de Tareas</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
        <h1 class="text-center">Sistema de Gestión de Tareas</h1>
        <p class="text-center text-muted">Administra usuarios y tareas desde un solo lugar.</p>

        <div class="row mt-4">
            <div class="col-md-6 text-center">
                <h3>Usuarios</h3>
                <p>Administra los usuarios del sistema: crea, edita, o elimina usuarios existentes.</p>
                <a href="usuarios.php" class="btn btn-primary w-50">Ir a usuarios</a>
                

            </div>
            <div class="col-md-6 text-center">
                <h3>Tareas</h3>
                <p>Administra las tareas asignadas a los usuarios: crea, edita o elimina tareas.</p>
                <a href="tareas.php" class="btn btn-secondary w-50">Ia a tareas</a>
                
            </div>
            <div class="row mt-4">
            <div class="col-md-6 text-center">
                <h3>Crear Usuarios</h3>
                <p>Añade nuevos usuarios.</p>
                <a href="nuevoUsuario.php" class="btn btn-primary w-50">Crear usuario</a>
                

            </div>
            <div class="col-md-6 text-center">
                <h3>Crear Tareas</h3>
                <p>Añade nuevas tareas.</p>
                <a href="tareas.php" class="btn btn-secondary w-50">Añadir tarea</a>
                
            </div>
           

        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
