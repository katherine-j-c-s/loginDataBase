<?php

function darDatosSubmitted(){
    $datos = [];
    //piso el array de datos con los datos que vienen por POST para darles prioridad
    foreach($_GET as $key => $value){
        $datos[$key] = $value;
    }
    foreach($_POST as $key => $value){
        $datos[$key] = $value;
    }
    return $datos;
}

function encriptarPassword($uspass, $modo_binario = true) {
    return md5($uspass, $modo_binario);
}

spl_autoload_register(function ($class_name) {
    //echo "class ".$class_name ;
    $directorys = array(
        $_SESSION['ROOT'].'/TP5/Modelo/',
        $_SESSION['ROOT'].'/TP5/Modelo/Conector/',
        $_SESSION['ROOT'].'/TP5/Control/',
      //  $GLOBALS['ROOT'].'util/class/',
    );
    //print_object($directorys) ;
    foreach($directorys as $directory){
        if(file_exists($directory.$class_name . '.php')){
            // echo "se incluyo".$directory.$class_name . '.php';
            require_once($directory.$class_name . '.php');
            return;
        }
    }
});