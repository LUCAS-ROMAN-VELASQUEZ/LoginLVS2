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
$user=$empleado;
var_dump ($user);
$firstName = $user['name'];
            $lastName =  htmlspecialchars($user['apellidos']);
            $position = $user['cargo'];
            $mobile = $user['telefono_directo'];
            $phone = $user['telefono_movil'];
            $address = $user['direccion'];
            $email = $user['correo_electronico'];
            $website = $user['sitio_web'];
            $linkedin = $user['linkedin'];
            $empresa= $user['empresa'];
            $imagePath = $user['foto_avatar']; 
echo '<hr style="margin-top: 100px; border: 0; height: 1px; background-image: linear-gradient(to right, rgba(0, 0, 0, 0), rgba(67, 133, 255, 0.75), rgba(0, 0, 0, 0));">';
echo '<h1 style="font-family: \'Montserrat\', sans-serif; color: #004D82; text-align: center; margin-top: 0; margin-bottom: 0;">Firma Linkedin</h1>';
echo '<hr style="margin-bottom: 100px; border: 0; height: 1px; background-image: linear-gradient(to right, rgba(0, 0, 0, 0), rgba(67, 133, 255, 0.75), rgba(0, 0, 0, 0)); margin-bottom: 20px;">';
    // Mostrar el template de la firma de Casos de Éxito
    ?>

