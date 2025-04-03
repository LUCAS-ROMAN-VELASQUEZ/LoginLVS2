<?php
require_once 'conexion.php';

// Obtener el id de la empresa desde la URL
$id_empresa = $_GET['id'];

// Consulta para obtener los empleados de la empresa seleccionada
$stmt = $conexion->prepare("SELECT e.id, e.name, e.apellidos, e.cargo, u.correo 
                            FROM Empleado e 
                            JOIN Usuario u ON e.id = u.id_empleado 
                            WHERE u.id_empresa = ?");
$stmt->bind_param("i", $id_empresa); // Vincula el parámetro id_empresa
$stmt->execute();
$resultado = $stmt->get_result();

?>

<h2>Listado de Empleados de la Empresa ID <?= $id_empresa ?></h2>

<!-- Botón para crear nuevo empleado -->
<a href="crear_empleado.php?empresa_id=<?= $id_empresa ?>"><button>Crear Empleado</button></a><br><br>

<!-- Listado de empleados -->
<ul>
<?php while ($row = $resultado->fetch_assoc()): ?>
    <li>
        <?= $row['name'] . ' ' . $row['apellidos'] ?> - <?= $row['cargo'] ?> - <?= $row['correo'] ?>
        <!-- Botón para enviar solicitud de info (aún no implementado) -->
        <button>Enviar solicitud de info</button>
    </li>
<?php endwhile; ?>
</ul>

<?php
// Cerrar la conexión
$stmt->close();
?>
