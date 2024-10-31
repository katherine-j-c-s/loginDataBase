<?php

// header('Content-Type: text/html; charset=utf-8');
// header("Cache-Control: no-cache, must-revalidate ");

/////////////////////////////
// CONFIGURACION APP//
/////////////////////////////

$PROYECTO = 'TP5';

//variable que almacena el directorio del proyecto
$ROOT = $_SERVER['DOCUMENT_ROOT'] . "/$PROYECTO/";

// include_once ($ROOT . 'tp4/utils/functions.php');

// Variable que define la pagina de autenticacion del proyecto
$INICIO = "Location:http://" . $_SERVER['HTTP_HOST'] . "/$PROYECTO/Vista/Login.php";

// variable que define la pagina principal del proyecto (menu principal)
$PRINCIPAL = "Location:http://" . $_SERVER['HTTP_HOST'] . "/$PROYECTO/index.php";

$_SESSION['ROOT'] = $ROOT;

spl_autoload_register(function($clase){
    $directorioBase = __DIR__ . "/"; // Cambiar a __DIR__ si configuracion.php está en TP5/
    $rutaArchivo = $directorioBase . str_replace('\\', '/', $clase) . '.php';
    if (file_exists($rutaArchivo)){
        require_once $rutaArchivo;
    }
});