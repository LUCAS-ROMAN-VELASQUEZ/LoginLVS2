<?php
require_once '../includes/conexion.php';
require_once '../includes/functions.php';
include '../includes/header.php';

// Obtener los parámetros de la URL
$empleado_id = $_GET['id_empleado'] ?? null;
$empresa_id = $_GET['id_empresa'] ?? null;

// Validación de los parámetros
if (!is_numeric($empleado_id) || !is_numeric($empresa_id)) {
    die("<p class='error'>❌ Error: IDs de empleado o empresa no válidos</p>");
}

$empleado_id = (int)$empleado_id;
$empresa_id = (int)$empresa_id;

// Verificar relación empleado-empresa (opcional, dependiendo de tu lógica)
$stmt_check = $conexion->prepare("SELECT 1 FROM Usuario WHERE id_empleado = ? AND id_empresa = ?");
$stmt_check->bind_param("ii", $empleado_id, $empresa_id);
$stmt_check->execute();
if ($stmt_check->get_result()->num_rows === 0) {
    die("<p class='error'>❌ Error: El empleado no pertenece a esta empresa</p>");
}
$stmt_check->close();

// Obtener datos del empleado
$stmt_empleado = $conexion->prepare("SELECT name, apellidos FROM Empleado WHERE id = ?");
$stmt_empleado->bind_param("i", $empleado_id);
$stmt_empleado->execute();
$empleado = $stmt_empleado->get_result()->fetch_assoc();
$stmt_empleado->close();

// Obtener las firmas del empleado
$stmt_firmas = $conexion->prepare("
    SELECT f.id, f.name
    FROM Firma f
    INNER JOIN Empleado_Firma ef ON ef.id_firma = f.id
    INNER JOIN Usuario u ON ef.id_empleado = u.id_empleado
    WHERE u.id_empresa = ? AND ef.id_empleado = ?
");
$stmt_firmas->bind_param("ii", $empresa_id, $empleado_id);
$stmt_firmas->execute();
$firmas = $stmt_firmas->get_result();
?>

<h2>Firmas de <?= htmlspecialchars($empleado['name'] . ' ' . $empleado['apellidos']) ?></h2>

<?php if ($firmas->num_rows > 0): ?>
    <div class="firmas-container">
    <?php while ($firma = $firmas->fetch_assoc()): ?>
        <div class="firma-item">
            <h3>
            <a href="/loguin/pages/firmas/generar_firma.php?id_empleado=<?= $empleado_id ?>&id_firma=<?= $firma['id'] ?>&id_empresa=<?= $empresa_id ?>" target="_blank">

                    <?= htmlspecialchars($firma['name']) ?>
                </a>
            </h3>
        </div>
    <?php endwhile; ?>
</div>

<?php else: ?>
    <p class="aviso">⚠️ Este empleado no tiene firmas asociadas.</p>
<?php endif; ?>

<?php include '../includes/footer.php'; ?>
