<?php
require 'conexiones/pdo.php';

if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];

    $db = new DatabasePDO();
    $conn = $db->conn;

    try {
        $query = $conn->prepare("DELETE FROM tareas WHERE id = :id");
        $query->execute([':id' => $id]);
        echo '<div class="alert alert-success">Tarea eliminada correctamnte.</div>';
    } catch (PDOException $e) {
        echo '<div class="alert alert-danger">Erro al eliminar tarea: ' . $e->getMessage() . '</div>';
    }
} else {
    echo '<div class="alert alert-danger">ID de tarea no especificado.</div>';
}
?>
<a href="tareas.php" class="btn btn-secondary">Volver a la lista</a>
