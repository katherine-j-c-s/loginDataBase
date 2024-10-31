<?php
namespace Control;
require_once __DIR__ . '/../Modelo/Usuario.php';
use Modelo\Usuario;
use PDOException;

class ABMUsuario {

    public function __construct(){
    }

    //Obtener todas las Usuarios
    public function obtenerTodosLosUsuarios() {
        $Usuarios = Usuario::listar();
        return $Usuarios;
    }

   
    // Obtener Usuario por dni
    public function obtenerDatosUsuario($nombre) {
        $Usuarios = Usuario::listar("usnombre = '" . $nombre . "'"); //linea 20
        $salida = "";
        if (count($Usuarios) > 0) {
            $salida = $Usuarios[0];
        } else {
            $salida = null;
        }
        return $salida;
    }

    public function agregarNuevoUsuario($usnombre, $uspass, $usmail, $usDeshabilitado) {
        $salida = "";
        $resultado = $this->obtenerDatosUsuario($usnombre);
        if ($resultado === null) {
            try {
                $objUsuario = new Usuario();
                $objUsuario->cargar($usnombre,$uspass,$usmail, $usDeshabilitado, 0);
                $idUsuario = $objUsuario->insertar();
                $salida = $idUsuario;
            } catch (PDOException $e) {
                $salida = "Error al registrar el Usuario: " . $e->getMessage();
            }
        } else {
            $salida = $resultado->getIdUsario();
        }
        return $salida;
    }

    public function modificarDatosUsuario($usnombre, $uspass, $usmail, $usDeshabilitado) {
        $salida = "";
    
        // Verifica si el Usuario existe en la base de datos
        $abmUsuario = new AbmUsuario();
        $Usuario = new Usuario();
        $Usuario->cargar( $usnombre, $uspass, $usmail, $usDeshabilitado,0);
    
        if (!($abmUsuario->obtenerDatosUsuario($usnombre) === null)) {
            try {
                $Usuario->modificar();
                $salida = "Usuario modificado con éxito.";
            } catch (PDOException $e) {
                $salida = "Error al modificar la Usuario: " . $e->getMessage();
            }
        } else {
            $salida = "el Usuario no existe en la base de datos.";
        }
    
        return $salida;
    }

}