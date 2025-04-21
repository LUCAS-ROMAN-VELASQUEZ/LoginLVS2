<?php
require_once '../php/includes/conexion.php';  // Ruta desde "pages"
require_once '../php/includes/functions.php'; // Ruta desde "pages"
include '../php/includes/header.php'; // Incluir el header



// Obtener el id de la empresa desde la URL
$id_empresa = isset($_GET['id']) ? (int)$_GET['id'] : 0;

?>

<h2>Panel de empresa ID <?= $id_empresa ?></h2>

<a href="firmas.php?id=<?= $id_empresa ?>"><button>Firmas</button></a>
<a href="empleados.php?id=<?= $id_empresa ?>"><button>Empleados</button></a>

<?php
include '../php/includes/footer.php'; // Incluir el footer
?>
