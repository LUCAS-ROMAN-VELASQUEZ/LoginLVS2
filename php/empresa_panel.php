<?php
$id = $_GET['id'];
?>

<h2>Panel de empresa ID <?= $id ?></h2>

<a href="firmas.php?id=<?= $id ?>"><button>Firmas</button></a>
<a href="empleados.php?id=<?= $id ?>"><button>Empleados</button></a>
