<?php

require_once("../../Utils/Funciones.php");
require_once("../../../configuracion.php");

use Control\AbmUsuario;

$datos = darDatosSubmitted();
$nombre = $datos["usuario"];
$abmPersona = new AbmUsuario();
$persona = $abmPersona->obtenerDatosUsuario($nombre);
$resultado = "";
if ($persona === null) {
    
    $resultado =  "La persona no está registrada. <a href='../ReguistroUsuario.php'>Registrar Nuevo Usuario</a>";
} else {
    $resultado =  "La persona si está registrada. <a href='../Home.php'>ir a home</a>";
    $abmAuto = new AbmUsuario();
    $resultado = $abmAuto->agregarNuevoUsuario($patente, $marca, $modelo, $dniDuenio);
}
            

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>login</title>
</head>
<body class="bg-light">
<main class="container-fluid cont container">

    <div class="card col-12 text-center">
        <h2>Usuario</h2>
        <div class="container text-center">
        
        </div>
    </div>
</main>
</body>
</html>