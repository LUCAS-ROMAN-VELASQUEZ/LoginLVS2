<?php
require_once '../php/includes/conexion.php';  // Ruta desde "pages"
require_once '../php/includes/functions.php'; // Ruta desde "pages"
include '../php/includes/header.php'; // Incluir el header

// Validar que el parámetro 'id' esté presente en la URL
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $firma_id = $_GET['id']; // Obtener el ID de la firma desde la URL
} else {
    echo "<p style='color: red;'>⚠️ No se ha especificado una firma válida.</p>";
    exit;
}

// Obtener los datos de la firma
$stmt = $conexion->prepare("SELECT * FROM Firma WHERE id = ?");
$stmt->bind_param("i", $firma_id);
$stmt->execute();
$firma = $stmt->get_result()->fetch_assoc();
$stmt->close();

if (!$firma) {
    echo "<p style='color: red;'>⚠️ Firma no encontrada.</p>";
    exit;
}

// Obtener las empresas disponibles (para poder cambiar la empresa de la firma)
$empresas_disponibles = [];
$stmt_empresas = $conexion->prepare("SELECT id, name FROM Empresa");
$stmt_empresas->execute();
$empresas_result = $stmt_empresas->get_result();
while ($empresa = $empresas_result->fetch_assoc()) {
    $empresas_disponibles[] = $empresa;
}
$stmt_empresas->close();

// Procesar formulario de edición
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre_firma = $_POST['nombre_firma'];
    $empresa_id = $_POST['empresa_id']; // ID de la empresa seleccionada
    $variable1 = $_POST['variable1'];
    $variable2 = $_POST['variable2'];
    $variable3 = $_POST['variable3'];
    $variable4 = $_POST['variable4'];
    $variable5 = $_POST['variable5'];
    $variable6 = $_POST['variable6'];

    // Actualizar los datos de la firma
    $stmt_update = $conexion->prepare("UPDATE Firma SET name = ?, variable1 = ?, variable2 = ?, variable3 = ?, variable4 = ?, variable5 = ?, variable6 = ?, id_empresa = ? WHERE id = ?");
    $stmt_update->bind_param("ssssssssi", $nombre_firma, $variable1, $variable2, $variable3, $variable4, $variable5, $variable6, $empresa_id, $firma_id);
    $stmt_update->execute();
    $stmt_update->close();

    echo "<p style='color: green;'>✅ Firma actualizada correctamente.</p>";
    echo '<a href="firmas.php?id=' . urlencode($empresa_id) . '"><button>Volver al listado de firmas</button></a>';
    exit;
}

    else {
        echo "<p style='color: red;'>⚠️ El nombre de la firma y la empresa son obligatorios.</p>";
    }

?>

<h2>Editar Firma</h2>

<form action="editar_firma.php?id=<?= $firma_id ?>" method="POST">
    <label for="nombre_firma">Nombre de la Firma:</label>
    <input type="text" id="nombre_firma" name="nombre_firma" value="<?= htmlspecialchars($firma['name']) ?>" required><br><br>

    <label for="empresa_id">Selecciona la Empresa:</label>
    <select name="empresa_id" id="empresa_id" required>
        <option value="">-- Elige una empresa --</option>
        <?php foreach ($empresas_disponibles as $empresa): ?>
            <option value="<?= $empresa['id'] ?>" <?= ($firma['id_empresa'] == $empresa['id']) ? 'selected' : '' ?>>
                <?= htmlspecialchars($empresa['name']) ?>
            </option>
        <?php endforeach; ?>
    </select><br><br>

    <label for="variable1">Variable 1:</label>
    <input type="text" id="variable1" name="variable1" value="<?= htmlspecialchars($firma['variable1']) ?>"><br><br>

    <label for="variable2">Variable 2:</label>
    <input type="text" id="variable2" name="variable2" value="<?= htmlspecialchars($firma['variable2']) ?>"><br><br>

    <label for="variable3">Variable 3:</label>
    <input type="text" id="variable3" name="variable3" value="<?= htmlspecialchars($firma['variable3']) ?>"><br><br>

    <label for="variable4">Variable 4:</label>
    <input type="text" id="variable4" name="variable4" value="<?= htmlspecialchars($firma['variable4']) ?>"><br><br>

    <label for="variable5">Variable 5:</label>
    <input type="text" id="variable5" name="variable5" value="<?= htmlspecialchars($firma['variable5']) ?>"><br><br>

    <label for="variable6">Variable 6:</label>
    <input type="text" id="variable6" name="variable6" value="<?= htmlspecialchars($firma['variable6']) ?>"><br><br>

    <button type="submit">Actualizar Firma</button>
</form>
