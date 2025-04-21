<?php
require_once '../php/includes/conexion.php';  // Ruta desde "pages"
require_once '../php/includes/functions.php'; // Ruta desde "pages"
include '../php/includes/header.php'; // Incluir el header

$resultado = $conexion->query("SELECT * FROM Empresa");
?>

<h2>Empresas</h2>
<a href="crear_empresa.php">Crear nueva empresa</a><br><br>

<ul>
<?php while ($row = $resultado->fetch_assoc()): ?>
    <li>
        <?= htmlspecialchars($row['name']) ?>
        <!-- Enlace para ver empleados directamente -->
        | <a href="empleados.php?id=<?= urlencode($row['id']) ?>">Ver empleados</a>
        <!-- Opcional: puedes mantener el enlace al panel si lo necesitas -->
        | <a href="empresa_panel.php?id=<?= urlencode($row['id']) ?>">Detalles</a>
    </li>
<?php endwhile; ?>
</ul>

<?php
include '../php/includes/footer.php'; // Incluir el footer
?>
