<?php
include 'utils.php';

// Inicializo cuha mensaxe vacía
$respuesta = "";

// Comprobo que s reciben os datos por POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $descripcion = $_POST['descripcion'];
    $estado = $_POST['estado'];

    // Valido despcripción usando unha función que está en utils
    if (comprobarTextoValido($descripcion)) {
        // Intento gardala tarfa
        $resultado = guardarTarea($descripcion, $estado);
        if ($resultado === true) {
            $respuesta = "Tarefa gardada correctamente.";
        } else {
            $respuesta = $resultado; // de haber un erro, indico      
        }
    } else {
        $respuesta = "Descripción non válida.";
    }
} else {
    $respuesta = "Non se enviou ningún dato.";
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Resultado da Nova Tarefa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <?php include 'header.php'; ?>
    <div class="container">
        <h2>Resultado</h2>
        <p><?php echo $respuesta; ?></p>
        <a href="index.php" class="btn btn-primary mt-3">Voltar ao inicio</a>
    </div>
    <?php include 'footer.php'; ?>
</body>
</html>

