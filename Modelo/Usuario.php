<?php
namespace Modelo;

require_once __DIR__ . '/Conector/BaseDatos.php';
use Modelo\Conector\BaseDatos;

class Usuario {

    private $usnombre;
    private $usPass;
    private $usmail;
    private $usDeshabilitado;
    private $idUsario;

    public function __construct(){
        $this->usnombre="";
        $this->usPass="";
        $this->usmail="";
        $this->usDeshabilitado ="";
        $this->idUsario ="";
    }

    public function cargar($usnombre, $usPass, $usmail, $usDeshabilitado,$idUsario){
        $this->setusNombre($usnombre);
        $this->setusPass($usPass);
        $this->setusmail($usmail);
        $this->setusDeshabilitado($usDeshabilitado);
        $this->setidUsario($idUsario);
    }

    public function getusNombre(){
        return $this->usnombre;
    }

    public function setusNombre($usnombre){
        $this->usnombre = $usnombre;
    }

    public function getusPass(){
        return $this->usPass;
    }

    public function setusPass($usPass){
        $this->usPass = $usPass;
    }

    public function getusmail(){
        return $this->usmail;
    }

    public function setusmail($cant){
        $this->usmail = $cant;
    }

    public function getusDeshabilitado(){
        return $this->usDeshabilitado;
    }

    public function setusDeshabilitado($usDeshabilitado){
        $this->usDeshabilitado = $usDeshabilitado;
    }

    public function getidUsario(){
        return $this->idUsario;
    }

    public function setidUsario($idUsario){
        $this->idUsario = $idUsario;
    }
    public function buscar(){
        $resp = false;
        $base = new BaseDatos();
        $sql = "SELECT * FROM usuario WHERE usnombre = ".$this->getusNombre();
        if ($base->Iniciar()) {
            $res = $base->Ejecutar($sql);
            if($res>-1){
                if($res>0){
                    $row = $base->Registro();
                    $this->cargar($row['usnombre'], $row['usPass'], $row['usmail'], $row['usDeshabilitado'], $row['idUsario']);
                    $resp = true;              
                }
            }
        } else {
            $this->setusDeshabilitado("usuario->listar: ".$base->getError());
        }
        return $resp;
    
        
    }

    public function insertar(){
        $resp = false;
        $base = new BaseDatos();
        if($this->getusmail() != null){
            $sql="INSERT INTO usuario(usnombre, uspass, usmail, usdeshabilitado) VALUES ('".$this->getusNombre()."','".$this->getusPass()."','".$this->getusmail()."','".$this->getusDeshabilitado()."')";
            if ($base->Iniciar()) {
                if ($base->Ejecutar($sql)) {
                    // Ahora buscamos el último idUsuario insertado
                    $sqlID = "SELECT idUsuario FROM usuario ORDER BY idUsuario DESC LIMIT 1";
                    $base->Ejecutar($sqlID); // Ejecutamos la consulta
                    $rowID = $base->Registro(); // Obtenemos el resultado
                    $this->setidUsario($rowID['idUsuario']); // Guardamos el idUsuario en el objeto
                    $resp = $rowID['idUsuario']; // Devolvemos el idUsuario
                } else {
                    $this->setusDeshabilitado("usuario->insertar: ".$base->getError());
                }
            } else {
                $this->setusDeshabilitado("usuario->insertar: ".$base->getError());
            }
        }
        return $resp;
    }

    public function modificar(){
        $resp = false;
        $base = new BaseDatos();
        $sql = "UPDATE usuario SET usmail = '".$this->getusmail()."' WHERE usnombre='". $this->getusNombre()."'";
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                $resp = true;
            } else {
                $this->setusDeshabilitado("usuario->modificar: ".$base->getError());
            }
        } else {
            $this->setusDeshabilitado("usuario->modificar: ".$base->getError());
        }
        return $resp;
    }

    public function eliminar(){
        $resp = false;
        $base = new BaseDatos();
        $sql = "DELETE FROM usuario WHERE usnombre=".$this->getusNombre();
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                $resp = true;
            } else {
                $this->setusDeshabilitado("usuario->eliminar: ".$base->getError());
            }
        } else {
            $this->setusDeshabilitado("usuario->eliminar: ".$base->getError());
        }
        return $resp;
    }

    public static function listar($parametro=""){
        $arreglo = array();
        $base = new BaseDatos();
        $sql = "SELECT * FROM usuario ";
        if ($parametro!="") {
            $sql.='WHERE '.$parametro;
        }
        $res = $base->Ejecutar($sql);
        if($res>-1){
            if($res>0){
                
                while ($row = $base->Registro()){
                    $obj= new Usuario();
                    $obj->cargar($row['usnombre'], $row['uspass'], $row['usmail'], $row['usdeshabilitado'], $row['idUsuario']);
                    array_push($arreglo, $obj);
                }
            }
            
        }
        return $arreglo;
    }
}

?>