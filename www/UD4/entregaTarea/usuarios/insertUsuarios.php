<?php
require_once __DIR__ . '\env.php';

cargarEntorno(__DIR__ . '\.env');
$servername = getenv('DATABASE_HOST');
$username = getenv('DATABASE_USER');
$password = getenv('DATABASE_PASSWORD');
$dbname = getenv('DATABASE_NAME');

try
{
    //1. Conexión a base de datos
    $conPDO = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    //2. Forzar excepciones
    $conPDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Conexión correcta <br>";


    $stmt = $conPDO->prepare("INSERT INTO usuario (nombre, pass) VALUES (:nombre, :pass)");

    $usuario = 'marco';
    $hasheado = password_hash("marco123.", PASSWORD_DEFAULT);
    $stmt->bindParam(':nombre', $usuario);
    $stmt->bindParam(':pass', $hasheado);
    $stmt->execute();
    echo "Usuario $usuario <br>";

    $usuario = 'sabela';
    $hasheado = password_hash("sabela123.", PASSWORD_DEFAULT);
    $stmt->bindParam(':nombre', $usuario);
    $stmt->bindParam(':pass', $hasheado);
    $stmt->execute();
    echo "Usuario $usuario <br>";

    $usuario = 'admin';
    $hasheado = password_hash("Abc123.", PASSWORD_DEFAULT);
    $stmt->bindParam(':nombre', $usuario);
    $stmt->bindParam(':pass', $hasheado);
    $stmt->execute();
    echo "Usuario $usuario <br>";

    // Cerrar el cursor
    $stmt->closeCursor();

}
catch (PDOException $ex)
{
    echo "Error en la conexión: " . $ex->getMessage();
}
finally 
{
    $conPDO = null;
}
