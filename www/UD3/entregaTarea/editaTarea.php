<?php
require 'conexiones/pdo.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = (int)$_POST['id'];
    $titulo = htmlspecialchars($_POST['titulo']);
    $descripcion = htmlspecialchars($_POST['descripcion']);
    $estado = htmlspecialchars($_POST['estado']);
    $id_usuario = !empty($_POST['id_usuario']) ? (int)$_POST['id_usuario'] : null;

    $db = new DatabasePDO();
    $conn = $db->conn;

    try {
        $query = $conn->prepare("
            UPDATE tareas
            SET titulo = :titulo,
                descripcion = :descripcion,
                estado = :estado,
                id_usuario = :id_usuario
            WHERE id = :id
        ");
        $query->execute([
            ':titulo' => $titulo,
            ':descripcion' => $descripcion,
            ':estado' => $estado,
            ':id_usuario' => $id_usuario,
            ':id' => $id
        ]);
        echo '<div class="alert alert-success">Tarea actualizada exitosamente.</div>';
    } catch (PDOException $e) {
        echo '<div class="alert alert-danger">Error al actualizar tarea: ' . $e->getMessage() . '</div>';
    }
}
?>
<a href="tareas.php" class="btn btn-secondary">Volver a la lista</a>
