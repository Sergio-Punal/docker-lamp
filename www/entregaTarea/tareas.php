<?php
require 'conexiones/pdo.php';

$db = new DatabasePDO();
$conn = $db->conn;

$query = $conn->prepare("
    SELECT tareas.*, usuarios.username AS usuario
    FROM tareas
    LEFT JOIN usuarios ON tareas.id_usuario = usuarios.id
");
$query->execute();
$tareas = $query->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Lista de Tareas</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h1 class="text-center">Gestión de Tareas</h1>    
    <p class="text-center text-muted">Aquí puedes administrar los tareas del sistema.</p>
    <h2>Tareas</h2>
    <a href="nuevaTareaForm.php" class="btn btn-success mb-3">Crear Nueva Tarea</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Título</th>
                <th>Descripción</th>
                <th>Estado</th>
                <th>Asignado a</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($tareas as $tarea): ?>
                <tr>
                    <td><?= htmlspecialchars($tarea['id']) ?></td>
                    <td><?= htmlspecialchars($tarea['titulo']) ?></td>
                    <td><?= htmlspecialchars($tarea['descripcion']) ?></td>
                    <td><?= htmlspecialchars($tarea['estado']) ?></td>
                    <td><?= htmlspecialchars($tarea['usuario']) ?></td>
                    <td>
                        <a href="editaTareaForm.php?id=<?= $tarea['id'] ?>" class="btn btn-warning btn-sm">Editar</a>
                        <a href="borraTarea.php?id=<?= $tarea['id'] ?>" class="btn btn-danger btn-sm">Eliminar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<div class="container mt-5">
        <!-- Enlace a la página principal -->
        <a href="index.php" class="btn btn-primary mb-3">Volver a la página principal</a>

        
    </div>
</body>
</html>
