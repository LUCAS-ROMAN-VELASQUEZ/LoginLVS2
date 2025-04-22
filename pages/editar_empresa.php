<?php
require_once '../php/includes/conexion.php';  // Ruta desde "pages"
require_once '../php/includes/functions.php'; // Ruta desde "pages"
include '../php/includes/header.php'; // Incluir el header

$empresa_id = $_GET['id']; // Obtener el ID de la empresa desde la URL

// Obtener los datos de la empresa
$stmt = $conexion->prepare("SELECT * FROM Empresa WHERE id = ?");
$stmt->bind_param("i", $empresa_id);
$stmt->execute();
$empresa = $stmt->get_result()->fetch_assoc();
$stmt->close();

// Procesar formulario de edición
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre_empresa = $_POST['nombre_empresa'];
    $direccion = $_POST['direccion'];
    $sitio_web = $_POST['sitio_web'];
    $correo_general = $_POST['correo_general'];
    $telefono_general = $_POST['telefono_general'];

    // Actualizar datos de la empresa
    $stmt_update = $conexion->prepare("UPDATE Empresa SET name = ?, direccion = ?, sitio_web = ?, correo_general = ?, telefono_general = ? WHERE id = ?");
    $stmt_update->bind_param("sssssi", $nombre_empresa, $direccion, $sitio_web, $correo_general, $telefono_general, $empresa_id);
    $stmt_update->execute();
    $stmt_update->close();

    echo "<p style='color: green;'>✅ Empresa actualizada correctamente.</p>";
    echo '<a href="empresas.php"><button>Volver al listado de empresas</button></a>';
    exit;
}
?>

<h2>Editar Empresa</h2>

<form action="editar_empresa.php?id=<?= $empresa_id ?>" method="POST">
    <label for="nombre_empresa">Nombre de la Empresa:</label>
    <input type="text" id="nombre_empresa" name="nombre_empresa" value="<?= htmlspecialchars($empresa['name']) ?>" required><br><br>

    <label for="direccion">Dirección:</label>
    <input type="text" id="direccion" name="direccion" value="<?= htmlspecialchars($empresa['direccion']) ?>" required><br><br>

    <label for="sitio_web">Sitio Web:</label>
    <input type="text" id="sitio_web" name="sitio_web" value="<?= htmlspecialchars($empresa['sitio_web']) ?>"><br><br>

    <label for="correo_general">Correo General:</label>
    <input type="email" id="correo_general" name="correo_general" value="<?= htmlspecialchars($empresa['correo_general']) ?>"><br><br>

    <label for="telefono_general">Teléfono General:</label>
    <input type="text" id="telefono_general" name="telefono_general" value="<?= htmlspecialchars($empresa['telefono_general']) ?>"><br><br>

    <button type="submit">Actualizar Empresa</button>
</form>
