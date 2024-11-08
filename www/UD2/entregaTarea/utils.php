<?php
// Variable global pra almacenalas tarefas
$tareas = [
    ['id' => 1, 'descripcion' => 'Estudar PHP', 'estado' => 'pendiente'],
    ['id' => 2, 'descripcion' => 'Facela tarefa de PHP', 'estado' => 'en proceso'],
    ['id' => 3, 'descripcion' => 'Revisar repositorios en GitHub', 'estado' => 'completada'],
    ['id' => 4, 'descripcion' => 'Ir nadar', 'estado' => 'completada']
];

// Función pa obter a lista de tarefas.
function obtenerTareas() {
    global $tareas;
    return $tareas;
}

// Función pa filtrar o contido dun campo.
function filtrarCampo($campo) {
    return htmlspecialchars(trim($campo));
}

// Función pa comprobar  si o texto é valido
function comprobarTextoValido($campo) {  // Cambiado para que coincida con nueva.php
    $campo = filtrarCampo($campo);
    return !empty($campo) && strlen($campo) >= 3;  // Valido que o campo teña o menos 3 caracteres
}

// Función para gardar unha tarefa na lista de tarefas
function guardarTarea($descripcion, $estado) {
    global $tareas;

    // Verifica si a descripción é válida
    if (!comprobarTextoValido($descripcion)) {
        return "Descripción non válida. Debe ter polo menos 3 caracteres.";
    }

    // Valido o estado
    $estadosPermitidos = ['pendiente', 'en proceso', 'completada'];
    if (!in_array($estado, $estadosPermitidos)) {
        return "Estado non válido. Debe ser 'pendiente', 'en proceso' o 'completada'.";
    }

    // Creo a nova tarefa y la agrega a lista global
    $nuevaTarea = [
        'id' => count($tareas) + 1,
        'descripcion' => filtrarCampo($descripcion),
        'estado' => filtrarCampo($estado)
    ];

    $tareas[] = $nuevaTarea;

    return true;
}
?>
