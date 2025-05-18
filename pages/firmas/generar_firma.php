<?php
require_once '../../php/includes/conexion.php';
require_once '../../php/includes/functions.php';
include '../../php/includes/header.php';

// Obtener los parámetros de la URL
$empleado_id = $_GET['id_empleado'] ?? null;
$firma_id = $_GET['id_firma'] ?? null;
$empresa_id = $_GET['id_empresa'] ?? null;

// Validar los parámetros
if (!is_numeric($empleado_id) || !is_numeric($firma_id) || !is_numeric($empresa_id)) {
    die("<p class='error'>❌ Error: Parámetros no válidos.</p>");
}

$empleado_id = (int)$empleado_id;
$firma_id = (int)$firma_id;
$empresa_id = (int)$empresa_id;

// Obtener datos de la firma
$stmt_firma = $conexion->prepare("SELECT name FROM Firma WHERE id = ?");
$stmt_firma->bind_param("i", $firma_id);
$stmt_firma->execute();
$result_firma = $stmt_firma->get_result();
$firma = $result_firma->fetch_assoc();
$stmt_firma->close();

if (!$firma) {
    die("<p class='error'>❌ Firma no encontrada</p>");
}

// Redirigir a la plantilla correspondiente según el nombre de la firma
$nombre_firma = strtolower(trim($firma['name']));

switch ($nombre_firma) {
    case 'linkedin':
        header("Location: firma_linkedin.php?id_empleado=$empleado_id&id_firma=$firma_id&id_empresa=$empresa_id");
        exit;
    case 'firma caso de éxito':
        header("Location: firma_exito.php?id_empleado=$empleado_id&id_firma=$firma_id&id_empresa=$empresa_id");
        exit;
    case 'firma simple':
        header("Location: firma_simple.php?id_empleado=$empleado_id&id_firma=$firma_id&id_empresa=$empresa_id");
        exit;
    case 'firma webinar':
        header("Location: firma_webinar.php?id_empleado=$empleado_id&id_firma=$firma_id&id_empresa=$empresa_id");
        exit;
         case 'firmaprueba':
        header("Location: firmaprueba.php?id_empleado=$empleado_id&id_firma=$firma_id&id_empresa=$empresa_id");
        exit;
    default:
        die("<p class='error'>⚠️ No hay plantilla definida para esta firma: $nombre_firma</p>");
}

?>
