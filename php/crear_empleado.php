<?php
require_once 'conexion.php';

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
        // Asegurar que la carpeta avatars existe
        if (!is_dir('avatars')) {
            mkdir('avatars', 0777, true);
        }

        $foto_avatar = null;

        if (isset($_FILES['foto_avatar']) && $_FILES['foto_avatar']['error'] == 0) {
            $ext = pathinfo($_FILES['foto_avatar']['name'], PATHINFO_EXTENSION);
            $foto_avatar = 'avatars/' . uniqid() . '.' . $ext;

            if (!move_uploaded_file($_FILES['foto_avatar']['tmp_name'], $foto_avatar)) {
                echo "Error al subir la imagen.<br>";
                $foto_avatar = null; // Para no bloquear el resto
            }
        }

        $stmt = $conexion->prepare("INSERT INTO Empleado (name, apellidos, cargo, departamento, telefono_directo, telefono_movil, correo_electronico, foto_avatar) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssssss", $nombre_empleado, $apellidos, $cargo, $departamento, $telefono_directo, $telefono_movil, $correo_empleado, $foto_avatar);
        $stmt->execute();

        $empleado_id = $stmt->insert_id;
        $stmt->close();

        $rol_id = 1;
        $contraseña = bin2hex(random_bytes(8)); // No se muestra

        $stmt_user = $conexion->prepare("INSERT INTO Usuario (correo, contraseña, id_rol, id_empleado, id_empresa) VALUES (?, ?, ?, ?, ?)");

        if (!$stmt_user) {
            die("Error en prepare de Usuario: " . $conexion->error);
        }

        $stmt_user->bind_param("ssiii", $correo_empleado, $contraseña, $rol_id, $empleado_id, $empresa_id);
        $stmt_user->execute();
        $stmt_user->close();

        echo "Empleado y usuario creados correctamente.";
    } else {
        echo "Por favor, rellene todos los campos correctamente.";
    }
}

// Obtener empresas
require_once 'conexion.php';
$empresas = [];

$sql = "SELECT id, name FROM Empresa";
$resultado = $conexion->query($sql);
if ($resultado && $resultado->num_rows > 0) {
    while ($fila = $resultado->fetch_assoc()) {
        $empresas[] = $fila;
    }
}
?>

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
        <?php foreach ($empresas as $empresa): ?>
            <option value="<?= $empresa['id'] ?>"><?= $empresa['name'] ?></option>
        <?php endforeach; ?>
    </select><br><br>

    <label for="foto_avatar">Foto de Avatar:</label>
    <input type="file" id="foto_avatar" name="foto_avatar" accept="image/*"><br><br>

    <button type="submit">Crear Empleado</button>
</form>

