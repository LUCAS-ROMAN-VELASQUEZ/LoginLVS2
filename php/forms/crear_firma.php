<?php
require_once '../includes/conexion.php';
require_once '../includes/functions.php';

// Obtener lista de empresas para el <select>
$empresas = [];
$sql = "SELECT id, name FROM Empresa";
$resultado = $conexion->query($sql);
if ($resultado && $resultado->num_rows > 0) {
    while ($fila = $resultado->fetch_assoc()) {
        $empresas[] = $fila;
    }
}

// Obtener empresa_id desde la URL (si viene)
$empresa_id = isset($_GET['empresa_id']) && is_numeric($_GET['empresa_id']) ? $_GET['empresa_id'] : null;

// Si se ha enviado el formulario
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre_firma = $_POST['nombre_firma'];
    $empresa_id = $_POST['empresa_id']; // ID de la empresa seleccionada
    $variable1 = $_POST['variable1'];
    $variable2 = $_POST['variable2'];
    $variable3 = $_POST['variable3'];
    $variable4 = $_POST['variable4'];
    $variable5 = $_POST['variable5'];
    $variable6 = $_POST['variable6'];

    // Insertar la firma con el id_empresa
    $stmt = $conexion->prepare("INSERT INTO Firma (name, variable1, variable2, variable3, variable4, variable5, variable6, id_empresa) 
                                VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssssi", $nombre_firma, $variable1, $variable2, $variable3, $variable4, $variable5, $variable6, $empresa_id);
    $stmt->execute();
    $stmt->close();

    echo "<p style='color: green;'>✅ Firma creada correctamente.</p>";
    echo '<a href="/loguin/pages/firmas.php?id=' . urlencode($empresa_id) . '"><button>Volver al listado de firmas</button></a>';
    exit;


    } else {
        echo "<p style='color: red;'>⚠️ El nombre de la firma y la empresa son obligatorios.</p>";
    }

?>

<h2>Crear Nueva Firma</h2>

<form action="crear_firma.php" method="POST">
    <label for="nombre_firma">Nombre de la Firma:</label>
    <input type="text" id="nombre_firma" name="nombre_firma" required><br><br>

    <label for="empresa_id">Selecciona la Empresa:</label>
    <select name="empresa_id" id="empresa_id" required>
        <option value="">-- Elige una empresa --</option>
        <?php foreach ($empresas as $empresa): ?>
            <option value="<?= $empresa['id'] ?>" <?= ($empresa_id == $empresa['id']) ? 'selected' : '' ?>>
                <?= htmlspecialchars($empresa['name']) ?>
            </option>
        <?php endforeach; ?>
    </select><br><br>

    <label for="variable1">Variable 1:</label>
    <input type="text" id="variable1" name="variable1"><br><br>

    <label for="variable2">Variable 2:</label>
    <input type="text" id="variable2" name="variable2"><br><br>

    <label for="variable3">Variable 3:</label>
    <input type="text" id="variable3" name="variable3"><br><br>

    <label for="variable4">Variable 4:</label>
    <input type="text" id="variable4" name="variable4"><br><br>

    <label for="variable5">Variable 5:</label>
    <input type="text" id="variable5" name="variable5"><br><br>

    <label for="variable6">Variable 6:</label>
    <input type="text" id="variable6" name="variable6"><br><br>

    <button type="submit">Crear Firma</button>
</form>
