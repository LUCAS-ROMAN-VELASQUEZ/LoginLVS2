<?php
require_once 'conexion.php';
$id_empresa = $_GET['id'];
$stmt = $conexion->prepare("SELECT * FROM Firma WHERE id_empresa = ?");
$stmt->bind_param("i", $id_empresa);
$stmt->execute();
$resultado = $stmt->get_result();
?>

<h2>Listado de Firmas</h2>
<a href="crear_firma.php?empresa_id=<?= $id_empresa ?>"><button>Crear Firma</button></a>

<ul>
<?php while ($row = $resultado->fetch_assoc()): ?>
    <li><?= $row['name'] ?></li>
<?php endwhile; ?>
</ul>
