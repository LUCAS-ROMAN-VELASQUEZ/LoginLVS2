<?php
require_once '../includes/conexion.php';  // Ruta desde "pages"
require_once '../includes/functions.php'; // Ruta desde "pages"
include '../includes/header.php'; // Incluir el header

// Obtener el ID de la empresa y empleado desde la URL
$empleado_id = isset($_GET['empleado_id']) && is_numeric($_GET['empleado_id']) ? $_GET['empleado_id'] : null;
$empresa_id = isset($_GET['empresa_id']) && is_numeric($_GET['empresa_id']) ? $_GET['empresa_id'] : null;

// Validación de datos
if ($empleado_id && $empresa_id) {
    // Obtener los datos del empleado
    $stmt_empleado = $conexion->prepare("SELECT name, apellidos FROM Empleado WHERE id = ?");
    $stmt_empleado->bind_param("i", $empleado_id);
    $stmt_empleado->execute();
    $resultado_empleado = $stmt_empleado->get_result();
    $empleado = $resultado_empleado->fetch_assoc();
    $stmt_empleado->close();

    // Obtener las firmas disponibles para la empresa
    $stmt_firmas = $conexion->prepare("SELECT * FROM Firma WHERE id_empresa = ?");
    $stmt_firmas->bind_param("i", $empresa_id);
    $stmt_firmas->execute();
    $resultado_firmas = $stmt_firmas->get_result();
    ?>

    <h2>Firmas Disponibles para <?= htmlspecialchars($empleado['name'] . ' ' . $empleado['apellidos']) ?> en la Empresa</h2>

    <ul>
    <?php while ($firma = $resultado_firmas->fetch_assoc()): ?>
        <li>
            <?= htmlspecialchars($firma['name']) ?>
            <a href="firma_detalle.php?id=<?= $firma['id'] ?>"><button>Ver Firma</button></a>
        </li>
    <?php endwhile; ?>
    </ul>

    <?php
    $stmt_firmas->close();
} else {
    echo "<p>⚠️ No se ha especificado un empleado o empresa válida.</p>";
}

include '../php/includes/footer.php'; // Incluir el footer
?>
