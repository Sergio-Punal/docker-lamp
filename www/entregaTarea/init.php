<?php
require_once 'conexiones/mysqli.php';

// 1. Crear a conexión a base de datos

$conexion = new mysqli('db', 'root', 'test');

// 2. Comprobar a conexión
if ($conexion->connect_error) {
    die('Fallo na conexión: ' . $conexion->connect_error);
}

// 3. Crear a base de datos 'tareas' si non existe
$dbName = 'tareas';
$sql = "CREATE DATABASE IF NOT EXISTS $dbName";

// Executo a consulta pa crar a base de datos
if ($conexion->query($sql) == TRUE) {
    echo "Base de datos '$dbName' creada correctamente oou xa existe.<br>";

} else {
    echo "Error o crear a base de datos: " . $conexion->error . "<br>";
}

// 4. Seleccionar a base de datos
if (!$conexion->select_db($dbName)) {
    die('Non se puido seleccionar a base de datos: ' . $conexion->error . '<br>');

}

// Crar as tabas si non existen.
// tabla usuarios
$createUsuariosTable = "
CREATE TABLE IF NOT EXISTS usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50),
    nombre VARCHAR(50),
    apellidos VARCHAR(100),
    contrasena VARCHAR(100)
    )";

if ($conexion->query($createUsuariosTable) === TRUE) {
    echo "Tabla 'usuarios' creada correctamente ou xa existe.<br>";
} else {
    echo "Erro o crear a tabla 'usuarios': " . $conexion->error . "<br>";
}

// tabla de tareas
$createTareasTable = "
CREATE TABLE IF NOT EXISTS tareas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(50),
    descripcion VARCHAR(250),
    estado VARCHAR(50),
    id_usuario INT,
    FOREIGN KEY (id_usuarios) REFERENCES usuarios(id)
    )";

if ($conexion->query($createTareasTable) === TRUE) {
    echo "Tabla 'tareas' creada correctamente ou xa existe<br>";
} else {
    echo "Erro o crar a tabla 'tareas': " . $conexion->error . "<br>";
}

// 5. Cerrar a conexión
$conexion->close();

?>