<?php
require_once '../php/includes/conexion.php';
require_once '../php/includes/functions.php';
include '../php/includes/header.php';

// Comprobar si se pasa ID de empresa
$id_empresa = isset($_GET['id']) && is_numeric($_GET['id']) ? $_GET['id'] : null;

// Título dinámico
if ($id_empresa) {
    echo "<h2>Empleados de la Empresa ID " . htmlspecialchars($id_empresa) . "</h2>";
} else {
    echo "<h2>Todos los Empleados de Todas las Empresas</h2>";
}

// Botón para crear empleado (con o sin empresa seleccionada)
$crear_url = $id_empresa 
    ? "/loguin/pages/crear_empleado.php?empresa_id=" . urlencode($id_empresa)
    : "/loguin/pages/crear_empleado.php";

echo '<a href="' . $crear_url . '"><button>Crear Empleado</button></a><br><br>';

// Consulta
if ($id_empresa) {
    $stmt = $conexion->prepare("SELECT e.id, e.name, e.apellidos, e.cargo, u.correo 
                                FROM Empleado e 
                                JOIN Usuario u ON e.id = u.id_empleado 
                                WHERE u.id_empresa = ?");
    $stmt->bind_param("i", $id_empresa);
    $stmt->execute();
    $resultado = $stmt->get_result();
} else {
    $resultado = $conexion->query("SELECT e.id, e.name, e.apellidos, e.cargo, u.correo, u.id_empresa 
                                   FROM Empleado e 
                                   JOIN Usuario u ON e.id = u.id_empleado");
}
?>

<ul>
<?php while ($row = $resultado->fetch_assoc()): ?>
    <li>
        <?= htmlspecialchars($row['name'] . ' ' . $row['apellidos']) ?> - 
        <?= htmlspecialchars($row['cargo']) ?> - 
        <?= htmlspecialchars($row['correo']) ?>
        <?php if (!$id_empresa): ?>
            (Empresa ID: <?= htmlspecialchars($row['id_empresa']) ?>)
        <?php endif; ?>
        <button>Enviar solicitud de info</button>
    </li>
<?php endwhile; ?>
</ul>

<?php
if (isset($stmt)) $stmt->close();
include '../php/includes/footer.php';
?>
