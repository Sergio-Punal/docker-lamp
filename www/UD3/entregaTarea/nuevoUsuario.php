<?php
require_once 'conexiones/pdo.php'; // Asegúrate de que la conexión sea PDO.

// Comprobamos si se han enviado los datos por POST.
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $nombre = $_POST['nombre'];
    $apellidos = $_POST['apellidos'];
    $contrasena = password_hash($_POST['contrasena'], PASSWORD_BCRYPT); // Hasheamos la contraseña

    // Instanciamos la clase de conexión a la base de datos.
    $db = new DatabasePDO();
    $conn = $db->conn;

    // Preparamos la consulta para insertar el nuevo usuario en la base de datos.
    $query = $conn->prepare("INSERT INTO usuarios (username, nombre, apellidos, contrasena) VALUES (:username, :nombre, :apellidos, :contrasena)");

    // Ejecutamos la consulta con los valores proporcionados.
    $query->execute([
        ':username' => $username,
        ':nombre' => $nombre,
        ':apellidos' => $apellidos,
        ':contrasena' => $contrasena
    ]);

    // Si todo ha salido bien, redirigimos a la lista de usuarios.
    header("Location: usuarios.php");
    exit(); // Importante para evitar que el código continúe ejecutándose.
} else {
    // Si no se ha enviado por POST, redirigimos al formulario de creación de usuario.
    header("Location: nuevoUsuarioForm.php");
    exit();
}
?>


