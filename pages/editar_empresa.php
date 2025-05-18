<?php
require_once '../php/includes/conexion.php';
require_once '../php/includes/functions.php';
include '../php/includes/header.php';

$empresa_id = $_GET['id'];

// Obtener datos actuales de la empresa
$stmt = $conexion->prepare("SELECT * FROM Empresa WHERE id = ?");
$stmt->bind_param("i", $empresa_id);
$stmt->execute();
$empresa = $stmt->get_result()->fetch_assoc();
$stmt->close();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre_empresa = $_POST['nombre_empresa'];
    $direccion = $_POST['direccion'];
    $sitio_web = $_POST['sitio_web'];
    $correo_general = $_POST['correo_general'];
    $telefono_general = $_POST['telefono_general'];

    // Carpeta de empresa
    $nombre_carpeta = preg_replace('/[^A-Za-z0-9_\-]/', '_', strtolower($nombre_empresa));
    $carpeta_empresa = '../php/empresas/' . $nombre_carpeta . '/';
    if (!is_dir($carpeta_empresa)) {
        mkdir($carpeta_empresa, 0777, true);
    }

    // Logo
    $ruta_logo = $empresa['logo'];
    $logo_filename = $empresa['logo_filename'];
    if (isset($_FILES['logo_empresa']) && $_FILES['logo_empresa']['error'] === 0) {
        $ext_logo = strtolower(pathinfo($_FILES['logo_empresa']['name'], PATHINFO_EXTENSION));
        $logo_filename = 'logo.' . $ext_logo;
        $ruta_logo = 'php/empresas/' . $nombre_carpeta . '/' . $logo_filename;
        move_uploaded_file($_FILES['logo_empresa']['tmp_name'], '../' . $ruta_logo);
    }

    // Plantilla
    $template_filename = $empresa['template_filename'];
    if (isset($_FILES['template_firma']) && $_FILES['template_firma']['error'] === 0) {
        $ext_tpl = strtolower(pathinfo($_FILES['template_firma']['name'], PATHINFO_EXTENSION));
        $template_filename = 'template.' . $ext_tpl;
        $destino_tpl = $carpeta_empresa . $template_filename;
        move_uploaded_file($_FILES['template_firma']['tmp_name'], $destino_tpl);
    }

    // Actualizar en base de datos
    $stmt_update = $conexion->prepare("UPDATE Empresa 
        SET name = ?, direccion = ?, sitio_web = ?, correo_general = ?, telefono_general = ?, logo = ?, logo_filename = ?, template_filename = ?
        WHERE id = ?");
    $stmt_update->bind_param("ssssssssi", $nombre_empresa, $direccion, $sitio_web, $correo_general, $telefono_general, $ruta_logo, $logo_filename, $template_filename, $empresa_id);
    $stmt_update->execute();
    $stmt_update->close();

    echo "<p style='color: green;'>✅ Empresa actualizada correctamente.</p>";
    echo '<a href="empresas.php"><button>Volver al listado de empresas</button></a>';
    exit;
}
?>


<h2>Editar Empresa</h2>

<form action="editar_empresa.php?id=<?= $empresa_id ?>" method="POST" enctype="multipart/form-data">
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

    <label for="logo_empresa">Actualizar Logo:</label>
    <input type="file" name="logo_empresa" id="logo_empresa" accept="image/*"><br><br>

    <label for="template_firma">Actualizar Plantilla de Firma:</label>
    <input type="file" name="template_firma" id="template_firma" accept=".php,.html,.htm"><br><br>

    <button type="submit">Actualizar Empresa</button>
</form>
