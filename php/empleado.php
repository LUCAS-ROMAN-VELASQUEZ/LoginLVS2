<?php
require_once 'conexion.php';

class Empleado {
    private $conn;

    public function __construct() {
        $db = new DB();
        $this->conn = $db->getConnection();
    }
    public function insertarEmpleado($name, $apellidos, $cargo, $correo) {
        $stmt = $this->conn->prepare("INSERT INTO Empleado (name, apellidos, cargo, correo_electronico) 
                                      VALUES (:name, :apellidos, :cargo, :correo)");
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':apellidos', $apellidos);
        $stmt->bindParam(':cargo', $cargo);
        $stmt->bindParam(':correo', $correo);
        $stmt->execute();
        return $this->conn->lastInsertId();
    }
}
?>
