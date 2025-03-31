<?php
require_once 'conexion.php';

class usuario {
    private $conn;
    
    public function __construct() {
        $db = new DB();
        $this->conn = $db->getConnection();
    }

    public function verificarUsuario($correo) {
        $stmt = $this->conn->prepare("SELECT * FROM Usuario WHERE correo = :correo");
        $stmt->bindParam(':correo', $correo);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function insertarUsuario($correo, $contraseña, $id_rol, $id_empleado, $id_empresa) {
        $stmt = $this->conn->prepare("INSERT INTO Usuario (correo, contraseña, id_rol, id_empleado, id_empresa) 
                                      VALUES (:correo, :contraseña, :id_rol, :id_empleado, :id_empresa)");
        $stmt->bindParam(':correo', $correo);
        $stmt->bindParam(':contraseña', password_hash($contraseña, PASSWORD_DEFAULT));
        $stmt->bindParam(':id_rol', $id_rol);
        $stmt->bindParam(':id_empleado', $id_empleado);
        $stmt->bindParam(':id_empresa', $id_empresa);
        $stmt->execute();
    }

    public function verificarContraseña($correo, $contraseña) {
        $usuario = $this->verificarUsuario($correo);
        if ($usuario && password_verify($contraseña, $usuario['contraseña'])) {
            return $usuario;
        }
        return false;
    }
}
?>