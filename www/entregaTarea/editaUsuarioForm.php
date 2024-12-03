<?php
require 'conexiones/pdo.php';

if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    $db = new DatabasePDO();
    $conn = $db->conn;

    $query = $conn->prepare("SELECT * FROM usuarios WHERE id = :id");
    $query->execute([':id' => $id]);
    $usuario = $query->fetch(PDO::FETCH_ASSOC);

    if (!$usuario) {
        die('<div class="alert alert-danger">Usuario no encontrado.</div>');
    }
} else {
    die('<div class="alert alert-danger">ID no especificado.</div>');
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Usuario</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h1>Editar Usuario</h1>
    <form action="editaUsuario.php" method="post">
        <input type="hidden" name="id" value="<?= $usuario['id'] ?>">
        <div class="mb-3">
            <label for="username" class="form-label">Usuario:</label>
            <input type="text" name="username" id="username" class="form-control" value="<?= htmlspecialchars($usuario['username']) ?>" required>
        </div>
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre:</label>
            <input type="text" name="nombre" id="nombre" class="form-control" value="<?= htmlspecialchars($usuario['nombre']) ?>" required>
        </div>
        <div class="mb-3">
            <label for="apellidos" class="form-label">Apellidos:</label>
            <input type="text" name="apellidos" id="apellidos" class="form-control" value="<?= htmlspecialchars($usuario['apellidos']) ?>" required>
        </div>
        <button type="submit" class="btn btn-primary">Guardar Cambios</button>
    </form>
</div>
</body>
</html>
