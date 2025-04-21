<?php
require_once '../includes/conexion.php';  // Ruta desde forms/
require_once '../includes/functions.php'; // Ruta desde forms/

// Validar el formulario cuando se envía
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Recibimos los datos del formulario de la empresa
    $nombre_empresa = $_POST['nombre_empresa'];
    $direccion = $_POST['direccion'];
    $sitio_web = $_POST['sitio_web'];
    $correo_general = $_POST['correo_general'];
    $telefono_general = $_POST['telefono_general'];

    // Recibimos los datos de las redes sociales y el aviso legal
    $facebook = $_POST['facebook'];
    $instagram = $_POST['instagram'];
    $youtube = $_POST['youtube'];
    $x = $_POST['x'];
    $aviso_legal = $_POST['aviso_legal'];

    // Validar los campos de la empresa
    if (!empty($nombre_empresa) && !empty($direccion)) {
        $db = new DB();
        $conn = $db->getConnection();

        // Insertar la nueva empresa
        $stmt = $conn->prepare("INSERT INTO Empresa (name, direccion, sitio_web, correo_general, telefono_general, facebook, instagram, youtube, X, aviso_legal) 
                               VALUES (:nombre_empresa, :direccion, :sitio_web, :correo_general, :telefono_general, :facebook, :instagram, :youtube, :x, :aviso_legal)");
        $stmt->bindParam(':nombre_empresa', $nombre_empresa);
        $stmt->bindParam(':direccion', $direccion);
        $stmt->bindParam(':sitio_web', $sitio_web);
        $stmt->bindParam(':correo_general', $correo_general);
        $stmt->bindParam(':telefono_general', $telefono_general);
        $stmt->bindParam(':facebook', $facebook);
        $stmt->bindParam(':instagram', $instagram);
        $stmt->bindParam(':youtube', $youtube);
        $stmt->bindParam(':x', $x);
        $stmt->bindParam(':aviso_legal', $aviso_legal);
        $stmt->execute();

        echo "Empresa creada correctamente y redes sociales actualizadas.";
    } else {
        echo "Por favor, rellene todos los campos obligatorios de la empresa.";
    }
}
?>

<!-- Formulario para crear empresa y agregar redes sociales -->
<form action="crear_empresa.php" method="POST">
    <label for="nombre_empresa">Nombre de la Empresa:</label>
    <input type="text" id="nombre_empresa" name="nombre_empresa" required><br><br>

    <label for="direccion">Dirección:</label>
    <input type="text" id="direccion" name="direccion" required><br><br>

    <label for="sitio_web">Sitio Web:</label>
    <input type="text" id="sitio_web" name="sitio_web"><br><br>

    <label for="correo_general">Correo General:</label>
    <input type="email" id="correo_general" name="correo_general"><br><br>

    <label for="telefono_general">Teléfono General:</label>
    <input type="text" id="telefono_general" name="telefono_general"><br><br>

    <!-- Redes sociales -->
    <label for="facebook">Facebook:</label>
    <input type="url" id="facebook" name="facebook"><br><br>

    <label for="instagram">Instagram:</label>
    <input type="url" id="instagram" name="instagram"><br><br>

    <label for="youtube">YouTube:</label>
    <input type="url" id="youtube" name="youtube"><br><br>

    <label for="x">X:</label>
    <input type="url" id="x" name="x"><br><br>

    <!-- Aviso Legal -->
    <label for="aviso_legal">Aviso Legal:</label><br>
    <textarea id="aviso_legal" name="aviso_legal" rows="4" cols="50"></textarea><br><br>

    <button type="submit">Crear Empresa</button>
</form>
