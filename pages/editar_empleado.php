<?php
require_once '../php/includes/conexion.php';  // Ruta desde "pages"
require_once '../php/includes/functions.php'; // Ruta desde "pages"
include '../php/includes/header.php'; // Incluir el header
$empleado_id = $_GET['id']; // Obtener el ID del empleado desde la URL

// Obtener los datos del empleado
$stmt = $conexion->prepare("SELECT * FROM Empleado WHERE id = ?");
$stmt->bind_param("i", $empleado_id);
$stmt->execute();
$empleado = $stmt->get_result()->fetch_assoc();
$stmt->close();

// Obtener las firmas del empleado
$stmt_firmas = $conexion->prepare("SELECT id_firma FROM Empleado_Firma WHERE id_empleado = ?");
$stmt_firmas->bind_param("i", $empleado_id);
$stmt_firmas->execute();
$firmas_asignadas = $stmt_firmas->get_result();
$firmas_asignadas_ids = [];
while ($firma = $firmas_asignadas->fetch_assoc()) {
    $firmas_asignadas_ids[] = $firma['id_firma'];
}
$stmt_firmas->close();

// Obtener todas las firmas disponibles
$firmas_disponibles = [];
$stmt_firmas_disponibles = $conexion->prepare("SELECT id, name FROM Firma WHERE id_empresa = ?");
$stmt_firmas_disponibles->bind_param("i", $empleado['id_empresa']);
$stmt_firmas_disponibles->execute();
$firmas_disponibles_result = $stmt_firmas_disponibles->get_result();
while ($firma = $firmas_disponibles_result->fetch_assoc()) {
    $firmas_disponibles[] = $firma;
}
$stmt_firmas_disponibles->close();

// Procesar formulario de edición
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Recoger datos del formulario
    $nombre_empleado = $_POST['nombre_empleado'];
    $apellidos = $_POST['apellidos'];
    $cargo = $_POST['cargo'];
    $departamento = $_POST['departamento'];
    $telefono_directo = $_POST['telefono_directo'];
    $telefono_movil = $_POST['telefono_movil'];
    $correo_empleado = $_POST['correo_empleado'];
    $firmas_seleccionadas = $_POST['firmas_seleccionadas']; // Firmas seleccionadas

    // Actualizar datos del empleado
    $stmt_update = $conexion->prepare("UPDATE Empleado SET name = ?, apellidos = ?, cargo = ?, departamento = ?, telefono_directo = ?, telefono_movil = ?, correo_electronico = ? WHERE id = ?");
    $stmt_update->bind_param("sssssssi", $nombre_empleado, $apellidos, $cargo, $departamento, $telefono_directo, $telefono_movil, $correo_empleado, $empleado_id);
    $stmt_update->execute();
    $stmt_update->close();

    // Actualizar las firmas (primero borrar las existentes)
    $stmt_delete_firmas = $conexion->prepare("DELETE FROM Empleado_Firma WHERE id_empleado = ?");
    $stmt_delete_firmas->bind_param("i", $empleado_id);
    $stmt_delete_firmas->execute();
    $stmt_delete_firmas->close();

    // Insertar las nuevas firmas seleccionadas
    if (!empty($firmas_seleccionadas)) {
        $stmt_insert_firmas = $conexion->prepare("INSERT INTO Empleado_Firma (id_empleado, id_firma) VALUES (?, ?)");
        foreach ($firmas_seleccionadas as $firma_id) {
            $stmt_insert_firmas->bind_param("ii", $empleado_id, $firma_id);
            $stmt_insert_firmas->execute();
        }
        $stmt_insert_firmas->close();
    }

    echo "<p style='color: green;'>✅ Empleado actualizado correctamente.</p>";
    echo '<a href="empleados.php?id=' . urlencode($empleado['id_empresa']) . '"><button>Volver al listado de empleados</button></a>';
    exit;
}
?>

<h2>Editar Empleado</h2>

<form action="editar_empleado.php?id=<?= $empleado_id ?>" method="POST">
    <label for="nombre_empleado">Nombre:</label>
    <input type="text" id="nombre_empleado" name="nombre_empleado" value="<?= htmlspecialchars($empleado['name']) ?>" required><br><br>

    <label for="apellidos">Apellidos:</label>
    <input type="text" id="apellidos" name="apellidos" value="<?= htmlspecialchars($empleado['apellidos']) ?>" required><br><br>

    <label for="cargo">Cargo:</label>
    <input type="text" id="cargo" name="cargo" value="<?= htmlspecialchars($empleado['cargo']) ?>" required><br><br>

    <label for="departamento">Departamento:</label>
    <input type="text" id="departamento" name="departamento" value="<?= htmlspecialchars($empleado['departamento']) ?>"><br><br>

    <label for="telefono_directo">Teléfono Directo:</label>
    <input type="text" id="telefono_directo" name="telefono_directo" value="<?= htmlspecialchars($empleado['telefono_directo']) ?>"><br><br>

    <label for="telefono_movil">Teléfono Móvil:</label>
    <input type="text" id="telefono_movil" name="telefono_movil" value="<?= htmlspecialchars($empleado['telefono_movil']) ?>"><br><br>

    <label for="correo_empleado">Correo Electrónico:</label>
    <input type="email" id="correo_empleado" name="correo_empleado" value="<?= htmlspecialchars($empleado['correo_electronico']) ?>" required><br><br>

    <label for="firmas_seleccionadas">Firmas que puede usar:</label><br>
    <select name="firmas_seleccionadas[]" id="firmas_seleccionadas" multiple size="5">
        <?php foreach ($firmas_disponibles as $firma): ?>
            <option value="<?= $firma['id'] ?>" <?= in_array($firma['id'], $firmas_asignadas_ids) ? 'selected' : '' ?>>
                <?= htmlspecialchars($firma['name']) ?>
            </option>
        <?php endforeach; ?>
    </select><br><br>

    <button type="submit">Actualizar Empleado</button>
</form>
