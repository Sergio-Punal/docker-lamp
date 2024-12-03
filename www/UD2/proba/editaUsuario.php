<?php
require 'conexiones/pdo.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = (int)$_POST['id'];
    $username = htmlspecialchars($_POST['username']);
    $nombre = htmlspecialchars($_POST['nombre']);
    $apellidos = htmlspecialchars($_POST['apellidos']);

    $db = new DatabasePDO();
    $conn = $db->conn;

    try {
        $query = $conn->prepare("
            UPDATE usuarios
            SET username = :username, nombre = :nombre, apellidos = :apellidos
            WHERE id = :id
        ");
        $query->execute([
            ':username' => $username,
            ':nombre' => $nombre,
            ':apellidos' => $apellidos,
            ':id' => $id
        ]);
        echo '<div class="alert alert-success">Usuario actualizado exitosamente.</div>';
    } catch (PDOException $e) {
        echo '<div class="alert alert-danger">Error al actualizar usuario: ' . $e->getMessage() . '</div>';
    }
}
?>
<a href="usuarios.php" class="btn btn-secondary">Volver a la lista</a>
