<?php
require_once 'conexion.php';
$resultado = $conexion->query("SELECT * FROM Empresa");
?>

<h2>Empresas</h2>
<a href="crear_empresa.php">Crear nueva empresa</a><br><br>

<ul>
<?php while ($row = $resultado->fetch_assoc()): ?>
    <li>
        <?= $row['name'] ?>
        <a href="empresa_panel.php?id=<?= $row['id'] ?>">Ver detalles</a>
    </li>
<?php endwhile; ?>
</ul>
