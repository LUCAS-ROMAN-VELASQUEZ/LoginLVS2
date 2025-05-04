<?php
require_once '../includes/conexion.php';
$data = json_decode(file_get_contents("php://input"), true);
file_put_contents("debug.json", print_r($data, true));
header('Content-Type: application/json');
if (isset($data['empresa_id'])) {
    $empresa_id = $data['empresa_id'];
    $stmt = $conexion->prepare("SELECT id, name FROM Firma WHERE id_empresa = ?");
    $stmt->bind_param("i", $empresa_id);
    $stmt->execute();
    $resultado = $stmt->get_result();
    $firmas = [];
    while ($fila = $resultado->fetch_assoc()) {
        $firmas[] = $fila;
    }
    echo json_encode($firmas);
} else {
    echo json_encode([]);
}
?>
