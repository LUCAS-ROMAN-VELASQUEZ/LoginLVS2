<?php
require_once '../includes/conexion.php';
require_once '../includes/functions.php';

// Obtener lista de empresas
$empresas = [];
$sql = "SELECT id, name FROM Empresa";
$resultado = $conexion->query($sql);
if ($resultado && $resultado->num_rows > 0) {
    while ($fila = $resultado->fetch_assoc()) {
        $empresas[] = $fila;
    }
}

// Obtener empresa_id de la URL si viene
$empresa_id = isset($_GET['empresa_id']) && is_numeric($_GET['empresa_id']) ? $_GET['empresa_id'] : null;

// Procesar formulario
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre_empleado = $_POST['nombre_empleado'];
    $apellidos = $_POST['apellidos'];
    $cargo = $_POST['cargo'];
    $departamento = $_POST['departamento'];
    $telefono_directo = $_POST['telefono_directo'];
    $telefono_movil = $_POST['telefono_movil'];
    $correo_empleado = $_POST['correo_empleado'];
    $empresa_id = $_POST['empresa_id'];

    if (filter_var($correo_empleado, FILTER_VALIDATE_EMAIL) && !empty($empresa_id)) {
        if (!is_dir('avatars')) mkdir('avatars', 0777, true);
        $foto_avatar = null;

        if (isset($_FILES['foto_avatar']) && $_FILES['foto_avatar']['error'] == 0) {
            $ext = pathinfo($_FILES['foto_avatar']['name'], PATHINFO_EXTENSION);
            $foto_avatar = 'avatars/' . uniqid() . '.' . $ext;
            move_uploaded_file($_FILES['foto_avatar']['tmp_name'], $foto_avatar);
        }

        $stmt = $conexion->prepare("INSERT INTO Empleado (name, apellidos, cargo, departamento, telefono_directo, telefono_movil, correo_electronico, foto_avatar) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssssss", $nombre_empleado, $apellidos, $cargo, $departamento, $telefono_directo, $telefono_movil, $correo_empleado, $foto_avatar);
        $stmt->execute();
        $empleado_id = $stmt->insert_id;
        $stmt->close();

        $rol_id = 1;
        $contraseña = bin2hex(random_bytes(8)); // contraseña aleatoria

        $stmt_user = $conexion->prepare("INSERT INTO Usuario (correo, contraseña, id_rol, id_empleado, id_empresa) VALUES (?, ?, ?, ?, ?)");
        $stmt_user->bind_param("ssiii", $correo_empleado, $contraseña, $rol_id, $empleado_id, $empresa_id);
        $stmt_user->execute();
        $stmt_user->close();

        echo "<p style='color: green;'>✅ Empleado y usuario creados correctamente.</p>";
        echo '<a href="/loguin/pages/empleados.php?id=' . urlencode($empresa_id) . '">
                <button>Volver al listado de empleados</button>
              </a>';
        exit;
    } else {
        echo "<p style='color: red;'>❌ Por favor, rellene todos los campos correctamente.</p>";
    }
}
?>

<h2>Crear Nuevo Empleado</h2>

<form action="crear_empleado.php" method="POST" enctype="multipart/form-data">
    <label for="nombre_empleado">Nombre:</label>
    <input type="text" id="nombre_empleado" name="nombre_empleado" required><br><br>

    <label for="apellidos">Apellidos:</label>
    <input type="text" id="apellidos" name="apellidos" required><br><br>

    <label for="cargo">Cargo:</label>
    <input type="text" id="cargo" name="cargo" required><br><br>

    <label for="departamento">Departamento:</label>
    <input type="text" id="departamento" name="departamento"><br><br>

    <label for="telefono_directo">Teléfono Directo:</label>
    <input type="text" id="telefono_directo" name="telefono_directo"><br><br>

    <label for="telefono_movil">Teléfono Móvil:</label>
    <input type="text" id="telefono_movil" name="telefono_movil"><br><br>

    <label for="correo_empleado">Correo Electrónico:</label>
    <input type="email" id="correo_empleado" name="correo_empleado" required><br><br>

    <label for="empresa_id">Selecciona la Empresa:</label>
    <select name="empresa_id" id="empresa_id" required>
        <option value="">-- Elige una empresa --</option>
        <?php foreach ($empresas as $empresa): ?>
            <option value="<?= $empresa['id'] ?>" <?= ($empresa_id == $empresa['id']) ? 'selected' : '' ?>>
                <?= htmlspecialchars($empresa['name']) ?>
            </option>
        <?php endforeach; ?>
    </select><br><br>

    <label for="foto_avatar">Foto de Avatar:</label>
    <input type="file" id="foto_avatar" name="foto_avatar" accept="image/*"><br><br>

    <button type="submit">Crear Empleado</button>
</form>
