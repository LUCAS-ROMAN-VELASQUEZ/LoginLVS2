<?php
require_once 'conexion.php';

class empresa {
    private $conn;

    public function __construct() {
        $db = new DB();
        $this->conn = $db->getConnection();
    }

    public function insertarEmpresa($name, $direccion, $sitio_web) {
        $stmt = $this->conn->prepare("INSERT INTO Empresa (name, direccion, sitio_web) 
                                      VALUES (:name, :direccion, :sitio_web)");
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':direccion', $direccion);
        $stmt->bindParam(':sitio_web', $sitio_web);
        $stmt->execute();
        return $this->conn->lastInsertId();
    }
}
?>
