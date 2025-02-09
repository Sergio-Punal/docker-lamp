<?php
  function cargarEntorno($ruta)
  {
      if (!file_exists($ruta)) {
          throw new Exception("El archivo .env no se encontró en la ruta especificada: $ruta");
      }
  
      $lineas = file($ruta, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
      foreach ($lineas as $linea) {
          $linea = trim($linea);
  
          // Omitir líneas vacías y comentarios
          if ($linea === '' || strpos($linea, '#') === 0) {
              continue;
          }
  
          // Separar clave y valor
          if (strpos($linea, '=') !== false) {
              list($nombre, $valor) = explode('=', $linea, 2);
              $nombre = trim($nombre);
              $valor = trim($valor);
  
              // Eliminar comillas si las hay
              if (preg_match('/^"(.*)"$/', $valor, $coincidencias) || preg_match("/^'(.*)'$/", $valor, $coincidencias)) {
                  $valor = $coincidencias[1];
              }
  
              // Reemplazar variables de entorno referenciadas
              $valor = preg_replace_callback('/\${(\w+)}/', function ($coincidencias) {
                  return getenv($coincidencias[1]) ?: $coincidencias[0];
              }, $valor);
  
              // Establecer la variable de entorno
              putenv("$nombre=$valor");
              $_ENV[$nombre] = $valor;
              $_SERVER[$nombre] = $valor;
          }
      }
  }
  
?>