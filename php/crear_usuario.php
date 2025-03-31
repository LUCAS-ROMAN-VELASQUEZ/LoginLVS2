<?php
// Asumiendo que ya tienes la conexión a la base de datos configurada
require_once 'conexion.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Recibimos los datos del formulario
    $correo = $_POST['correo'];
    $empresa = $_POST['empresa'];
    // Aquí validamos el correo y la empresa
    if (filter_var($correo, FILTER_VALIDATE_EMAIL) && !empty($empresa)) {
        $db = new DB();
        $conn = $db->getConnection();
        // Insertamos el nuevo usuario en la base de datos
        $stmt = $conn->prepare("INSERT INTO Usuario (correo, id_empresa) VALUES (:correo, :empresa)");
        $stmt->bindParam(':correo', $correo);
        $stmt->bindParam(':empresa', $empresa);
        $stmt->execute();
        echo "Usuario creado correctamente. Ahora espera la aprobación.";
    } else {
        echo "Por favor, rellene todos los campos correctamente.";
    }
}
?>
