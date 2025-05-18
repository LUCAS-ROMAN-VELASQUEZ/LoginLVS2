<?php
require_once '../../php/includes/conexion.php';
require_once '../../php/includes/functions.php';
include '../../php/includes/header.php';

// Parámetros
$empleado_id = $_GET['id_empleado'] ?? null;
$empresa_id = $_GET['id_empresa'] ?? null;
$firma_id = $_GET['id_firma'] ?? null;

if (!is_numeric($empleado_id) || !is_numeric($empresa_id) || !is_numeric($firma_id)) {
    die("<p class='error'>❌ Error: Parámetros inválidos</p>");
}

// Obtener datos del empleado
$stmt = $conexion->prepare("SELECT name, apellidos, cargo, departamento, telefono_directo, telefono_movil, correo_electronico, foto_avatar FROM Empleado WHERE id = ?");
$stmt->bind_param("i", $empleado_id);
$stmt->execute();
$empleado = $stmt->get_result()->fetch_assoc();
$stmt->close();

if (!$empleado) {
    die("<p class='error'>❌ Empleado no encontrado</p>");
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Firma Simple</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Roboto', sans-serif;
        }

        body {
            background-color: #f5f5f5;
            display: flex;
            flex-direction: column;
            align-items: center;
            min-height: 100vh;
            padding: 40px 0;
        }

        .card {
            width: 700px;
            background-color: white;
            border: 1px solid #e0e0e0;
            border-radius: 5px;
            overflow: hidden;
            display: flex;
        }

        .left-section {
            width: 120%;
            padding: 20px;
            display: flex;
        }

        .logo-section {
            width: 120px;
            display: flex;
            flex-direction: column;
            align-items: center;
                font-size: 10px;
            writing-mode: vertical-lr;
            transform: rotate(180deg);
            text-align: center;
            line-height: 1.2;
        }

        .logo {
            color: #005a9c;
            font-weight: bold;
            font-size: 28px;
            line-height: 1;
            margin-bottom: 5px;
            writing-mode: vertical-lr;
            transform: rotate(180deg);
            letter-spacing: 2px;
        }


        .info-section {
            flex-grow: 1;
            padding-left: 15px;
        }

        .name {
            color: #005a9c;
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .surname {
            color: #005a9c;
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .title {
            color: #005a9c;
            font-size: 18px;
            margin-bottom: 20px;
        }

        .contact-info {
            margin-bottom: 20px;
        }

        .contact-item {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
            font-size: 14px;
        }

        .contact-icon {
            width: 20px;
            margin-right: 10px;
            color: #005a9c;
        }

        .social-links {
            display: flex;
            background-color: #33a9e0;
            padding: 10px;
            border-radius: 5px;
        }

        .social-link {
            display: flex;
            align-items: center;
            color: white;
            text-decoration: none;
            margin-right: 15px;
            font-size: 14px;
        }

        .social-icon {
            margin-right: 5px;
            font-size: 16px;
        }

        .right-section {
            width: 30%;
            background-color: #f9f9f9;
            padding: 20px;
            display: flex;
            flex-direction: column;
        }

        .profile-image {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            margin: 0 auto 15px;
            overflow: hidden;
        }

        .profile-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .tech-images {
            display: flex;
            justify-content: center;
            margin-bottom: 15px;
        }

        .tech-images img {
            width: 60px;
            height: 40px;
            object-fit: cover;
            margin-right: 5px;
        }

        .follow-button {
            margin-top: auto;
            background-color: white;
            border: 1px solid #33a9e0;
            border-radius: 20px;
            padding: 8px 15px;
            color: #33a9e0;
            font-weight: bold;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
        }

        .follow-button i {
            margin-right: 5px;
        }

        .banner-kyriba {
            margin-top: 30px;
            width: 700px;
            text-align: center;
        }

        .banner-kyriba img {
            width: 100%;
            height: auto;
            border-radius: 8px;
        }

    </style>
</head>
<body>
    <div class="card">
        <div class="left-section">
            <div class="logo-section">
                <div class="logo"><img src="gif/allcms.png" alt="Logo ALLCMS vertical" class="logo-img-vertical"></div>
               
            </div>
            <div class="info-section">
                <div class="name"><?= htmlspecialchars($empleado['name']) ?></div>
                <div class="surname"><?= htmlspecialchars($empleado['apellidos']) ?></div>
                <div class="title"><?= htmlspecialchars($empleado['cargo']) ?></div>

                <div class="contact-info">
                    <div class="contact-item">
                        <div class="contact-icon"><i class="fas fa-mobile-alt"></i></div>
                        <?= htmlspecialchars($empleado['telefono_movil']) ?>
                    </div>
                    <div class="contact-item">
                        <div class="contact-icon"><i class="fas fa-phone"></i></div>
                        <?= htmlspecialchars($empleado['telefono_directo']) ?>
                    </div>
                    <div class="contact-item">
                        <div class="contact-icon"><i class="fas fa-map-marker-alt"></i></div>
                        Calle Velázquez, 15 – 1ºD, 28001 Madrid
                    </div>
                </div>

                <div class="social-links">
                    <a href="mailto:<?= htmlspecialchars($empleado['correo_electronico']) ?>" class="social-link">
                        <i class="fas fa-envelope social-icon"></i>
                        <?= htmlspecialchars($empleado['correo_electronico']) ?>
                    </a>
                    <a href="https://allcms.es" class="social-link">
                        <i class="fas fa-globe social-icon"></i>
                        allcms.es
                    </a>
                </div>
            </div>
        </div>

     <div class="right-section">
    <div class="profile-image">
        <img src="../../php/avatars/<?= htmlspecialchars($empleado['foto_avatar']) ?>" alt="Avatar del empleado">
    </div>
</div>

    </div>

<!-- Banner Promocional LinkedIn -->
<div class="banner-linkedin" style="margin-top: 30px; text-align: center;">
    <a href="https://www.linkedin.com/company/all-cms/" target="_blank">
        <img src="gif/allcms.gif" alt="Síguenos en LinkedIn - ALLCMS" style="width: 650px; height: auto;">
    </a>
</div>
</body>
</html>

<?php include '../../php/includes/footer.php'; ?>
