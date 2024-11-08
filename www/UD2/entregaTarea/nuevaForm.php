<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Formulario de Nova Tarefa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>Engadir Nova Tarefa</h1>
        <form class="mb-5" method="post" action="nueva.php">
            <div class="mb-3">
                <label class="form-label">Descripción da tarefa</label>
                <input type="text" class="form-control" name="descripcion" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Estado</label>
                <select class="form-select" name="estado" required>
                    <option value="pendiente">Pendiente</option>
                    <option value="en proceso">En proceso</option>
                    <option value="completa">Completa</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Enviar</button>
        </form>
        <a href="index.php" class="btn btn-primary mt-3">Voltar ao inicio</a>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
