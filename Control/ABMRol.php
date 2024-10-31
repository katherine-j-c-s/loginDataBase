<?php

namespace Control;
use Modelo\Rol;
use PDOException;
require_once __DIR__ . '/../Modelo/Rol.php';

class ABMRol {

    public function __construct(){
    }

    //Obtener todas las Rol
    public function obtenerTodosLosRol() {
        $rol = Rol::listar();
        return $rol;
    }

   
    public function obtenerDatosRol($descripcion) {
       
        $roles = Rol::listar("rodescripcion = '" . $descripcion . "'"); // Ajusta el nombre de la tabla según sea necesario
        $salida = null;
        if (is_array($roles) && count($roles) > 0) {
            $salida = $roles[0]; // Solo toma el primer resultado si existe
        }
        
        return $salida; // Devuelve el rol encontrado o null
    }
    public function agregarNuevoRol($roDescripcion) {
        $salida = "";
        $resultado = $this->obtenerDatosRol($roDescripcion);
        
        
        if ($resultado === null) {
            try {
                $objrol = new Rol();
                $objrol->cargar(0, $roDescripcion);
                $idRol=$objrol->insertar();
                $salida = $idRol;
            } catch (PDOException $e) {
                $salida = "Error al registrar el rol: " . $e->getMessage();
            }
        } else {
            $salida = $resultado;
        }
        return $salida;
    }

    public function modificarDatosrol($idRol, $roDescripcion) {
        $salida = "";
    
        // Verifica si el rol existe en la base de datos
        $abmrol = new AbmRol();
        $rol = new Rol();
        $rol->cargar( $idRol, $roDescripcion);
    
        if (!($abmrol->obtenerDatosrol($idRol) === null)) {
            try {
                $rol->modificar();
                $salida = "Rol modificado con éxito.";
            } catch (PDOException $e) {
                $salida = "Error al modificar el Rol: " . $e->getMessage();
            }
        } else {
            $salida = "el Rol no existe en la base de datos.";
        }
    
        return $salida;
    }

}