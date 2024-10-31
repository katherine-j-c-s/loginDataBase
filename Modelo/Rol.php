<?php
namespace Modelo;

require_once __DIR__ . '/Conector/BaseDatos.php';  // Ajusta la ruta según la ubicación real del archivo
use Modelo\Conector\BaseDatos;

class Rol {

    private $roDescripcion;
    private $idRol;

    public function __construct(){
        $this->roDescripcion="";
        $this->idRol ="";
    }

    public function cargar($idRol, $roDescripcion){
        $this->setidRol($idRol);
        $this->setroDescripcion($roDescripcion);
    }

    public function getroDescripcion(){
        return $this->roDescripcion;
    }

    public function setroDescripcion($value){
        $this->roDescripcion = $value;
    }

    public function getidRol(){
        return $this->idRol;
    }

    public function setidRol($idRol){
        $this->idRol = $idRol;
    }

    public function buscar(){
        $resp = false;
        $base = new BaseDatos();
        $sql = "SELECT * FROM rol WHERE idRol = ".$this->getidRol();
        if ($base->Iniciar()) {
            $res = $base->Ejecutar($sql);
            if($res>-1){
                if($res>0){
                    $row = $base->Registro();
                    $this->cargar($row['roDescripcion'], $row['idRol']);
                    $resp = true;              
                }
            }
        } else {
            $this->setidRol("rol->listar: ".$base->getError());
        }
        return $resp;
    
        
    }

    public function insertar(){
        $resp = false;
        $base = new BaseDatos();
        
        if($this->getroDescripcion() != null){
            // Consulta para insertar el nuevo rol
            $sql = "INSERT INTO rol(rodescripcion) VALUES ('".$this->getroDescripcion()."')";
            
            if ($base->Iniciar()) {
                if ($base->Ejecutar($sql)) {
                    // Ahora buscamos el último idRol insertado
                    $sqlID = "SELECT idRol FROM rol ORDER BY idRol DESC LIMIT 1";
                    $base->Ejecutar($sqlID); // Ejecutamos la consulta
                    $rowID = $base->Registro(); // Obtenemos el resultado
                    
                    // Guardamos el idRol en el objeto
                    $this->setidRol($rowID['idRol']); 
                    $resp = $rowID['idRol']; // Devolvemos el idRol
                } else {
                    $this->setroDescripcion("rol->insertar: ".$base->getError());
                }
            } else {
                $this->setroDescripcion("rol->insertar: ".$base->getError());
            }
        }
        
        return $resp;
    }
    

    public function modificar(){
        $resp = false;
        $base = new BaseDatos();
        $sql = "UPDATE rol SET roDescripcion = '".$this->getroDescripcion()."' WHERE idRol='". $this->getidRol()."'";
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                $resp = true;
            } else {
                $this->setidRol("rol->modificar: ".$base->getError());
            }
        } else {
            $this->setidRol("rol->modificar: ".$base->getError());
        }
        return $resp;
    }

    public function eliminar(){
        $resp = false;
        $base = new BaseDatos();
        $sql = "DELETE FROM rol WHERE idRol=".$this->getidRol();
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                $resp = true;
            } else {
                $this->setidRol("rol->eliminar: ".$base->getError());
            }
        } else {
            $this->setidRol("rol->eliminar: ".$base->getError());
        }
        return $resp;
    }

    public static function listar($parametro = "") {
        $arreglo = array(); // Asegúrate de inicializar como array
        $base = new BaseDatos();
        $sql = "SELECT * FROM rol";
        
        if ($parametro != "") {
            $sql .= ' WHERE ' . $parametro; // Corrige la concatenación
        }
        
        $res = $base->Ejecutar($sql);
        
        if ($res > -1) {
            if ($res > 0) {
                while ($row = $base->Registro()) {
                    $obj = new Rol(); // Asegúrate de usar la clase correcta
                    $obj->cargar($row['rodescripcion'], $row['idRol']);
                    array_push($arreglo, $obj);
                }
            }
        }
        return $arreglo; // Asegúrate de siempre retornar un array
    }
}

?>