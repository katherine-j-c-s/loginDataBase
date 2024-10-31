<?php

namespace Control;
use Modelo\UsuarioRol;
use PDOException;
require __DIR__ . '../../Modelo/UsuarioRol.php';

class AbmUsuarioRol {

    public function __construct(){
    }

    //Obtener todas las Usuarios con sus rols
    public function obtenerTodosLosUsuarios() {
        $Usuarios = UsuarioRol::listar();
        return $Usuarios;
    }

   
    // Obtener Usuario por dni
    public function obtenerDatosUsuario($id) {
        $Usuarios = UsuarioRol::listar("idUsuario = '" . $id . "'");
        $salida = "";
        if (count($Usuarios) > 0) {
            $salida = $Usuarios[0];
        } else {
            $salida = null;
        }
        return $salida;
    }

    public function agregarNuevoUsuario($idUsario, $idRol) {
        $salida = "";
        if (!($this->obtenerDatosUsuario($idUsario) !== null)) {
            try {
                $objUsuario = new UsuarioRol();
                $objUsuario->cargar($idUsario,$idRol);
                $objUsuario->insertar();
                $salida = "Usuario registrado con éxito.";
            } catch (PDOException $e) {
                $salida = "Error al registrar el Usuario: " . $e->getMessage();
            }
        } else {
            $salida = "el Usuario ya está registrado.";
        }
        return $salida;
    }

    public function modificarDatosUsuario($idUsuario, $idRol) {
        $salida = "";
    
        // Verifica si el Usuario existe en la base de datos
        $abmUsuario = new AbmUsuario();
        $Usuario = new UsuarioRol();
        $Usuario->cargar( $idUsuario, $idRol);
    
        if (!($abmUsuario->obtenerDatosUsuario($idUsuario) === null)) {
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