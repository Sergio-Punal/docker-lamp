
<?php
require 'conexiones/pdo.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validar y sanitizar datos del formulario
    $titulo = htmlspecialchars($_POST['titulo']);
    $descripcion = htmlspecialchars($_POST['descripcion']);
    $estado = htmlspecialchars($_POST['estado']);
    $id_usuario = !empty($_POST['id_usuario']) ? (int)$_POST['id_usuario'] : null;

    // Conexión a la base de datos usando PDO
    $db = new DatabasePDO();
    $conn = $db->conn;

    try {
        // Insertar nueva tarea en la base de datos
        $query = $conn->prepare("
            INSERT INTO tareas (titulo, descripcion, estado, id_usuario)
            VALUES (:titulo, :descripcion, :estado, :id_usuario)
        ");
        $query->execute([
            ':titulo' => $titulo,
            ':descripcion' => $descripcion,
            ':estado' => $estado,
            ':id_usuario' => $id_usuario
        ]);
        $successMessage = "Tarea creada exitosamente.";
    } catch (PDOException $e) {
        $errorMessage = "Error al crear tarea: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Nueva Tarea</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">Crear Nueva Tarea</h1>
        <p class="text-center text-muted">Completa el formulario para añadir una nueva tarea al sistema.</p>

        <?php if (isset($successMessage)): ?>
            <div class="alert alert-success"><?= $successMessage ?></div>
        <?php elseif (isset($errorMessage)): ?>
            <div class="alert alert-danger"><?= $errorMessage ?></div>
        <?php endif; ?>

        <form action="nuevaTarea.php" method="POST" class="mt-4">
            <div class="mb-3">
                <label for="titulo" class="form-label">Título</label>
                <input type="text" id="titulo" name="titulo" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="descripcion" class="form-label">Descripción</label>
                <textarea id="descripcion" name="descripcion" class="form-control" rows="3" required></textarea>
            </div>
            <div class="mb-3">
                <label for="estado" class="form-label">Estado</label>
                <select id="estado" name="estado" class="form-select" required>
                    <option value="" disabled selected>Seleccione un estado</option>
                    <option value="pendiente">Pendiente</option>
                    <option value="en progreso">En Progreso</option>
                    <option value="completada">Completada</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="id_usuario" class="form-label">Asignar a Usuario</label>
                <select id="id_usuario" name="id_usuario" class="form-select">
                    <option value="" disabled selected>Seleccione un usuario (opcional)</option>
                    <?php
                    // Obtener usuarios de la base de datos para el dropdown
                    try {
                        $query = $conn->query("SELECT id, nombre, apellidos FROM usuarios");
                        while ($user = $query->fetch(PDO::FETCH_ASSOC)) {
                            echo "<option value=\"{$user['id']}\">{$user['nombre']} {$user['apellidos']}</option>";
                        }
                    } catch (PDOException $e) {
                        echo '<option disabled>Error al cargar usuarios</option>';
                    }
                    ?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Crear Tarea</button>
            <a href="index.php" class="btn btn-primary mb-3">Volver a la página principal</a>
        </form>
    </div>
</body>
</html>
