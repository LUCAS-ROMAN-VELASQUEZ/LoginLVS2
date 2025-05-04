<?php
require_once '../php/includes/conexion.php';  // Ruta desde "pages"
require_once '../php/includes/functions.php'; // Ruta desde "pages"
include '../php/includes/header.php'; // Incluir el header

// Eliminar firma si se recibe por GET
if (isset($_GET['eliminar']) && is_numeric($_GET['eliminar'])) {
    $id_firma = intval($_GET['eliminar']);
    $conexion->query("DELETE FROM Empleado_Firma WHERE id_firma = $id_firma"); // Elimina relación
    $conexion->query("DELETE FROM Firma WHERE id = $id_firma");
    echo "<p style='color:green;'>✅ Firma eliminada correctamente.</p>";
}

// Obtener firmas con empresa
$query = "
    SELECT f.id, f.name AS firma, e.name AS empresa 
    FROM Firma f 
    JOIN Empresa e ON f.id_empresa = e.id
    ORDER BY e.name ASC, f.name ASC
";
$resultado = $conexion->query($query);
?>

<h2>Gestión de Firmas</h2>

<!-- Botón para crear nueva firma -->
<a href="crear_firma.php" style="display:inline-block;margin-bottom:20px;padding:8px 16px;background-color:#007BFF;color:white;text-decoration:none;border-radius:4px;">➕ Crear Nueva Firma</a>

<!-- Lista de firmas -->
<table border="1" cellpadding="8" cellspacing="0">
    <thead>
        <tr>
            <th>Firma</th>
            <th>Empresa</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php if ($resultado->num_rows > 0): ?>
            <?php while ($row = $resultado->fetch_assoc()): ?>
                <tr>
                    <td><?= htmlspecialchars($row['firma']) ?></td>
                    <td><?= htmlspecialchars($row['empresa']) ?></td>
                    <td>
                        <a href="editar_firma.php?id=<?= $row['id'] ?>">✏️ Editar</a> |
                        <a href="firmas.php?eliminar=<?= $row['id'] ?>" onclick="return confirm('¿Seguro que quieres eliminar esta firma?')">🗑️ Eliminar</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr>
                <td colspan="3">No hay firmas registradas.</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>
<?php
include '../php/includes/footer.php'; // Incluir el footer
?>