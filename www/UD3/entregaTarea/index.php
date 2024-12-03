<?php
require_once 'conexiones/mysqli.php';

// Crear a conexión a base de datos
$conexion = new mysqli('db', 'root', 'test');

// Comprobar a conexión
if ($conexion->connect_error) {
    die('Fallo na conexión: ' . $conexion->connect_error);
}

// Chamar a init.php para inicializar a  base de datos e as tablas de ser preciso
include_once 'init.php';  // este archivo encárgase de crear a bbdd e as tablas

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Gestión de tareas</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">Sistema de Gestión de Tareas</h1>
        <p class="text-center text-muted">Administra usuarios y tareas desde un solo lugar.</p>

        <div class="row mt-4">
            <div class="col-md-6 text-center">
                <h3>Gestión de Usuarios</h3>
                <p>Administra los usuarios del sistema: crea, edita, o elimina usuarios existentes.</p>
                <a href="usuarios.php" class="btn btn-primary w-50">Ir a usuarios</a>

            </div>
            <div class="col-md-6 text-center">
                <h3>Gestión de Tareas</h3>
                <p>Administra las tareas asignadas a los usuarios: crea, edita o elimina tareas.</p>
                <a href="tareas.php" class="btn btn-secondary w-50">Ia a tareas</a>
            </div>

        </div>

    </div>
    
</body>
</html>