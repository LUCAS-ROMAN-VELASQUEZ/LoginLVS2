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

// Procesar formulario
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['nombre_empleado'])) {
    $nombre_empleado = $_POST['nombre_empleado'];
    $apellidos = $_POST['apellidos'];
    $cargo = $_POST['cargo'];
    $departamento = $_POST['departamento'];
    $telefono_directo = $_POST['telefono_directo'];
    $telefono_movil = $_POST['telefono_movil'];
    $correo_empleado = $_POST['correo_empleado'];
    $empresa_id = $_POST['empresa_id'];
    $firmas_seleccionadas = isset($_POST['firmas_seleccionadas']) ? $_POST['firmas_seleccionadas'] : [];

    // Procesar imagen
    $nombre_foto = null;
    $max_size = 2 * 1024 * 1024;
    $extensiones_permitidas = ['jpg', 'jpeg', 'png', 'gif'];

    if (isset($_FILES['foto_avatar']) && $_FILES['foto_avatar']['error'] == 0) {
        $archivo = $_FILES['foto_avatar'];
        $ext = strtolower(pathinfo($archivo['name'], PATHINFO_EXTENSION));

        if (in_array($ext, $extensiones_permitidas) && $archivo['size'] <= $max_size) {
            $nombre_archivo = uniqid('avatar_', true) . '.' . $ext;
            $ruta_destino = 'C:/wamp64/www/loguin/php/avatars/' . $nombre_archivo;

            if (move_uploaded_file($archivo['tmp_name'], $ruta_destino)) {
                $nombre_foto = $nombre_archivo;
            } else {
                echo "<p style='color: red;'>❌ Error al subir la imagen.</p>";
            }
        } else {
            echo "<p style='color: red;'>❌ Solo se permiten imágenes JPG, PNG, GIF y hasta 2MB.</p>";
        }
    }

    if (filter_var($correo_empleado, FILTER_VALIDATE_EMAIL) && !empty($empresa_id)) {
        $stmt = $conexion->prepare("INSERT INTO Empleado (name, apellidos, cargo, departamento, telefono_directo, telefono_movil, correo_electronico, foto_avatar) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssssss", $nombre_empleado, $apellidos, $cargo, $departamento, $telefono_directo, $telefono_movil, $correo_empleado, $nombre_foto);
        $stmt->execute();
        $empleado_id = $stmt->insert_id;
        $stmt->close();

        $rol_id = 1;
        $contraseña = bin2hex(random_bytes(8));

        $stmt_user = $conexion->prepare("INSERT INTO Usuario (correo, contraseña, id_rol, id_empleado, id_empresa) VALUES (?, ?, ?, ?, ?)");
        $stmt_user->bind_param("ssiii", $correo_empleado, $contraseña, $rol_id, $empleado_id, $empresa_id);
        $stmt_user->execute();
        $stmt_user->close();

        if (!empty($firmas_seleccionadas)) {
            $stmt_insert_firmas = $conexion->prepare("INSERT INTO Empleado_Firma (id_empleado, id_firma) VALUES (?, ?)");
            foreach ($firmas_seleccionadas as $firma_id) {
                $stmt_insert_firmas->bind_param("ii", $empleado_id, $firma_id);
                $stmt_insert_firmas->execute();
            }
            $stmt_insert_firmas->close();
        }

        echo "<p style='color: green;'>✅ Empleado creado correctamente.</p>";
        if ($nombre_foto) {
            echo "<p>Avatar subido:</p>";
            echo "<img src='../php/avatars/$nombre_foto' style='max-width:150px;border-radius:8px;'>";
        }
        echo '<br><a href="empleados.php">Volver al listado de empleados</a>';
        exit;
    } else {
        echo "<p style='color: red;'>❌ Por favor, rellene todos los campos correctamente.</p>";
    }
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
    <select name="empresa_id" id="empresa_id" required>
        <option value="">-- Elige una empresa --</option>
        <?php foreach ($empresas as $empresa): ?>
            <option value="<?= $empresa['id'] ?>"><?= htmlspecialchars($empresa['name']) ?></option>
        <?php endforeach; ?>
    </select><br><br>

    <div id="contenedor_firmas" style="display: none;">
        <label>Firmas Disponibles:</label>
        <select name="firmas_seleccionadas[]" id="firmas_seleccionadas" multiple size="6"></select><br><br>
    </div>

    <button type="submit">Crear Empleado</button>
</form>

<script>
document.getElementById("empresa_id").addEventListener("change", function () {
    const empresaId = this.value;
    console.log(empresaId);

    if (empresaId) {
        fetch("http://localhost/loguin/php/ajax/obtener_firmas.php", {
            
            method: "POST",
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify({ empresa_id: empresaId })
        })
        .then(res => res.json())
        .then(data => {
            const firmasSelect = document.getElementById("firmas_seleccionadas");
            firmasSelect.innerHTML = "";
            if (data.length > 0) {
                data.forEach(firma => {
                    const option = document.createElement("option");
                    option.value = firma.id;
                    option.textContent = firma.name;
                    firmasSelect.appendChild(option);
                });
                document.getElementById("contenedor_firmas").style.display = "block";
            } else {
                document.getElementById("contenedor_firmas").style.display = "none";
            }
        });
    } else {
        document.getElementById("contenedor_firmas").style.display = "none";
    }
});
</script>
