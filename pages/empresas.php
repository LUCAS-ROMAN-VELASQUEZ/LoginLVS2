<?php
require_once '../php/includes/conexion.php';
include '../php/includes/header.php';

$resultado = $conexion->query("SELECT * FROM Empresa");
?>

<h2>Gestión de Empresas</h2>

<a href="crear_empresa.php" style="display:inline-block;margin-bottom:20px;padding:8px 16px;background-color:#007BFF;color:white;text-decoration:none;border-radius:4px;">➕ Crear Nueva Empresa</a>

<table border="1" cellpadding="8" cellspacing="0">
    <thead>
        <tr>
            <th>Nombre</th>
            <th>Dirección</th>
            <th>Sitio Web</th>
            <th>Correo</th>
            <th>Teléfono</th>
            <th>Facebook</th>
            <th>Instagram</th>
            <th>YouTube</th>
            <th>Aviso Legal</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($row = $resultado->fetch_assoc()): ?>
            <tr>
                <td><?= htmlspecialchars($row['name']) ?></td>
                <td><?= htmlspecialchars($row['direccion']) ?></td>
                <td><a href="<?= htmlspecialchars($row['sitio_web']) ?>" target="_blank"><?= htmlspecialchars($row['sitio_web']) ?></a></td>
                <td><?= htmlspecialchars($row['correo_general']) ?></td>
                <td><?= htmlspecialchars($row['telefono_general']) ?></td>
                <td><?= $row['facebook'] ?? '—' ?></td>
                <td><?= $row['instagram'] ?? '—' ?></td>
                <td><?= $row['youtube'] ?? '—' ?></td>
                <td><?= $row['aviso_legal'] ?? '—' ?></td>
                <td>
                    <a href="empresa_panel.php?id=<?= $row['id'] ?>">📋 Ver Detalles</a> |
                    <a href="editar_empresa.php?id=<?= $row['id'] ?>">✏️ Editar</a>
                </td>
            </tr>
        <?php endwhile; ?>
    </tbody>
</table>

<?php include '../php/includes/footer.php'; ?>
