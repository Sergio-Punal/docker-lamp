
<?php
require_once 'conexiones/pdo.php'; 
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Crear Nuevo Usuario</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">Crear Nuevo Usuario</h1>
        <p class="text-center text-muted">Rellena los datos para añadir un nuevo usuario al sistema.</p>

        <form action="nuevoUsuario.php" method="POST" class="mt-4">
            <div class="mb-3">
                <label for="username" class="form-label">Usuario</label>
                <input type="text" id="username" name="username" class="form-control" placeholder="Escribe el nombre de usuario" required>
            </div>

            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" id="nombre" name="nombre" class="form-control" placeholder="Escribe el nombre" required>
            </div>

            <div class="mb-3">
                <label for="apellidos" class="form-label">Apellidos</label>
                <input type="text" id="apellidos" name="apellidos" class="form-control" placeholder="Escribe los apellidos" required>
            </div>

            <div class="mb-3">
                <label for="contrasena" class="form-label">Contraseña</label>
                <input type="password" id="contrasena" name="contrasena" class="form-control" placeholder="Escribe una contraseña" required>
            </div>

            <div class="d-grid">
                <button type="submit" class="btn btn-primary">Crear Usuario</button>
            </div>
        </form>
    </div>

    <div class="container mt-5">
        <a href="index.php" class="btn btn-primary mb-3">Volver a la página principal</a>
    </div>
</body>
</html>