<?php
require_once 'conexion.php';

class firma {
    private $conn;

    public function __construct() {
        $db = new DB();
        $this->conn = $db->getConnection();
    }

    public function insertarFirma($name, $variable1, $variable2, $id_empresa) {
        $stmt = $this->conn->prepare("INSERT INTO Firma (name, variable1, variable2, id_empresa) 
                                      VALUES (:name, :variable1, :variable2, :id_empresa)");
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':variable1', $variable1);
        $stmt->bindParam(':variable2', $variable2);
        $stmt->bindParam(':id_empresa', $id_empresa);
        $stmt->execute();
    }
}
?>