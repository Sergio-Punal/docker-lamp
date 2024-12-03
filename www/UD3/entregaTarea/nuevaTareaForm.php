<?php
require 'conexiones/pdo.php';

$db = new DatabasePDO();
$conn = $db->conn;

$query = $conn->prepare("SELECT id, username FROM usuarios");
$query->execute();
$usuarios = $query->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Nueva Tarea</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h1>Crear Nueva Tarea</h1>
    <form action="nuevaTarea.php" method="post">
        <div class="mb-3">
            <label for="titulo" class="form-label">Título:</label>
            <input type="text" name="titulo" id="titulo" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="descripcion" class="form-label">Descripción:</label>
            <textarea name="descripcion" id="descripcion" class="form-control" rows="4" required></textarea>
        </div>
        <div class="mb-3">
            <label for="estado" class="form-label">Estado:</label>
            <select name="estado" id="estado" class="form-select" required>
                <option value="pendiente">Pendiente</option>
                <option value="en progreso">En Progreso</option>
                <option value="completada">Completada</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="id_usuario" class="form-label">Asignar a:</label>
            <select name="id_usuario" id="id_usuario" class="form-select">
                <option value="">Ninguno</option>
                <?php foreach ($usuarios as $usuario): ?>
                    <option value="<?= $usuario['id'] ?>"><?= htmlspecialchars($usuario['username']) ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Crear</button>
    </form>
</div>
<div class="container mt-5">
        <!-- Enlace a la página principal -->
        <a href="index.php" class="btn btn-primary mb-3">Volver a la página principal</a>
</div>
</body>
</html>
