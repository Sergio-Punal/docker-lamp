<?php
require 'conexiones/pdo.php';

$db = new DatabasePDO();
$conn = $db->conn;

$query = $conn->prepare("SELECT * FROM usuarios");
$query->execute();
$usuarios = $query->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Lista de Usuarios</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h1 class="text-center">Gestión de Usuarios</h1>    
    <p class="text-center text-muted">Aquí puedes administrar los usuarios del sistema.</p>
    <h2>Usuarios</h1>
    <a href="nuevoUsuarioForm.php" class="btn btn-primary mb-3">Añadir Usuario</a>
    <table class="table table-bordered">
        <thead>
        <tr>
            <th>ID</th>
            <th>Usuario</th>
            <th>Nombre</th>
            <th>Apellidos</th>
            <th>Acciones</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($usuarios as $usuario): ?>
            <tr>
                <td><?= htmlspecialchars($usuario['id']) ?></td>
                <td><?= htmlspecialchars($usuario['username']) ?></td>
                <td><?= htmlspecialchars($usuario['nombre']) ?></td>
                <td><?= htmlspecialchars($usuario['apellidos']) ?></td>
                <td>
                    <a href="editaUsuarioForm.php?id=<?= $usuario['id'] ?>" class="btn btn-warning">Editar</a>
                    <a href="borraUsuario.php?id=<?= $usuario['id'] ?>" class="btn btn-danger">Borrar</a>
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

