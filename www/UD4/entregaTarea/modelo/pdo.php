<?php
require_once __DIR__ . '\env.php';

cargarEntorno(__DIR__ . '\.env');
/* $host = getenv('DATABASE_HOST');
$user = getenv('DATABASE_USER');
$pass = getenv('DATABASE_PASSWORD');
$db = getenv('DATABASE_NAME');

$apiKey = getenv('API_KEY');
$appEnv = getenv('APP_ENV') ?: 'producción'; // Valor por defecto si no está definido */
function conectaPDO()
{
    $servername = getenv('DATABASE_HOST');
    $username = getenv('DATABASE_USER');
    $password = getenv('DATABASE_PASSWORD');
    $dbname = getenv('DATABASE_NAME');

    $conPDO = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conPDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $conPDO;
}

function listaUsuarios()
{
    try {
        $con = conectaPDO();
        $stmt = $con->prepare('SELECT id, username, nombre, apellidos FROM usuarios');
        $stmt->execute();

        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $resultados = $stmt->fetchAll();
        return [true, $resultados];
    }
    catch (PDOException $e) {
        return [false, $e->getMessage()];
    }
    finally {
        $con = null;
    }
    
}

function listaTareasPDO($id_usuario, $estado)
{
    try {
        $con = conectaPDO();
        $sql = 'SELECT * FROM tareas WHERE id_usuario = ' . $id_usuario;
        if (isset($estado))
        {
            $sql = $sql . " AND estado = '" . $estado . "'";
        }
        $stmt = $con->prepare($sql);
        $stmt->execute();

        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $tareas = array();
        while ($row = $stmt->fetch())
        {
            $usuario = buscaUsuario($row['id_usuario']);
            $row['id_usuario'] = $usuario['username'];
            array_push($tareas, $row);
        }
        return [true, $tareas];
    }
    catch (PDOException $e) {
        return [false, $e->getMessage()];
    }
    finally {
        $con = null;
    }
    
}

function nuevoUsuario($nombre, $apellidos, $username, $contrasena,$rol)
{
    try{
        $con = conectaPDO();
        $hasheado = password_hash($contrasena, PASSWORD_DEFAULT);
        $stmt = $con->prepare("INSERT INTO usuarios (nombre, apellidos, username, contrasena, rol) VALUES (:nombre, :apellidos, :username, :contrasena, :rol)");
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':apellidos', $apellidos);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':contrasena', $hasheado);
        $stmt->bindParam(':rol', $rol);
        $stmt->execute();
        
        $stmt->closeCursor();

        return [true, null];
    }
    catch (PDOException $e)
    {
        return [false, $e->getMessage()];
    }
    finally
    {
        $con = null;
    }
}

function actualizaUsuario($id, $nombre, $apellidos, $username, $contrasena)
{
    try{
        $con = conectaPDO();
        $sql = "UPDATE usuarios SET nombre = :nombre, apellidos = :apellidos, username = :username";

        if (isset($contrasena))
        {
          $hasheado = password_hash($contrasena, PASSWORD_DEFAULT);
          $sql = $sql . ', contrasena = :contrasena';
        }

        $sql = $sql . ' WHERE id = :id';

        $stmt = $con->prepare($sql);
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':apellidos', $apellidos);
        $stmt->bindParam(':username', $username);
        if (isset($contrasena)) $stmt->bindParam(':contrasena', $hasheado);
        $stmt->bindParam(':id', $id);

        $stmt->execute();
        
        $stmt->closeCursor();

        return [true, null];
    }
    catch (PDOException $e)
    {
        return [false, $e->getMessage()];
    }
    finally
    {
        $con = null;
    }
}

function borraUsuario($id)
{
    try {
        $con = conectaPDO();

        $con->beginTransaction();

        $stmt = $con->prepare('DELETE FROM tareas WHERE id_usuario = ' . $id);
        $stmt->execute();
        $stmt = $con->prepare('DELETE FROM usuarios WHERE id = ' . $id);
        $stmt->execute();
        
        return [$con->commit(), ''];
    }
    catch (PDOException $e)
    {
        return [false, $e->getMessage()];
    }
    finally
    {
        $con = null;
    }
}

function buscaUsuario($username)
{

    try
    {
        $con = conectaPDO();
        $stmt = $con->prepare('SELECT * FROM usuarios WHERE username = ' . $username);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);

        if ($stmt->rowCount() == 1)
        {
            return $stmt->fetch();
        }
        else
        {
            return null;
        }
    }
    catch (PDOException $e)
    {
        return null;
    }
    finally
    {
        $con = null;
    }
    
}