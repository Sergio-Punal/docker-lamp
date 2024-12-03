<?php
require 'conexiones/pdo.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = htmlspecialchars($_POST['username']);
    $nombre = htmlspecialchars($_POST['nombre']);
    $apellidos = htmlspecialchars($_POST['apellidos']);
    $contraseña = password_hash($_POST['contrasena'], PASSWORD_BCRYPT);

    $db = new DatabasePDO();
    $conn = $db->conn;

    try{
        $query = $conn->prepare("
            INSERT INTO usuarios (username, nombre, apellidos, contrasena)
            VALUES (:username, :nombre, :apellidos, :contrasena)
            ");
            $query->execute([
                ':username' =>$username,
                ':nombre' => $nombre,
                ':apellidos' => $apellidos,
                ':contrasena' => $contrasena
            ]);
            echo '<div class="alert alert-succes">Usuario creado con éxito.</div>';
    } catch (PDOException $e) {
        echo '<div class="alert alert-danger"Error al crear usuarios: ' . $e->getMessege() . '</div>';
    }
}
?>
<a href="usuarios.php" class="btn btn-secondary">Volver a la lista</a>