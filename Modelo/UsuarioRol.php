<?php
namespace Modelo;

require_once __DIR__ . '/Conector/BaseDatos.php';  // Ajusta la ruta según la ubicación real del archivo
use Modelo\Conector\BaseDatos;

class UsuarioRol {

    private $idUsuario;
    private $idRol;

    public function __construct() {
        $this->idUsuario = null;
        $this->idRol = null;
    }

    public function cargar($idUsuario, $idRol) {
        $this->setIdUsuario($idUsuario);
        $this->setIdRol($idRol);
    }

    public function getIdUsuario() {
        return $this->idUsuario;
    }

    public function setIdUsuario($idUsuario) {
        $this->idUsuario = $idUsuario;
    }

    public function getIdRol() {
        return $this->idRol;
    }

    public function setIdRol($idRol) {
        $this->idRol = $idRol;
    }

    public function buscar() {
        $resp = false;
        $base = new BaseDatos();
        $sql = "SELECT * FROM usuarioRol WHERE idUsuario = " . $this->getIdUsuario() . " AND idRol = " . $this->getIdRol();
        if ($base->Iniciar()) {
            $res = $base->Ejecutar($sql);
            if ($res > -1) {
                if ($res > 0) {
                    $row = $base->Registro();
                    $this->cargar($row['idUsuario'], $row['idRol']);
                    $resp = true;
                }
            }
        } else {
            // Manejar error
        }
        return $resp;
    }

    public function insertar() {
        $resp = false;
        $base = new BaseDatos();
        if ($this->getIdUsuario() != null && $this->getIdRol() != null) {
            $sql = "INSERT INTO usuarioRol (idUsuario, idRol) VALUES (" . $this->getIdUsuario() . ", " . $this->getIdRol() . ")";
            if ($base->Iniciar()) {
                if ($base->Ejecutar($sql)) {
                    $sqlIDRol = "SELECT idRol FROM usuarioRol ORDER BY idRol DESC LIMIT 1";
                    $idRol = $base->Ejecutar($sqlIDRol);
                    $sqlIDUs = "SELECT idUsuario FROM usarioRol ORDER BY idUsuario DESC LIMIT 1";
                    $idUs = $base->Ejecutar($sqlIDUs);
                    $resp = [$idRol,$idUs];
                } else {
                    // Manejar error
                }
            } else {
                // Manejar error
            }
        }
        return $resp;
    }

    public function modificar() {
        $resp = false;
        $base = new BaseDatos();
        $sql = "UPDATE usuarioRol SET idRol = " . $this->getIdRol() . " WHERE idUsuario = " . $this->getIdUsuario();
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                $resp = true;
            } else {
                // Manejar error
            }
        } else {
            // Manejar error
        }
        return $resp;
    }

    public function eliminar() {
        $resp = false;
        $base = new BaseDatos();
        $sql = "DELETE FROM usuarioRol WHERE idUsuario = " . $this->getIdUsuario() . " AND idRol = " . $this->getIdRol();
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                $resp = true;
            } else {
                // Manejar error
            }
        } else {
            // Manejar error
        }
        return $resp;
    }

    public static function listar($parametro = "") {
        $arreglo = array();
        $base = new BaseDatos();
        $sql = "SELECT * FROM usuarioRol ";
        if ($parametro != "") {
            $sql .= 'WHERE ' . $parametro;
        }
        $res = $base->Ejecutar($sql);
        if ($res > -1) {
            if ($res > 0) {
                while ($row = $base->Registro()) {
                    $obj = new UsuarioRol();
                    $obj->cargar($row['idUsuario'], $row['idRol']);
                    array_push($arreglo, $obj);
                }
            }
        } else {
            // Manejar error
        }
        return $arreglo;
    }
}
?>
