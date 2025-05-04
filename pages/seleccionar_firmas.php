<?php
session_start();
require_once '../php/includes/conexion.php';
require_once '../php/includes/functions.php';

// Obtener empresas
$empresas = [];
$sql = "SELECT id, name FROM Empresa";
$resultado = $conexion->query($sql);
if ($resultado && $resultado->num_rows > 0) {
    while ($fila = $resultado->fetch_assoc()) {
        $empresas[] = $fila;
    }
}

// Procesar formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $_SESSION['empleado_datos'] = [
        'nombre_empleado' => $_POST['nombre_empleado'],
        'apellidos' => $_POST['apellidos'],
        'cargo' => $_POST['cargo'],
        'departamento' => $_POST['departamento'],
        'telefono_directo' => $_POST['telefono_directo'],
        'telefono_movil' => $_POST['telefono_movil'],
        'correo_empleado' => $_POST['correo_empleado'],
        'empresa_id' => $_POST['empresa_id']
    ];

    // Procesar imagen
    if (isset($_FILES['foto_avatar']) && $_FILES['foto_avatar']['error'] == 0) {
        $archivo = $_FILES['foto_avatar'];
        $ext = strtolower(pathinfo($archivo['name'], PATHINFO_EXTENSION));
        $nombre_archivo = uniqid('avatar_', true) . '.' . $ext;
        $ruta_destino = 'C:/wamp64/www/loguin/php/avatars/' . $nombre_archivo;

        if (move_uploaded_file($archivo['tmp_name'], $ruta_destino)) {
            $_SESSION['empleado_datos']['foto_avatar'] = $nombre_archivo;
        }
    }

    header("Location: http://localhost/loguin/pages/seleccionar_firmas.php?empresa_id=" . urlencode($_POST['empresa_id']));
    exit;
}
?>

<h2>Crear Nuevo Empleado</h2>
<form action="" method="POST" enctype="multipart/form-data">
    <label>Nombre:</label>
    <input type="text" name="nombre_empleado" required><br><br>

    <label>Apellidos:</label>
    <input type="text" name="apellidos" required><br><br>

    <label>Cargo:</label>
    <input type="text" name="cargo" required><br><br>

    <label>Departamento:</label>
    <input type="text" name="departamento"><br><br>

    <label>Teléfono Directo:</label>
    <input type="text" name="telefono_directo"><br><br>

    <label>Teléfono Móvil:</label>
    <input type="text" name="telefono_movil"><br><br>

    <label>Correo Electrónico:</label>
    <input type="email" name="correo_empleado" required><br><br>

    <label>Foto de Avatar:</label>
    <input type="file" name="foto_avatar" accept="image/*"><br><br>

    <label>Selecciona la Empresa:</label>
    <select name="empresa_id" required>
        <option value="">-- Elige una empresa --</option>
        <?php foreach ($empresas as $empresa): ?>
            <option value="<?= $empresa['id'] ?>"><?= htmlspecialchars($empresa['name']) ?></option>
        <?php endforeach; ?>
    </select><br><br>

    <button type="submit">Seleccionar Firmas</button>
</form>
