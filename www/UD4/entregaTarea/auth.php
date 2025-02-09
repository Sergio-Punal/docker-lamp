<?php
session_start();
if(!$_POST["usuario"])
  {
    header("Location: login.php?redirect=true");
    exit();
  }
  {
    require_once('../modelo/pdo.php');

    function comporbar_usuario($nombre, $pass)
    {
      $buscaUser = buscaUsuario($nombre);
      
      if($nombre==$buscaUser['username'] && $pass=$buscaUser['contrasena'])
        {
          unset($buscaUser['contrasena']);
          return $buscaUser;
        }
        else
        {
            return false;
        }
    }

    //Comprobar si se reciben los datos
    if($_SERVER["REQUEST_METHOD"]=="POST"){
        $usuario = $_POST["usuario"];
        $pass = $_POST["pass"];
        $user = comporbar_usuario($usuario, $pass );
        if(!$user)
        {
            header('Location: login.php?error=true');
        }
        else
        {
            $_SESSION['usuario'] = $user;
            //Redirigimos a index.php
            header('Location: index.php');
        }
    }
  }