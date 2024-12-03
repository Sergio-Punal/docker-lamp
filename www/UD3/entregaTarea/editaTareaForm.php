<?php
require 'conexiones/pdo.php';

if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];  // Asegurar de que o id é un entero
    $db = new DatabasePDO();
    $conn = $db->conn;

    // Consultae  tarea correspondente a ese ID
    $query = $conn->prepare("SELECT * FROM tareas WHERE id = :id");
    $query->execute([':id' => $id]);
    $tarea = $query->fetch(PDO::FETCH_ASSOC);

    if (!$tarea) {
        die('<div class="alert alert-danger">Tarea no encontrada.</div>');  // Si no se encuentra la tarea
    }

    // Consultar los usuarios disponibles para asignarles la tarea
    $query = $conn->prepare("SELECT id, username FROM usuarios");
    $query->execute();
    $usuarios = $query->fetchAll(PDO::FETCH_ASSOC);
} else {
    die('<div class="alert alert-danger">ID no especificado.</div>');  // Si no se pasa el ID en la URL
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Tarea</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h1>Editar Tarea</h1>
    
    <form action="editaTareaForm.php" method="post">
        <input type="hidden" name="id" value="<?= $tarea['id'] ?>">  
        
        <div class="mb-3">
            <label for="titulo" class="form-label">Título:</label>
            <input type="text" name="titulo" id="titulo" class="form-control" value="<?= htmlspecialchars($tarea['titulo']) ?>" required>  <!-- Título de la tarea -->
        </div>
        
        <div class="mb-3">
            <label for="descripcion" class="form-label">Descripción:</label>
            <textarea name="descripcion" id="descripcion" class="form-control" rows="4" required><?= htmlspecialchars($tarea['descripcion']) ?></textarea>  <!-- Descripción de la tarea -->
        </div>
        
        <div class="mb-3">
            <label for="estado" class="form-label">Estado:</label>
            <select name="estado" id="estado" class="form-select" required>
                <option value="pendiente" <?= $tarea['estado'] === 'pendiente' ? 'selected' : '' ?>>Pendiente</option>
                <option value="en progreso" <?= $tarea['estado'] === 'en progreso' ? 'selected' : '' ?>>En Progreso</option>
                <option value="completada" <?= $tarea['estado'] === 'completada' ? 'selected' : '' ?>>Completada</option>
            </select>  
        </div>
        
        <div class="mb-3">
            <label for="id_usuario" class="form-label">Asignar a:</label>
            <select name="id_usuario" id="id_usuario" class="form-select">
                <option value="">Ninguno</option>  
                <?php foreach ($usuarios as $usuario): ?>
                    <option value="<?= $usuario['id'] ?>" <?= $tarea['id_usuario'] == $usuario['id'] ? 'selected' : '' ?>>
                        <?= htmlspecialchars($usuario['username']) ?>
                    </option>  
                <?php endforeach; ?>
            </select>  
        </div>
        
        <button type="submit" class="btn btn-primary">Actualizar</button>  
    </form>
</div>
</body>
</html>

