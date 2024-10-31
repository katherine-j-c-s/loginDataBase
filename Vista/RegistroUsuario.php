<?php
session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Registro de Usuario</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body class="bg-light">

<div class="container">
    <h1 class="mt-5">Registro de Usuario</h1>

    <form action="./Action/VerificarRegistro.php" method="post" class="mt-3">
        <div class="form-group">
            <label for="usnombre">Nombre de Usuario:</label>
            <input type="text" id="usnombre" name="usnombre" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="uspass">Contraseña:</label>
            <input type="password" id="uspass" name="uspass" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="usmail">Correo Electrónico:</label>
            <input type="email" id="usmail" name="usmail" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="usdeshabilitado">Estado (Habilitado/Deshabilitado):</label>
            <input type="text" id="usdeshabilitado" name="usdeshabilitado" class="form-control">
        </div>

        <div class="form-group">
            <label for="rol">Rol:</label>
            <input type="text" id="rol" name="rol" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Registrar Usuario</button>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
