<?php
require 'conexiones/pdo.php';

if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];

    $db = new DatabasePDO();
    $conn = $db->conn;

    try {
        $query = $conn->prepare("DELETE FROM usuarios WHERE id = :id");
        $query->execute([':id' => $id]);
        echo '<div class="alert alert-success">Usuario eliminado correctamente.</div>';
    } catch (PDOException $e) {
        echo '<div class="alert alert-danger">Error al eliminar usuario: ' . $e->getMessage() . '</div>';
    }
} else {
    echo '<div class="alert alert-danger">ID no especificado.</div>';
}
?>
<a href="usuarios.php" class="btn btn-secondary">Volver a la lista</a>
