<?php
require_once '../php/includes/conexion.php';  // Ruta desde forms/
require_once '../php/includes/functions.php'; // Ruta desde forms/


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Recibir los datos del formulario
    $nombre_firma = sanitizeInput($_POST['nombre_firma']);
    $variable1 = sanitizeInput($_POST['variable1']);
    $variable2 = sanitizeInput($_POST['variable2']);
    $variable3 = sanitizeInput($_POST['variable3']);
    $variable4 = sanitizeInput($_POST['variable4']);
    $variable5 = sanitizeInput($_POST['variable5']);
    $variable6 = sanitizeInput($_POST['variable6']);
    $empresa_id = sanitizeInput($_POST['empresa_id']);

    // Validar que los campos obligatorios no estén vacíos
    if (!empty($nombre_firma) && !empty($empresa_id)) {
        // Conectar a la base de datos
        $db = new DB();
        $conn = $db->getConnection();

        // Consulta SQL preparada (usando MySQLi)
        $query = "INSERT INTO Firma (name, variable1, variable2, variable3, variable4, variable5, variable6, id_empresa) 
                  VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

        // Preparar la consulta
        if ($stmt = $conn->prepare($query)) {
            // Vincular los parámetros
            $stmt->bind_param("ssssssss", $nombre_firma, $variable1, $variable2, $variable3, $variable4, $variable5, $variable6, $empresa_id);

            // Ejecutar la consulta
            if ($stmt->execute()) {
                showMessage("Firma creada correctamente.");
            } else {
                showMessage("Hubo un error al crear la firma.", "error");
            }

            // Cerrar la sentencia
            $stmt->close();
        } else {
            showMessage("Error al preparar la consulta.", "error");
        }
        
        // Cerrar la conexión
        $conn->close();
    } else {
        showMessage("Por favor, rellene todos los campos obligatorios.", "error");
    }
}
?>

<!-- Formulario para crear firma -->
<form action="crear_firma.php" method="POST">
    <label for="nombre_firma">Nombre de la Firma:</label>
    <input type="text" id="nombre_firma" name="nombre_firma" required><br><br>

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

    <label for="empresa_id">Selecciona la Empresa:</label>
    <select name="empresa_id" id="empresa_id" required>
        <option value="1">Empresa 1</option>
        <option value="2">Empresa 2</option>
        <option value="3">Empresa 3</option>
    </select><br><br>

    <button type="submit">Crear Firma</button>
</form>
