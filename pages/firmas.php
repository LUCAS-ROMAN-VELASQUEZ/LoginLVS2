<?php
require_once '../php/includes/conexion.php';  // Ruta desde "pages"
require_once '../php/includes/functions.php'; // Ruta desde "pages"
include '../php/includes/header.php'; // Incluir el header

// Obtener todas las firmas existentes
$stmt_firmas = $conexion->prepare("SELECT * FROM Firma");
$stmt_firmas->execute();
$resultado_firmas = $stmt_firmas->get_result();

// Obtener lista de empresas para el select (si se desea seleccionar una empresa al crear una firma)
$empresas = [];
$sql = "SELECT id, name FROM Empresa";
$resultado_empresas = $conexion->query($sql);
if ($resultado_empresas && $resultado_empresas->num_rows > 0) {
    while ($fila = $resultado_empresas->fetch_assoc()) {
        $empresas[] = $fila;
    }
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
            <option value="<?= $empresa['id'] ?>"><?= htmlspecialchars($empresa['name']) ?></option>
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

<h2>Firmas Existentes</h2>
<ul>
<?php while ($firma = $resultado_firmas->fetch_assoc()): ?>
    <li>
        <?= htmlspecialchars($firma['name']) ?>
        <a href="editar_firma.php?id=<?= $firma['id'] ?>"><button>Editar</button></a> <!-- Botón de editar -->
    </li>
<?php endwhile; ?>
</ul>

<?php
$stmt_firmas->close();
include '../php/includes/footer.php'; // Incluir el footer
?>
