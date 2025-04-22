<?php
require_once '../php/includes/conexion.php';  // Ruta desde "pages"
require_once '../php/includes/functions.php'; // Ruta desde "pages"
include '../php/includes/header.php'; // Incluir el header
$resultado = $conexion->query("SELECT * FROM Empresa");
?>

<h2>Empresas</h2>
<a href="crear_empresa.php">Crear nueva empresa</a><br><br>

<ul>
<?php while ($row = $resultado->fetch_assoc()): ?>
    <li>
        <?= $row['name'] ?>
        <a href="empresa_panel.php?id=<?= $row['id'] ?>">Ver detalles</a>
        <a href="editar_empresa.php?id=<?= $row['id'] ?>"><button>Editar</button></a> <!-- Botón de editar -->
    </li>
<?php endwhile; ?>
</ul>

<?php
include '../php/includes/footer.php'; // Incluir el footer
?>