<div style="width:800px;">
    <table cellspacing="0" cellpadding="0" style="font-family: 'Lato', sans-serif; font-size: 12px; color: #004D82; border: 1px solid #7ed6f2;">
        <tr>
            <td width="70" style="vertical-align:middle; width:80px;">
                <img class="logo" height="200" width="65" src="https://firmas.lvs2.net/allcms/img/allcmslogo.png">
            </td>
            <td>
                <table cellspacing="0" cellpadding="0" style="width:100%;">
                    <thead>
                        <tr>

                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td colspan="1" style="margin-left:5%; margin-top:3%; ">
                                <br>
                                <strong>
                                    <h1 style="margin-left:5%; font-size: 20px; font-family: 'Lato', sans-serif; color:#004D82; margin-top: 0; margin-bottom: 0;"><?php echo $firstName; ?></h1>
                                    <h1 style="margin-left:5%; font-size: 20px; font-family: 'Lato', sans-serif; color:#004D82; margin-top: 0; margin-bottom: 0;"><?php echo $lastName; ?></h1>
                                </strong>
                                <h2 style="margin-left:5%; font-size: 14.2px; font-family: 'Lato', sans-serif; color:#004D82; margin-top: 0; margin-bottom: 0;"><?php echo $position; ?></h2>
                            </td>
                            <td style=" vertical-align: middle;" rowspan="2">
                                <img width="100" style="display: block;" src="<?php echo $imagePath; ?>">
                            </td>
                            <td  style="text-align: center; vertical-align: middle;" width="150" rowspan="3">
                                <a href="<?php echo $linkedin; ?>"><img height = "200" width="150" style="margin: auto; display: block;"  src="https://firmas.lvs2.net/allcms/img/GIF_firma_email_AllCMS.gif"></a>
                            </td>
                        </tr>
                        <tr>
                            <td style=" padding-top: 2%; padding-bottom: 3%;">
                                <table cellspacing="0" cellpadding="0"  style="margin-left: 1%; margin-top:3%; width: 100%;">
                                    <thead>
                                        <tr>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td style="background-color: #ffffff; vertical-align: middle; text-align: left; ">
                                                <table align="left"  cellpadding="0" cellspacing="0">
                                                    <tr>
                                                        <td style="vertical-align: middle; text-align: center;">
                                                            <img height="20" src="https://firmas.lvs2.net/allcms/img/ico/Movil.png" alt="Móvil" style="width: 20px; vertical-align: middle;">
                                                        </td>
                                                        <td style="vertical-align: middle; text-align: left; ">
                                                            <span style="font-size: 11px; font-family: 'Lato', sans-serif; color: #004d82;"><?php echo $mobile;?></span>
                                                        </td>
                                                        <td style="vertical-align: middle; text-align: center;">
                                                            &nbsp <img height="20" src="https://firmas.lvs2.net/allcms/img/ico/TelfFijo.png" alt="Teléfono Fijo" style="width: 20px; vertical-align: middle;">
                                                        </td>
                                                        <td style="vertical-align: middle; text-align: left;">
                                                            <span style="font-size: 11px; font-family: 'Lato', sans-serif; color: #004d82;"><?php echo $phone ?></span>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="background-color: #ffffff; vertical-align: middle; text-align: left; ">
                                                <table align="left"  cellpadding="0" cellspacing="0">
                                                    <tr>
                                                        <td style="vertical-align: middle; text-align: center;">
                                                            <img height="20" src="https://firmas.lvs2.net/allcms/img/ico/direccion.png" alt="Dirección" style="width: 20px; height: 20px; vertical-align: middle;">
                                                        </td>
                                                        <td style="vertical-align: middle; text-align: left; padding-left: 5px;">
                                                            <span style="font-size: 11px; font-family: 'Lato', sans-serif; color: #004d82;"><?php echo $address; ?></span>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2" style="border-collapse:0;">
                                <table cellspacing="0" cellpadding="0" style="margin-left: 5%; margin-right: 5%; background-color: #23a8e9; margin-top:6%;">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td style="padding: 4px; background-color: #23a8e9; vertical-align: middle; text-align: center;">
                                                <table align="center"  cellpadding="0" cellspacing="0" style="margin: auto;">
                                                    <tr>
                                                        <td style="vertical-align: middle; text-align: center;">
                                                            <a href="mailto:<?php echo $email; ?>" style="text-decoration: none; color: #004d82;">
                                                                <img height="30" src="https://firmas.lvs2.net/allcms/img/ico/email.png" alt="Email" style="width: 30px; vertical-align: middle; margin-right: 5px;">
                                                            </a>
                                                        </td>
                                                        <td style="vertical-align: middle; text-align: center; margin-left: 3px;">
                                                            <a href="mailto:<?php echo $email; ?>" style="text-decoration: none; color: #004d82;">
                                                                <span style="font-size: 11px; font-family: 'Lato', sans-serif; color: #004d82;"><?php echo $email; ?></span>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>
                                            <td style="background-color: #23a8e9; vertical-align: middle; text-align: center;">
                                                <table align="center"  cellpadding="0" cellspacing="0" style="margin: auto;">
                                                    <tr>
                                                        <td style="vertical-align: middle; text-align: center;">
                                                            <a href="<?php echo $website; ?>" style="text-decoration: none; color: #004d82;">
                                                                <img height="30" src="https://firmas.lvs2.net/allcms/img/ico/web.png" alt="Website" style="width: 30px; vertical-align: middle; margin-right: 5px;">
                                                            </a>
                                                        </td>
                                                        <td style="vertical-align: middle; text-align: center; margin-left: 3px;">
                                                            <a href="<?php echo $website; ?>" style="text-decoration: none; color: #004d82;">
                                                                <span style="font-size: 11px; font-family: 'Lato', sans-serif; color: #004d82;"><?php echo $empresa; ?></span>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>
                                            <td style="padding: 4px; background-color: #23a8e9; vertical-align: middle; text-align: center;">
                                                <table align="center"  cellpadding="0" cellspacing="0" style="margin: auto;">
                                                    <tr>
                                                        <td style="vertical-align: middle; text-align: center;">
                                                            <a href="<?php  echo $linkedin; ?>" style="text-decoration: none; color: #004d82;">
                                                                <img height="30" src="https://firmas.lvs2.net/allcms/img/ico/LinkedIn.png" alt="LinkedIn" style="width: 30px; vertical-align: middle;">
                                                            </a>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </td>
        </tr>
    </table>
</div>