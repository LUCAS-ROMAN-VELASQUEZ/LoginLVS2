<?php
// Suponiendo que los parámetros id_empleado y id_empresa están disponibles:
$empleado_id = $_GET['id_empleado'] ?? null;
$empresa_id = $_GET['id_empresa'] ?? null;

// Verificar que los parámetros estén presentes
if (is_numeric($empleado_id) && is_numeric($empresa_id)) {
    // Redirigir con los parámetros en la URL
    header("Location: ../php/forms/ver_firmas.php?id_empleado=$empleado_id&id_empresa=$empresa_id");
    exit();
} else {
    // Si los parámetros no están disponibles o no son válidos, puedes manejar el error
    die("❌ Error: No se han proporcionado parámetros válidos.");
}
?>