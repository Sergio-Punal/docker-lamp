<?php
//1. Crear la conexión 
$conexion = new mysqli('db', 'root', 'test');

//2. Comprobar la conexión
if ($conexion->connect_error) {
    die('Fallo en la conexión: ' . $conexion->connect_error);
}

echo 'Conexión correcta <br>';

//3. Crear la base de datos si no existe
$dbName = 'tareas';
$sql = "CREATE DATABASE IF NOT EXISTS $dbName";

// Ejecutamos la consulta para crear la base de datos
if ($conexion->query($sql) === TRUE) {
    echo "Base de datos '$dbName' creada correctamente o ya existe.<br>";
} else {
    echo "Error al crear la base de datos: " . $conexion->error . "<br>";
}

//4. Seleccionar la base de datos
if (!$conexion->select_db($dbName)) {
    die('No se pudo seleccionar la base de datos: ' . $conexion->error . '<br>');
}

// Crear las tablas si no existen
// Tabla de usuarios
$createUsuariosTable = "
CREATE TABLE IF NOT EXISTS usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50),
    nombre VARCHAR(50),
    apellidos VARCHAR(100),
    contrasena VARCHAR(100)
)";
if ($conexion->query($createUsuariosTable) === TRUE) {
    echo "Tabla 'usuarios' creada correctamente o ya existe.<br>";
} else {
    echo "Error al crear la tabla 'usuarios': " . $conexion->error . "<br>";
}

// Tabla de tareas
$createTareasTable = "
CREATE TABLE IF NOT EXISTS tareas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(50),
    descripcion VARCHAR(250),
    estado VARCHAR(50),
    id_usuario INT,
    FOREIGN KEY (id_usuario) REFERENCES usuarios(id)
)";

if ($conexion->query($createTareasTable) === TRUE) {
    echo "Tabla 'tareas' creada correctamente o ya existe.<br>";
} else {
    echo "Error al crear la tabla 'tareas': " . $conexion->error . "<br>";
}

//5. Cerrar la conexión
$conexion->close();
?>