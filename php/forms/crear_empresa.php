<?php
require_once '../includes/conexion.php';
require_once '../includes/functions.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['nombre_empresa'])) {
    $nombre_empresa = trim($_POST['nombre_empresa']);
    $direccion = $_POST['direccion'];
    $sitio_web = $_POST['sitio_web'];
    $correo_general = $_POST['correo_general'];
    $telefono_general = $_POST['telefono_general'];
    $facebook = $_POST['facebook'];
    $instagram = $_POST['instagram'];
    $youtube = $_POST['youtube'];
    $x = $_POST['x'];
    $aviso_legal = $_POST['aviso_legal'];

    // Crear carpeta para la empresa
    $nombre_carpeta = preg_replace('/[^A-Za-z0-9_\-]/', '_', strtolower($nombre_empresa));
    $ruta_base = '../php/empresas/' . $nombre_carpeta . '/';
    if (!is_dir($ruta_base)) {
        mkdir($ruta_base, 0777, true);
    }

    // Procesar logo
    $ruta_logo = null;
    $logo_filename = null;
    if (isset($_FILES['logo_empresa']) && $_FILES['logo_empresa']['error'] === 0) {
        $ext_logo = strtolower(pathinfo($_FILES['logo_empresa']['name'], PATHINFO_EXTENSION));
        $logo_filename = 'logo.' . $ext_logo;
        $destino_logo = $ruta_base . $logo_filename;
        if (move_uploaded_file($_FILES['logo_empresa']['tmp_name'], $destino_logo)) {
            $ruta_logo = 'php/empresas/' . $nombre_carpeta . '/' . $logo_filename;
        } else {
            echo "<p style='color: red;'>❌ Error al subir el logo.</p>";
        }
    }

    // Procesar plantilla (opcional)
    $template_filename = null;
    if (isset($_FILES['template_firma']) && $_FILES['template_firma']['error'] === 0) {
        $ext_tpl = strtolower(pathinfo($_FILES['template_firma']['name'], PATHINFO_EXTENSION));
        $template_filename = 'template.' . $ext_tpl;
        $destino_tpl = $ruta_base . $template_filename;
        if (!move_uploaded_file($_FILES['template_firma']['tmp_name'], $destino_tpl)) {
            echo "<p style='color: red;'>❌ Error al subir la plantilla.</p>";
            $template_filename = null;
        }
    }

    // Validar y guardar
    if (!empty($nombre_empresa) && !empty($direccion)) {
        $stmt = $conexion->prepare("INSERT INTO Empresa (
            name, logo, direccion, sitio_web, correo_general,
            telefono_general, X, facebook, instagram, youtube,
            aviso_legal, template_filename, logo_filename
        ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

        $stmt->bind_param("sssssssssssss",
            $nombre_empresa,
            $ruta_logo,
            $direccion,
            $sitio_web,
            $correo_general,
            $telefono_general,
            $x,
            $facebook,
            $instagram,
            $youtube,
            $aviso_legal,
            $template_filename,
            $logo_filename
        );

        $stmt->execute();
        $stmt->close();

        echo "<p style='color: green;'>✅ Empresa creada correctamente.</p>";
        if ($ruta_logo) {
            echo "<p>Logo subido:</p>";
            echo "<img src='../$ruta_logo' style='max-width:150px;border-radius:8px;'>";
        }
        echo '<br><a href="empresas.php">Volver al listado de empresas</a>';
        exit;
    } else {
        echo "<p style='color: red;'>❌ Rellena al menos nombre y dirección.</p>";
    }
}
?>

<h2>Crear Nueva Empresa</h2>
<form action="" method="POST" enctype="multipart/form-data">
    <label>Nombre de la Empresa:</label>
    <input type="text" name="nombre_empresa" required><br><br>

    <label>Dirección:</label>
    <input type="text" name="direccion" required><br><br>

    <label>Sitio Web:</label>
    <input type="text" name="sitio_web"><br><br>

    <label>Correo General:</label>
    <input type="email" name="correo_general"><br><br>

    <label>Teléfono General:</label>
    <input type="text" name="telefono_general"><br><br>

    <label>Logo (imagen):</label>
    <input type="file" name="logo_empresa" accept="image/*"><br><br>

    <label>Plantilla de Firma (opcional):</label>
    <input type="file" name="template_firma" accept=".php,.html,.htm"><br><br>

    <!-- Redes sociales -->
    <label>Facebook:</label>
    <input type="url" name="facebook"><br><br>

    <label>Instagram:</label>
    <input type="url" name="instagram"><br><br>

    <label>YouTube:</label>
    <input type="url" name="youtube"><br><br>

    <label>X:</label>
    <input type="url" name="x"><br><br>

    <!-- Aviso Legal -->
    <label>Aviso Legal:</label><br>
    <textarea name="aviso_legal" rows="4" cols="50"></textarea><br><br>

    <button type="submit">Crear Empresa</button>
</form>
