<!-- Archivo: listaTareas.php -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Mis Tareas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <?php include 'header.php'; ?>
    <div class="container-fluid">
        <div class="row">
            <?php include 'menu.php'; ?>
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <h2>Lista de Tareas</h2>
                <div class="table">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Identificador</th>
                                <th>Descripción</th>
                                <th>Estado</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            include 'utils.php';
                            $tareas = obtenerTareas();
                            foreach ($tareas as $tarea) {
                                echo "<tr>
                                    <td>{$tarea['id']}</td>
                                    <td>{$tarea['descripcion']}</td>
                                    <td>{$tarea['estado']}</td>
                                  </tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </main>
        </div>
    </div>
    <?php include 'footer.php'; ?>
</body>
</html>

