<?php
require_once("../../Utils/Funciones.php");
require_once("../../configuracion.php");

use Control\ABMUsuario;
use Control\ABMRol;
use Modelo\Usuario;

$datos = darDatosSubmitted();
$nombre = $datos["usnombre"];
$pass= $datos["uspass"];
$mail= $datos["usmail"];
$rolDesc = $datos["rol"];
$deshabilitado= $datos["usdeshabilitado"];

$passEncriptada = encriptarPassword($pass);

$abmUsuario = new ABMUsuario();
$usuario = $abmUsuario->agregarNuevoUsuario($nombre, $pass, $mail, $deshabilitado);

$abmRol = new ABMRol();
$rol = $abmRol->agregarNuevoRol($rolDesc);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>verificacion de reguistro de usuario</title>
</head>
<body class="bg-light">
<main class="container-fluid cont container">

    <div class="card col-12 text-center">
        <h2>Usuario</h2>
        <div class="container text-center">
            <h1><?php echo $usuario; ?></h1>
            <h1><?php echo $rol; ?></h1>
        </div>
    </div>
</main>
</body>
</html>