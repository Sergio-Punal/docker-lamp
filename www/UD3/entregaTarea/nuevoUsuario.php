<?php
require_once 'conexiones/pdo.php'; 

// Comprobo si se han enviado os datos por POST.
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $nombre = $_POST['nombre'];
    $apellidos = $_POST['apellidos'];
    $contrasena = password_hash($_POST['contrasena'], PASSWORD_BCRYPT); // Hasheamos a contraseña

    // conexión a base de datos.
    $db = new DatabasePDO();
    $conn = $db->conn;

    // Preparo a consulta para insertar  novo usuario na base de datos.
    $query = $conn->prepare("INSERT INTO usuarios (username, nombre, apellidos, contrasena) VALUES (:username, :nombre, :apellidos, :contrasena)");

    // Ejecuto a consulta cos valores proporcionados.
    $query->execute([
        ':username' => $username,
        ':nombre' => $nombre,
        ':apellidos' => $apellidos,
        ':contrasena' => $contrasena
    ]);

    // Si todo saiu ben, redirigo a  lista de usuarios.
    header("Location: usuarios.php");
    exit(); // Importante para evitar que o código continúe executándose.
} else {
    // Si non foi enviado por POST, redirixo p formulario de creación de usuario.
    header("Location: nuevoUsuarioForm.php");
    exit();
}
?>


