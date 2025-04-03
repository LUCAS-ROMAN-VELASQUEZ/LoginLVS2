<?php
require_once 'conexion.php';

$empresa_id = $_GET['empresa_id']; // ID recibido por GET

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre_firma = $_POST['nombre_firma'];
    $variable1 = $_POST['variable1'];
    $variable2 = $_POST['variable2'];
    $variable3 = $_POST['variable3'];
    $variable4 = $_POST['variable4'];
    $variable5 = $_POST['variable5'];
    $variable6 = $_POST['variable6'];

    if (!empty($nombre_firma) && !empty($empresa_id)) {
        $stmt = $conexion->prepare("INSERT INTO Firma (name, variable1, variable2, variable3, variable4, variable5, variable6, id_empresa) 
                                    VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssssi", $nombre_firma, $variable1, $variable2, $variable3, $variable4, $variable5, $variable6, $empresa_id);
        $stmt->execute();

        echo "Firma creada correctamente.";
    } else {
        echo "Por favor, rellene todos los campos obligatorios.";
    }
}
?>

<form action="crear_firma.php?empresa_id=<?= $empresa_id ?>" method="POST">
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

    <button type="submit">Crear Firma</button>
</form>
