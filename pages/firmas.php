<?php
require_once '../php/includes/conexion.php';
require_once '../php/includes/functions.php';
include '../php/includes/header.php';

$id_empresa = isset($_GET['id']) && is_numeric($_GET['id']) ? $_GET['id'] : null;
?>

<h2>Listado de Firmas</h2>

<!-- Botón para crear firma -->
<a href="crear_firma.php<?= $id_empresa ? '?empresa_id=' . urlencode($id_empresa) : '' ?>">
    <button>Crear Firma</button>
</a><br><br>

<?php
if ($id_empresa) {
    echo "<p>Mostrando firmas de la empresa ID: <strong>$id_empresa</strong></p>";

    $stmt = $conexion->prepare("SELECT * FROM Firma WHERE id_empresa = ?");
    $stmt->bind_param("i", $id_empresa);
    $stmt->execute();
    $resultado = $stmt->get_result();
} else {
    echo "<p>Mostrando firmas de todas las empresas.</p>";

    $resultado = $conexion->query("SELECT * FROM Firma");
}
?>

<?php if ($resultado && $resultado->num_rows > 0): ?>
    <ul>
        <?php while ($row = $resultado->fetch_assoc()): ?>
            <li>
                <?= htmlspecialchars($row['name']) ?>
                (Empresa ID: <?= $row['id_empresa'] ?>)
            </li>
        <?php endwhile; ?>
    </ul>
<?php else: ?>
    <p style="color: gray;">No hay firmas registradas.</p>
<?php endif; ?>

<?php
if (isset($stmt)) $stmt->close();
include '../php/includes/footer.php';
?>
