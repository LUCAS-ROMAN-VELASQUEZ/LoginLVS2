<?php
// empleados.php
require_once '../php/includes/conexion.php';
include '../php/includes/header.php';

$id_empresa = isset($_GET['id']) && is_numeric($_GET['id']) ? $_GET['id'] : null;

if ($id_empresa) {
    $stmt = $conexion->prepare("SELECT e.*, u.id_empresa FROM Empleado e JOIN Usuario u ON e.id = u.id_empleado WHERE u.id_empresa = ?");
    $stmt->bind_param("i", $id_empresa);
    $stmt->execute();
    $resultado = $stmt->get_result();
} else {
    $resultado = $conexion->query("SELECT e.*, u.id_empresa FROM Empleado e JOIN Usuario u ON e.id = u.id_empleado");
}
?>

<h2><?= $id_empresa ? 'Empleados de la Empresa ID ' . htmlspecialchars($id_empresa) : 'Todos los Empleados de Todas las Empresas' ?></h2>

<a href="<?= $id_empresa ? 'crear_empleado.php?empresa_id=' . $id_empresa : 'crear_empleado.php' ?>" style="display:inline-block;margin-bottom:20px;padding:8px 16px;background-color:#007BFF;color:white;text-decoration:none;border-radius:4px;">➕ Crear Empleado</a>

<table border="1" cellpadding="8" cellspacing="0">
    <thead>
        <tr>
            <th>Nombre</th>
            <th>Apellidos</th>
            <th>Cargo</th>
            <th>Departamento</th>
            <th>Tel. Directo</th>
            <th>Tel. Móvil</th>
            <th>Correo</th>
            <th>Avatar</th>
            <th>Empresa ID</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($row = $resultado->fetch_assoc()): ?>
            <tr>
                <td><?= htmlspecialchars($row['name']) ?></td>
                <td><?= htmlspecialchars($row['apellidos']) ?></td>
                <td><?= htmlspecialchars($row['cargo']) ?></td>
                <td><?= htmlspecialchars($row['departamento']) ?></td>
                <td><?= htmlspecialchars($row['telefono_directo']) ?></td>
                <td><?= htmlspecialchars($row['telefono_movil']) ?></td>
                <td><?= htmlspecialchars($row['correo_electronico']) ?></td>
                <td>
                    <?php if (!empty($row['foto_avatar'])): ?>
                        <img src="../php/avatars/<?= htmlspecialchars($row['foto_avatar']) ?>" alt="Avatar" width="40" height="40" style="border-radius:50%;">
                    <?php else: ?>
                        —
                    <?php endif; ?>
                </td>
                <td><?= htmlspecialchars($row['id_empresa']) ?></td>
                <td>
                    <a href="ver_firmas.php?empleado_id=<?= $row['id'] ?>&empresa_id=<?= $row['id_empresa'] ?>">👁️ Firmas</a> |
                    <a href="editar_empleado.php?id=<?= $row['id'] ?>">✏️ Editar</a>
                </td>
            </tr>
        <?php endwhile; ?>
    </tbody>
</table>

<?php include '../php/includes/footer.php'; ?>
