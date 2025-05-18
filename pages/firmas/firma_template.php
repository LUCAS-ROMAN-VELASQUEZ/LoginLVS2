<?php
require_once '../../php/includes/conexion.php';
require_once '../../php/includes/functions.php';
include '../../php/includes/header.php';

if (isset($_GET['userId'])) {
    // Obtener el userId de la URL
    $userId = $_GET['userId'];

    // Consultar la base de datos para obtener los datos del usuario con el userId proporcionado
    $user = getUserById($pdo, $userId);

    // Verificar si se encontró un usuario con el userId proporcionado
    if ($user) {
     
            // Extraer los datos del usuario
            $firstName = $user['firstName'];
            $lastName = $user['lastName'];
            $position = $user['position'];
            $mobile = $user['mobile'];
            $phone = $user['phone'];
            $address = $user['address'];
            $email = $user['email'];
            $website = $user['website'];
            $linkedin = $user['linkedin'];
            $empresa= $user['empresa'];
            $imagePath = $user['imagePath']; 
$emails_permitidos = [
    "pbouaziz@allcms.es",
    "enieto@allcms.es",
    "ecalle@allcms.es",
    "nromero@allcms.es",
    "aoteo@allcms.es"
];
            // Generar la plantilla de la firma con los datos del usuario
            echo '<hr style="margin-top: 100px; border: 0; height: 1px; background-image: linear-gradient(to right, rgba(0, 0, 0, 0), rgba(67, 133, 255, 0.75), rgba(0, 0, 0, 0));">';
            echo '<h1 style="font-family: \'Montserrat\', sans-serif; color: #004D82; text-align: center; margin-top: 0; margin-bottom: 0;">Firma Simple</h1>';
            echo '<hr style="margin-bottom: 100px; border: 0; height: 1px; background-image: linear-gradient(to right, rgba(0, 0, 0, 0), rgba(67, 133, 255, 0.75), rgba(0, 0, 0, 0)); margin-bottom: 20px;">';
?>


<div style="width:700px;">
    <table cellspacing="0" cellpadding="0" style="font-family: 'Lato', sans-serif; font-size: 12px; color: #004D82;">
        <tr>
            <td style="vertical-align:middle">
                <img height="200" style="width: 100%;" src="https://firmas.lvs2.net/allcms/img/allcmslogo.png">
            </td>
            <td>
                <table cellspacing="0" cellpadding="0" width="450">
                    <tbody>
                    <tr>
                        <td colspan="1" style="margin-left:5%; width:70%; margin-top:3%;">
                            <strong>
                                <h1 style="margin-left:5%; font-size: 20px; font-family: 'Lato', sans-serif; color:#004D82; margin-top: 0; margin-bottom: 0;"><?php echo $firstName ?> <?php echo $lastName ?></h1>
                            </strong>
                            <h2 style="margin-left:5%; font-size: 14.2px; font-family: 'Lato', sans-serif; color:#004D82; margin-top: 0; margin-bottom: 0;"><?php echo $position ?></h2>
                        </td>
                        <td></td>
                        <td style="vertical-align: middle;" rowspan="2">
                            <img style="width: 80%; margin: 5%; display: block;" src="<?php echo $imagePath ?>">
                        </td>
                    </tr>
                    <tr>
                        <td colspan="1" style=" border-collapse:0; padding-top: 2%;" >
                            <table cellspacing="0" cellpadding="0" border="0" style="margin-left: 5%; margin-top:3%; width: 100%;">
                               <tbody>
                                <tr>
                                    <td style="background-color: #ffffff; vertical-align: middle; text-align: left; border-left: 1px solid #004d82;">
                                        <table align="left" border="0" cellpadding="0" cellspacing="0">
                                            <tr>
                                                <td style="vertical-align: middle; text-align: center;">
                                                    <img height="20" src="https://firmas.lvs2.net/allcms/img/ico/Movil.png" alt="Móvil" style="width: 20px; vertical-align: middle; border: 0;">
                                                </td>
                                                <td style="vertical-align: middle; text-align: left; padding-left: 5px;">
                                                    <span style="font-size: 11px; font-family: 'Lato', sans-serif; color: #004d82;"><?php echo $mobile ?></span>
                                                </td>
                                                <td style="vertical-align: middle; text-align: center;">
                                                    &nbsp <img height="20"  src="https://firmas.lvs2.net/allcms/img/ico/TelfFijo.png" alt="Teléfono Fijo" style="width: 20px; vertical-align: middle; border: 0;">
                                                </td>
                                                <td style="vertical-align: middle; text-align: left; padding-left: 5px;">
                                                    <span style="font-size: 11px; font-family: 'Lato', sans-serif; color: #004d82;"><?php echo $phone ?></span>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="background-color: #ffffff; vertical-align: middle; text-align: left; border-left: 1px solid #004d82;">
                                        <table align="left" border="0" cellpadding="0" cellspacing="0">
                                            <tr>
                                                <td style="vertical-align: middle; text-align: center;">
                                                    <img height="20" src="https://firmas.lvs2.net/allcms/img/ico/direccion.png" alt="Dirección" style="width: 20px; height: 20px; vertical-align: middle; border: 0;">
                                                </td>
                                                <td style="vertical-align: middle; text-align: left; padding-left: 5px;">
                                                    <span style="font-size: 11px; font-family: 'Lato', sans-serif; color: #004d82;"><?php echo $address ?></span>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </tbody>
                            </table>
                        </td>  
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td colspan="3" style="border-collapse:0; padding-top: 2%;">
                            <table  cellspacing="0" cellpadding="0" style="width: 60%; height: 100%; margin-left: 5%; margin-right: 5%; background-color: #23a8e9; margin-top:3%;">
                                <tbody>
                            <tr>
                                <td style="padding: 4px; background-color: #23a8e9; vertical-align: middle; text-align: center;">
                                    <table align="center" border="0" cellpadding="0" cellspacing="0" style="margin: auto;">
                                        <tr>
                                            <td style="vertical-align: middle; text-align: center;">
                                                <a href="mailto:<?php echo $email ?>" style="text-decoration: none; color: #004d82;">
                                                    <img height="30" src="https://firmas.lvs2.net/allcms/img/ico/email.png" alt="Email" style="width: 30px; vertical-align: middle; border: 0; margin-right: 5px;">
                                                </a>
                                            </td>
                                            <td style="vertical-align: middle; text-align: center;">
                                                <a href="mailto:<?php echo $email ?>" style="text-decoration: none; color: #004d82;">
                                                    <span style="font-size: 11px; font-family: 'Lato', sans-serif; color: #004d82;"><?php echo $email ?></span>
                                                </a>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                                <td style="background-color: #23a8e9; vertical-align: middle; text-align: center;">
                                    <table align="center" border="0" cellpadding="0" cellspacing="0" style="margin: auto;">
                                        <tr>
                                            <td style="vertical-align: middle; text-align: center;">
                                                <a href="<?php echo $website ?>" style="text-decoration: none; color: #004d82;">
                                                    <img height="30" src="https://firmas.lvs2.net/allcms/img/ico/web.png" alt="Website" style="width: 30px; vertical-align: middle; border: 0; margin-right: 5px;">
                                                </a>
                                            </td>
                                            <td style="vertical-align: middle; text-align: center;">
                                                <a href="<?php echo $website ?>" style="text-decoration: none; color: #004d82;">
                                                    <span style="font-size: 11px; font-family: 'Lato', sans-serif; color: #004d82;"><?php echo $empresa ?></span>
                                                </a>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                                <td style="padding: 4px; background-color: #23a8e9; vertical-align: middle; text-align: center;">
                                    <table align="center" border="0" cellpadding="0" cellspacing="0" style="margin: auto;">
                                        <tr>
                                            <td style="vertical-align: middle; text-align: center;">
                                                <a href="<?php echo $linkedin ?>" style="text-decoration: none; color: #004d82;">
                                                    <img height="30" src="https://firmas.lvs2.net/allcms/img/ico/LinkedIn.png" alt="LinkedIn" style="width: 30px; vertical-align: middle; border: 0;">
                                                </a>
                                            </td>
                                        </tr>
                                    </table>
                                </td>                               
                            </tr>
                            </tbody> 
                            </table>
                        </td>
                        <td></td>
                        <td></td>
                    </tr>
                </tbody>
                </table>
            </td>
        </tr>
		<tr>
    <td colspan="3" style="padding-top: 20px;">
      <a href="https://events.kyriba.com/usergroupespana?utm_source=Mail&utm_medium=Firma&utm_campaign=KyribaUserGroup">  <img src="https://firmas.lvs2.net/allcms/img/thumbnail_ES_User-Group-e-signature.png"  alt="Banner Promocional" style="width: 100%; height: auto; display: block;"></a>
    </td>

                    </tr>
    </table>
<br/>
</div>


<?php if (!in_array($email, $emails_permitidos)){/**
echo '<hr style="margin-top: 100px; border: 0; height: 1px; background-image: linear-gradient(to right, rgba(0, 0, 0, 0), rgba(67, 133, 255, 0.75), rgba(0, 0, 0, 0));">';
echo '<h1 style="font-family: \'Montserrat\', sans-serif; color: #004D82; text-align: center; margin-top: 0; margin-bottom: 0;"> Firma NPS</h1>';
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
                                <a href="https://forms.office.com/e/bZKfrHZY7p?utm_source=Firma&utm_medium=Email&utm_campaign=NPS_Consultores&utm_id=NPS"><img height = "200" width="150" style="margin: auto; display: block;"  src="https://firmas.lvs2.net/allcms/img/GIF_NPS_firma_email_AllCMS.gif"></a>
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
<?php **/}
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

<?php



        } else {
        // Mostrar un mensaje de error si no se encontró ningún usuario con el userId proporcionado
        echo "No se encontró ningún usuario con el ID proporcionado.";
    } 
} else {
    // Mostrar un mensaje de error si no se proporcionó ningún userId en la URL
    echo "Se requiere un ID de usuario para mostrar la firma.";
}

if ($user['firma_ebook'] == 1) {
    $enlaces = [];


        // Consulta SQL para obtener los valores actuales de los enlaces
        $sql = "SELECT * FROM enlaces_permanentes";
        $stmt = $pdo->query($sql);
        $enlaces = $stmt->fetch(PDO::FETCH_ASSOC);
       $ebocks_image_url= $enlaces['ebocks_image_url'];
       $enlaceEB= $enlaces['ebocks_button_url'];
           if($email == "enieto@allcms.es" )
    {
        $enlaceEB="https://allcms.es/optimizar-capital-circulante-con-in-house-bank/?utm_source=FirmaMail&utm_medium=Ebook_IHB&utm_campaign=MariaEstherNietoCabrera&utm_id=Mail";
    }
    if($email == "ecalle@allcms.es" )
    {
        $enlaceEB="https://allcms.es/optimizar-capital-circulante-con-in-house-bank/?utm_source=FirmaMail&utm_medium=Ebook_IHB&utm_campaign=ErnestoDeLaCalleManzano&utm_id=Mail";
    }
    if($email == "pbouaziz@allcms.es" )
    {
        $enlaceEB="https://allcms.es/optimizar-capital-circulante-con-in-house-bank/?utm_source=FirmaMail&utm_medium=Ebook_IHB&utm_campaign=PierreBouaziz&utm_id=Mail";
    }


echo '<hr style="margin-top: 100px; border: 0; height: 1px; background-image: linear-gradient(to right, rgba(0, 0, 0, 0), rgba(67, 133, 255, 0.75), rgba(0, 0, 0, 0));">';
echo '<h1 style="font-family: \'Montserrat\', sans-serif; color: #004D82; text-align: center; margin-top: 0; margin-bottom: 0;">Firma Ebook</h1>';
echo '<hr style="margin-bottom: 100px; border: 0; height: 1px; background-image: linear-gradient(to right, rgba(0, 0, 0, 0), rgba(67, 133, 255, 0.75), rgba(0, 0, 0, 0)); margin-bottom: 20px;">';
    ?>
    <div style="width:800px;">
    <table cellspacing="0" cellpadding="0" hea style="font-family: 'Lato', sans-serif; font-size: 12px; color: #004D82;">
        <tr>
            <td style="vertical-align:middle">
                <img class="logo" height="200" style="width:100%;" src="https://firmas.lvs2.net/allcms/img/allcmslogo.png">
            </td>
            <td>
                <table cellspacing="0" cellpadding="0" width="610">
                    <thead>
                        <th style="width: 8%;"></th>
                        <th style="width: 3%;"></th>
                        <th style="width: 3%; padding-bottom: 20px; background-color: #004D82;"></th>
                        <th style="width: 4%;"></th>
                        <th style="width: 0%;"></th>
                    </thead>
                    <tbody>
                    <tr>
                        <td colspan="1" style="margin-left:5%; margin-top:3%;  border-left: 1px solid  #7ed6f2; border-top: 1px solid  #7ed6f2;">
                            <br>
                            <strong>
                                <h1 style="margin-left:5%; font-size: 20px; font-family: 'Lato', sans-serif; color:#004D82; margin-top: 0; margin-bottom: 0;"><?php echo $firstName; ?></h1>
                                <h1 style="margin-left:5%;font-size: 20px; font-family: 'Lato', sans-serif; color:#004D82; margin-top: 0; margin-bottom: 0;"><?php echo $lastName; ?></h1>
                            </strong>
                            <h2 style="margin-left:5%; font-size: 14.2px; font-family: 'Lato', sans-serif; color:#004D82; margin-top: 0; margin-bottom: 0;"><?php echo $position; ?></h2>
                        </td>
                        <td style=" border-top: 1px solid  #7ed6f2; vertical-align: middle;" rowspan="2">
                            <img style="display: block;" src="<?php echo $imagePath; ?>">
                        </td>
                         <td style="background-color: #004D82; padding: 2%; text-align: center; vertical-align: middle;" rowspan="3">
                            <img height="100" width="160" style="width: 100%; max-width: 100%; margin: auto; display: block;" src="<?php echo $ebocks_image_url ?>">
                            
                                <p style="font-size: 18px; font-family: 'Lato', sans-serif; color: #ffffff; text-align: left; margin: 0;">
                                    <strong><?php echo $enlaces['descripcion_ebook']; ?></strong>
                                </p>
                           
                        </td>
                        <td style=" border-right: 1px solid  #7ed6f2;  border-top: 1px solid  #7ed6f2;"></td>
                    </tr>
                    <tr>
                        <td style=" border-left: 1px solid  #7ed6f2; padding-top: 2%; padding-bottom: 3%;">
                            <table cellspacing="0" cellpadding="0" border="0" style="margin-left: 5%; margin-top:3%; width: 100%;">
                                <thead>
                                 <th></th>
                                 
                                </thead>
                             <tbody>
                                 <tr>
                                     <td style="background-color: #ffffff; vertical-align: middle; text-align: left; border-left: 1px solid #004d82;">
                                         <table align="left" border="0" cellpadding="0" cellspacing="0">
                                             <tr>
                                                 <td style="vertical-align: middle; text-align: center;">
                                                     <img height="20" src="https://firmas.lvs2.net/allcms/img/ico/Movil.png" alt="Móvil" style="width: 20px; vertical-align: middle; border: 0;">
                                                 </td>
                                                 <td style="vertical-align: middle; text-align: left; padding-left: 5px; padding-right: 10px;">
                                                     <span style="font-size: 11px; font-family: 'Lato', sans-serif; color: #004d82;"><?php echo $mobile; ?></span>
                                                 </td>
                                                 <td style="vertical-align: middle; text-align: center;">
                                                     &nbsp <img height="20"  src="https://firmas.lvs2.net/allcms/img/ico/TelfFijo.png" alt="Teléfono Fijo" style="width: 20px; vertical-align: middle; border: 0;">
                                                 </td>
                                                 <td style="vertical-align: middle; text-align: left; padding-left: 5px;">
                                                     <span style="font-size: 11px; font-family: 'Lato', sans-serif; color: #004d82;"><?php echo $phone; ?></span>
                                                 </td>
                                             </tr>
                                         </table>
                                     </td>
                                 </tr>
                                 <tr>
                                     <td style="background-color: #ffffff; vertical-align: middle; text-align: left; border-left: 1px solid #004d82;">
                                         <table align="left" border="0" cellpadding="0" cellspacing="0">
                                             <tr>
                                                 <td style="vertical-align: middle; text-align: center;">
                                                     <img height="20" src="https://firmas.lvs2.net/allcms/img/ico/direccion.png" alt="Dirección" style="width: 20px; height: 20px; vertical-align: middle; border: 0;">
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
                        <td style=" border-right: 1px solid  #7ed6f2;">
                        
                        </td>
                        <td></td>
                    </tr>
                    <tr>
                        
                        <td colspan="2" style=" border-collapse:0;  border-left: 1px solid  #7ed6f2; border-bottom: 1px solid  #7ed6f2; ">
                             
                            <table  cellspacing="0" cellpadding="0"  style="margin-left: 5%; margin-right: 5%; background-color: #23a8e9; margin-top:6%;  ">
                                <thead>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    
                                </thead>
                                <tbody>
                            <tr>
                                <td style="padding: 4px; background-color: #23a8e9; vertical-align: middle; text-align: center; ">
                                    <table align="center" border="0" cellpadding="0" cellspacing="0" style="margin: auto;">
                                        <tr>
                                            <td style="vertical-align: middle; text-align: center;">
                                                <a href="mailto:<?php echo $email; ?>" style="text-decoration: none; color: #004d82;">
                                                    <img height="30" src="https://firmas.lvs2.net/allcms/img/ico/email.png" alt="Email" style="width: 30px; vertical-align: middle; border: 0; margin-right: 5px;">
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
                                    <table align="center" border="0" cellpadding="0" cellspacing="0" style="margin: auto;">
                                        <tr>
                                            <td style="vertical-align: middle; text-align: center;">
                                                <a href="<?php echo $website; ?>" style="text-decoration: none; color: #004d82;">
                                                    <img height="30" src="https://firmas.lvs2.net/allcms/img/ico/web.png" alt="Website" style="width: 30px; vertical-align: middle; border: 0; margin-right: 5px;">
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
                                    <table align="center" border="0" cellpadding="0" cellspacing="0" style="margin: auto;">
                                        <tr>
                                            <td style="vertical-align: middle; text-align: center;">
                                                <a href="<?php echo $linkedin; ?>" style="text-decoration: none; color: #004d82;">
                                                    <img height="30" src="https://firmas.lvs2.net/allcms/img/ico/LinkedIn.png" alt="LinkedIn" style="width: 30px; vertical-align: middle; border: 0;">
                                                </a>
                                            </td>
                                        </tr>
                                    </table>
                                </td>                               
                            </tr>
                            </tbody> 
                            </table>
                        </td>

                        <td style="border-right: 1px solid  #7ed6f2; border-bottom: 1px solid  #7ed6f2;"></td>
                    
                    </tr>
                    
                    <tr>
                        <td>
                            <!-- Contenido -->
                        </td>
                        <td style="vertical-align: middle;" rowspan="2">
                            <!-- Contenido -->
                        </td>
                        <td style="background-color: #004D82; text-align: center; padding-bottom:1%; margin-top: 3%;">
                            <a href="<?php echo $enlaceEB;?>">
                                <img  height="40" width="100" style=" display: block; margin: auto;" src="https://firmas.lvs2.net/allcms/img/1.png">
                            </a>
                        </td>
                        <td>
                            <!-- Contenido -->
                        </td>
                    </tr>
                </tbody>
                </table>
            </td>
        </tr>
    </table>
<br/>
</div>
 <?php
}

// Verificar si la firma de Casos de Éxito está activa
if ($user['firma_exitos'] == 1) {
    $sql = "SELECT * FROM enlaces_permanentes";
    $stmt = $pdo->query($sql);
    $enlaces = $stmt->fetch(PDO::FETCH_ASSOC);
    $enlaces['success_cases_button_url'];
    $enlaces['success_cases_image_url'];

    $enlacesCE= $enlaces['success_cases_button_url'];
    if($email == "enieto@allcms.es" )
    {
        $enlacesCE="https://allcms.es/caso-de-exito/unificacion-y-automatizacion-de-la-tesoreria-global-el-caso-de-exito-de-exolum/?utm_source=Mail&utm_medium=Firma&utm_campaign=CE_Exolum&utm_id=EN";
    }
    if($email == "ecalle@allcms.es" )
    {
        $enlacesCE="https://allcms.es/caso-de-exito/unificacion-y-automatizacion-de-la-tesoreria-global-el-caso-de-exito-de-exolum/?utm_source=Mail&utm_medium=Firma&utm_campaign=CE_Exolum&utm_id=EC";
    }
    if($email == "pbouaziz@allcms.es" )
    {
        $enlacesCE="https://allcms.es/caso-de-exito/unificacion-y-automatizacion-de-la-tesoreria-global-el-caso-de-exito-de-exolum/?utm_source=Mail&utm_medium=Firma&utm_campaign=CE_Exolum&utm_id=PB";
    }


echo '<hr style="margin-top: 100px; border: 0; height: 1px; background-image: linear-gradient(to right, rgba(0, 0, 0, 0), rgba(67, 133, 255, 0.75), rgba(0, 0, 0, 0));">';
echo '<h1 style="font-family: \'Montserrat\', sans-serif; color: #004D82; text-align: center; margin-top: 0; margin-bottom: 0;">Firma Caso de éxito</h1>';
echo '<hr style="margin-bottom: 100px; border: 0; height: 1px; background-image: linear-gradient(to right, rgba(0, 0, 0, 0), rgba(67, 133, 255, 0.75), rgba(0, 0, 0, 0)); margin-bottom: 20px;">';
    // Mostrar el template de la firma de Casos de Éxito
    ?>
    <div style="width:800px;">
    <table cellspacing="0" cellpadding="0" hea style="font-family: 'Lato', sans-serif; font-size: 12px; color: #004D82;">
        <tr>
            <td style="vertical-align:middle">
                <img class="logo" height="200" style="width:100%;" src="https://firmas.lvs2.net/allcms/img/allcmslogo.png">
            </td>
            <td>
                <table cellspacing="0" cellpadding="0" width="610">
                    <thead>
                        <th style="width: 8%;"></th>
                        <th style="width: 3%;"></th>
                        <th style="width: 3%; padding-bottom: 20px; background-color: #004D82;"></th>
                        <th style="width: 4%;"></th>
                        <th style="width: 0%;"></th>
                    </thead>
                    <tbody>
                    <tr>
                        <td colspan="1" style="margin-left:5%; margin-top:3%;  border-left: 1px solid  #7ed6f2; border-top: 1px solid  #7ed6f2;">
                            <br>
                            <strong>
                                <h1 style="margin-left:5%; font-size: 20px; font-family: 'Lato', sans-serif; color:#004D82; margin-top: 0; margin-bottom: 0;"><?php echo $firstName; ?></h1>
                                <h1 style="margin-left:5%;font-size: 20px; font-family: 'Lato', sans-serif; color:#004D82; margin-top: 0; margin-bottom: 0;"><?php echo $lastName; ?></h1>
                            </strong>
                            <h2 style="margin-left:5%; font-size: 14.2px; font-family: 'Lato', sans-serif; color:#004D82; margin-top: 0; margin-bottom: 0;"><?php echo $position; ?></h2>
                        </td>
                        <td style=" border-top: 1px solid  #7ed6f2; vertical-align: middle;" rowspan="2">
                            <img style="display: block;" src="<?php echo $imagePath; ?>">
                        </td>
                         <td style="background-color: #004D82; padding: 2%; text-align: center; vertical-align: middle;" rowspan="3">
                            <img height="100" width="160" style="width: 100%; max-width: 100%; margin: auto; display: block;" src="<?php echo $enlaces['success_cases_image_url']; ?>">
                            
                                <p style="font-size: 18px; font-family: 'Lato', sans-serif; color: #ffffff; text-align: left; margin: 0;">
                                    <strong>CASO DE ÉXITO <br> <?php echo $enlaces['descripcion_caso_exito']; ?></strong>
                                </p>
                           
                        </td>
                        <td style=" border-right: 1px solid  #7ed6f2;  border-top: 1px solid  #7ed6f2;"></td>
                    </tr>
                    <tr>
                        <td style=" border-left: 1px solid  #7ed6f2; padding-top: 2%; padding-bottom: 3%;">
                            <table cellspacing="0" cellpadding="0" border="0" style="margin-left: 5%; margin-top:3%; width: 100%;">
                                <thead>
                                 <th></th>
                                 
                                </thead>
                             <tbody>
                                 <tr>
                                     <td style="background-color: #ffffff; vertical-align: middle; text-align: left; border-left: 1px solid #004d82;">
                                         <table align="left" border="0" cellpadding="0" cellspacing="0">
                                             <tr>
                                                 <td style="vertical-align: middle; text-align: center;">
                                                     <img height="20" src="https://firmas.lvs2.net/allcms/img/ico/Movil.png" alt="Móvil" style="width: 20px; vertical-align: middle; border: 0;">
                                                 </td>
                                                 <td style="vertical-align: middle; text-align: left; padding-left: 5px; padding-right: 10px;">
                                                     <span style="font-size: 11px; font-family: 'Lato', sans-serif; color: #004d82;"><?php echo $mobile;?></span>
                                                 </td>
                                                 <td style="vertical-align: middle; text-align: center;">
                                                 &nbsp <img height="20"  src="https://firmas.lvs2.net/allcms/img/ico/TelfFijo.png" alt="Teléfono Fijo" style="width: 20px; vertical-align: middle; border: 0;">
                                                 </td>
                                                 <td style="vertical-align: middle; text-align: left; padding-left: 5px;">
                                                     <span style="font-size: 11px; font-family: 'Lato', sans-serif; color: #004d82;"><?php echo $phone; ?></span>
                                                 </td>
                                             </tr>
                                         </table>
                                     </td>
                                 </tr>
                                 <tr>
                                     <td style="background-color: #ffffff; vertical-align: middle; text-align: left; border-left: 1px solid #004d82;">
                                         <table align="left" border="0" cellpadding="0" cellspacing="0">
                                             <tr>
                                                 <td style="vertical-align: middle; text-align: center;">
                                                     <img height="20" src="https://firmas.lvs2.net/allcms/img/ico/direccion.png" alt="Dirección" style="width: 20px; height: 20px; vertical-align: middle; border: 0;">
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
                        <td style=" border-right: 1px solid  #7ed6f2;">
                        
                        </td>
                        <td></td>
                    </tr>
                    <tr>
                        
                        <td colspan="2" style=" border-collapse:0;  border-left: 1px solid  #7ed6f2; border-bottom: 1px solid  #7ed6f2; ">
                             
                            <table  cellspacing="0" cellpadding="0"  style="margin-left: 5%; margin-right: 5%; background-color: #23a8e9; margin-top:6%;  ">
                                <thead>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    
                                </thead>
                                <tbody>
                            <tr>
                                <td style="padding: 4px; background-color: #23a8e9; vertical-align: middle; text-align: center; ">
                                    <table align="center" border="0" cellpadding="0" cellspacing="0" style="margin: auto;">
                                        <tr>
                                            <td style="vertical-align: middle; text-align: center;">
                                                <a href="mailto:<?php echo $email; ?>" style="text-decoration: none; color: #004d82;">
                                                    <img height="30" src="https://firmas.lvs2.net/allcms/img/ico/email.png" alt="Email" style="width: 30px; vertical-align: middle; border: 0; margin-right: 5px;">
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
                                    <table align="center" border="0" cellpadding="0" cellspacing="0" style="margin: auto;">
                                        <tr>
                                            <td style="vertical-align: middle; text-align: center;">
                                                <a href="<?php echo $website; ?>" style="text-decoration: none; color: #004d82;">
                                                    <img height="30" src="https://firmas.lvs2.net/allcms/img/ico/web.png" alt="Website" style="width: 30px; vertical-align: middle; border: 0; margin-right: 5px;">
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
                                    <table align="center" border="0" cellpadding="0" cellspacing="0" style="margin: auto;">
                                        <tr>
                                            <td style="vertical-align: middle; text-align: center;">
                                                <a href="<?php echo $linkedin; ?>" style="text-decoration: none; color: #004d82;">
                                                    <img height="30" src="https://firmas.lvs2.net/allcms/img/ico/LinkedIn.png" alt="LinkedIn" style="width: 30px; vertical-align: middle; border: 0;">
                                                </a>
                                            </td>
                                        </tr>
                                    </table>
                                </td>                               
                            </tr>
                            </tbody> 
                            </table>
                        </td>

                        <td style="border-right: 1px solid  #7ed6f2; border-bottom: 1px solid  #7ed6f2;"></td>
                    
                    </tr>
                    
                    <tr>
                        <td>
                            <!-- Contenido -->
                        </td>
                        <td style="vertical-align: middle;" rowspan="2">
                            <!-- Contenido -->
                        </td>
                        <td style="background-color: #004D82; text-align: center; padding-bottom:1%; margin-top: 3%;">
                            <a href="<?php echo  $enlacesCE; ?>">
                                <img  height="40" width="100" style=" display: block; margin: auto;" src="https://firmas.lvs2.net/allcms/img/3.png">
                            </a>
                        </td>
                        <td>
                            <!-- Contenido -->
                        </td>
                    </tr>
                </tbody>
                </table>
            </td>
        </tr>
    </table>
<br/>
</div>
    <?php
}
if ($user['firma_webinar'] == 1) {
    $sql = "SELECT * FROM enlaces_permanentes";
    $stmt = $pdo->query($sql);
    $enlaces = $stmt->fetch(PDO::FETCH_ASSOC);
    $enlaces['webinars_button_url'];
    $enlaces['webinars_image_url'];

    $enlacesCE= $enlaces['webinars_button_url'];
    
    if($email == "enieto@allcms.es" )
    {
        $enlacesCE="https://forms.zohopublic.eu/assetdirectivosfinancieros/form/ALLCMSGestinderiesgosdefraudeenlospagosempresarial/formperma/e0ALRblJyK1PJafb3RJZKpq0xB_yR3fZ5FP54kK3MHI?utm_source=ASSET&utm_medium=Firma_Email&utm_campaign=Inscripcion_EN&utm_id=Webinar_Fraude_Oct24";
    }
    if($email == "ecalle@allcms.es" )
    {
        $enlacesCE="https://forms.zohopublic.eu/assetdirectivosfinancieros/form/ALLCMSGestinderiesgosdefraudeenlospagosempresarial/formperma/e0ALRblJyK1PJafb3RJZKpq0xB_yR3fZ5FP54kK3MHI?utm_source=ASSET&utm_medium=Firma_Email&utm_campaign=Inscripcion_EC&utm_id=Webinar_Fraude_Oct24";
    }
    if($email == "pbouaziz@allcms.es" )
    {
        $enlacesCE="https://forms.zohopublic.eu/assetdirectivosfinancieros/form/ALLCMSGestinderiesgosdefraudeenlospagosempresarial/formperma/e0ALRblJyK1PJafb3RJZKpq0xB_yR3fZ5FP54kK3MHI?utm_source=ASSET&utm_medium=Firma_Email&utm_campaign=Inscripcion_PB&utm_id=Webinar_Fraude_Oct24";
    }


echo '<hr style="margin-top: 100px; border: 0; height: 1px; background-image: linear-gradient(to right, rgba(0, 0, 0, 0), rgba(67, 133, 255, 0.75), rgba(0, 0, 0, 0));">';
echo '<h1 style="font-family: \'Montserrat\', sans-serif; color: #004D82; text-align: center; margin-top: 0; margin-bottom: 0;">Firma Webinar</h1>';
echo '<hr style="margin-bottom: 100px; border: 0; height: 1px; background-image: linear-gradient(to right, rgba(0, 0, 0, 0), rgba(67, 133, 255, 0.75), rgba(0, 0, 0, 0)); margin-bottom: 20px;">';
    // Mostrar el template de la firma de Casos de Éxito
    ?>
    <div style="width:800px;">
    <table cellspacing="0" cellpadding="0" hea style="font-family: 'Lato', sans-serif; font-size: 12px; color: #004D82;">
        <tr>
            <td style="vertical-align:middle">
                <img class="logo" height="200" style="width:100%;" src="https://firmas.lvs2.net/allcms/img/allcmslogo.png">
            </td>
            <td>
                <table cellspacing="0" cellpadding="0" width="610">
                    <thead>
                        <th style="width: 8%;"></th>
                        <th style="width: 3%;"></th>
                        <th style="width: 3%; padding-bottom: 20px; background-color: #004D82;"></th>
                        <th style="width: 4%;"></th>
                        <th style="width: 0%;"></th>
                    </thead>
                    <tbody>
                    <tr>
                        <td colspan="1" style="margin-left:5%; margin-top:3%;  border-left: 1px solid  #7ed6f2; border-top: 1px solid  #7ed6f2;">
                            <br>
                            <strong>
                                <h1 style="margin-left:5%; font-size: 20px; font-family: 'Lato', sans-serif; color:#004D82; margin-top: 0; margin-bottom: 0;"><?php echo $firstName; ?></h1>
                                <h1 style="margin-left:5%;font-size: 20px; font-family: 'Lato', sans-serif; color:#004D82; margin-top: 0; margin-bottom: 0;"><?php echo $lastName; ?></h1>
                            </strong>
                            <h2 style="margin-left:5%; font-size: 14.2px; font-family: 'Lato', sans-serif; color:#004D82; margin-top: 0; margin-bottom: 0;"><?php echo $position; ?></h2>
                        </td>
                        <td style=" border-top: 1px solid  #7ed6f2; vertical-align: middle;" rowspan="2">
                            <img style="display: block;" src="<?php echo $imagePath; ?>">
                        </td>
                         <td style="background-color: #004D82; text-align: center; vertical-align: middle;" rowspan="3">
                            <img height="100" width="120" style="width: 100%; max-width: 100%; margin: auto; display: block;" src="<?php echo $enlaces['webinars_image_url']; ?>">
                            
                                <p style="font-size: 18px; font-family: 'Lato', sans-serif; color: #ffffff; text-align: left; margin: 0; margin-left:8%">
                                    <strong><?php echo $enlaces['descripcion_webinar']; ?></strong>
                                </p>
                           
                        </td>
                        <td style=" border-right: 1px solid  #7ed6f2;  border-top: 1px solid  #7ed6f2;"></td>
                    </tr>
                    <tr>
                        <td style=" border-left: 1px solid  #7ed6f2; padding-top: 2%; padding-bottom: 3%;">
                            <table cellspacing="0" cellpadding="0" border="0" style="margin-left: 1%; margin-top:3%; width: 100%;">
                                <thead>
                                 <th></th>
                                 
                                </thead>
                             <tbody>
                                 <tr>
                                     <td style="background-color: #ffffff; vertical-align: middle; text-align: left; border-left: 1px solid #004d82;">
                                         <table align="left" border="0" cellpadding="0" cellspacing="0">
                                             <tr>
                                                 <td style="vertical-align: middle; text-align: center;">
                                                     <img height="20" src="https://firmas.lvs2.net/allcms/img/ico/Movil.png" alt="Móvil" style="width: 20px; vertical-align: middle; border: 0;">
                                                 </td>
                                                 <td style="vertical-align: middle; text-align: left; padding-left: 5px; padding-right: 10px;">
                                                     <span style="font-size: 11px; font-family: 'Lato', sans-serif; color: #004d82;"><?php echo $mobile;?></span>
                                                 </td>
                                                 <td style="vertical-align: middle; text-align: center;">
                                                 &nbsp <img height="20"  src="https://firmas.lvs2.net/allcms/img/ico/TelfFijo.png" alt="Teléfono Fijo" style="width: 20px; vertical-align: middle; border: 0;">
                                                 </td>
                                                 <td style="vertical-align: middle; text-align: left; padding-left: 5px;">
                                                     <span style="font-size: 11px; font-family: 'Lato', sans-serif; color: #004d82;"><?php echo $phone; ?></span>
                                                 </td>
                                             </tr>
                                         </table>
                                     </td>
                                 </tr>
                                 <tr>
                                     <td style="background-color: #ffffff; vertical-align: middle; text-align: left; border-left: 1px solid #004d82;">
                                         <table align="left" border="0" cellpadding="0" cellspacing="0">
                                             <tr>
                                                 <td style="vertical-align: middle; text-align: center;">
                                                     <img height="20" src="https://firmas.lvs2.net/allcms/img/ico/direccion.png" alt="Dirección" style="width: 20px; height: 20px; vertical-align: middle; border: 0;">
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
                        <td style=" border-right: 1px solid  #7ed6f2;">
                        
                        </td>
                        <td></td>
                    </tr>
                    <tr>
                        
                        <td colspan="2" style=" border-collapse:0;  border-left: 1px solid  #7ed6f2; border-bottom: 1px solid  #7ed6f2; ">
                             
                            <table  cellspacing="0" cellpadding="0"  style="margin-left: 5%; margin-right: 5%; background-color: #23a8e9; margin-top:6%;  ">
                                <thead>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    
                                </thead>
                                <tbody>
                            <tr>
                                <td style="padding: 4px; background-color: #23a8e9; vertical-align: middle; text-align: center; ">
                                    <table align="center" border="0" cellpadding="0" cellspacing="0" style="margin: auto;">
                                        <tr>
                                            <td style="vertical-align: middle; text-align: center;">
                                                <a href="mailto:<?php echo $email; ?>" style="text-decoration: none; color: #004d82;">
                                                    <img height="30" src="https://firmas.lvs2.net/allcms/img/ico/email.png" alt="Email" style="width: 30px; vertical-align: middle; border: 0; margin-right: 5px;">
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
                                    <table align="center" border="0" cellpadding="0" cellspacing="0" style="margin: auto;">
                                        <tr>
                                            <td style="vertical-align: middle; text-align: center;">
                                                <a href="<?php echo $website; ?>" style="text-decoration: none; color: #004d82;">
                                                    <img height="30" src="https://firmas.lvs2.net/allcms/img/ico/web.png" alt="Website" style="width: 30px; vertical-align: middle; border: 0; margin-right: 5px;">
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
                                    <table align="center" border="0" cellpadding="0" cellspacing="0" style="margin: auto;">
                                        <tr>
                                            <td style="vertical-align: middle; text-align: center;">
                                                <a href="<?php echo $linkedin; ?>" style="text-decoration: none; color: #004d82;">
                                                    <img height="30" src="https://firmas.lvs2.net/allcms/img/ico/LinkedIn.png" alt="LinkedIn" style="width: 30px; vertical-align: middle; border: 0;">
                                                </a>
                                            </td>
                                        </tr>
                                    </table>
                                </td>                               
                            </tr>
                            </tbody> 
                            </table>
                        </td>

                        <td style="border-right: 1px solid  #7ed6f2; border-bottom: 1px solid  #7ed6f2;"></td>
                    
                    </tr>
                    
                    <tr>
                        <td>
                            <!-- Contenido -->
                        </td>
                        <td style="vertical-align: middle;" rowspan="2">
                            <!-- Contenido -->
                        </td>
                        <td style="background-color: #004D82; text-align: center; padding-bottom:1%; margin-top: 3%;">
                            <a href="<?php echo  $enlacesCE; ?>">
                                <img  height="40" width="100" style=" display: block; margin: auto;" src="https://firmas.lvs2.net/allcms/img/4.png">
                            </a>
                        </td>
                        <td>
                            <!-- Contenido -->
                        </td>
                    </tr>
                </tbody>
                </table>
            </td>
        </tr>
    </table>
<br/>
</div>
    <?php
}
?>
<?php /***

echo '<hr style="margin-top: 100px; border: 0; height: 1px; background-image: linear-gradient(to right, rgba(0, 0, 0, 0), rgba(67, 133, 255, 0.75), rgba(0, 0, 0, 0));">';
            echo '<h1 style="font-family: \'Montserrat\', sans-serif; color: #004D82; text-align: center; margin-top: 0; margin-bottom: 0;">Firma Simple Navidad</h1>';
            echo '<hr style="margin-bottom: 100px; border: 0; height: 1px; background-image: linear-gradient(to right, rgba(0, 0, 0, 0), rgba(67, 133, 255, 0.75), rgba(0, 0, 0, 0)); margin-bottom: 20px;">';
?>


<div style="width:700px;">
    <table cellspacing="0" cellpadding="0" style="font-family: 'Lato', sans-serif; font-size: 12px; color: #004D82;">
        <tr>
            <td style="vertical-align:middle">
                <img height="200" style="width: 100%;" src="https://firmas.lvs2.net/allcms/img/allcmslogo.png">
            </td>
            <td>
                <table cellspacing="0" cellpadding="0" width="450">
                    <tbody>
                    <tr>
                        <td colspan="1" style="margin-left:5%; width:70%; margin-top:3%;">
                            <strong>
                                <h1 style="margin-left:5%; font-size: 20px; font-family: 'Lato', sans-serif; color:#004D82; margin-top: 0; margin-bottom: 0;"><?php echo $firstName ?> <?php echo $lastName ?></h1>
                            </strong>
                            <h2 style="margin-left:5%; font-size: 14.2px; font-family: 'Lato', sans-serif; color:#004D82; margin-top: 0; margin-bottom: 0;"><?php echo $position ?></h2>
                        </td>
                        <td></td>
                        <td style="vertical-align: middle;" rowspan="2">
                            <img style="width: 80%; margin: 5%; display: block;" src="<?php echo $imagePath ?>">
                        </td>
                    </tr>
                    <tr>
                        <td colspan="1" style=" border-collapse:0; padding-top: 2%;" >
                            <table cellspacing="0" cellpadding="0" border="0" style="margin-left: 5%; margin-top:3%; width: 100%;">
                               <tbody>
                                <tr>
                                    <td style="background-color: #ffffff; vertical-align: middle; text-align: left; border-left: 1px solid #004d82;">
                                        <table align="left" border="0" cellpadding="0" cellspacing="0">
                                            <tr>
                                                <td style="vertical-align: middle; text-align: center;">
                                                    <img height="20" src="https://firmas.lvs2.net/allcms/img/ico/Movil.png" alt="Móvil" style="width: 20px; vertical-align: middle; border: 0;">
                                                </td>
                                                <td style="vertical-align: middle; text-align: left; padding-left: 5px;">
                                                    <span style="font-size: 11px; font-family: 'Lato', sans-serif; color: #004d82;"><?php echo $mobile ?></span>
                                                </td>
                                                <td style="vertical-align: middle; text-align: center;">
                                                    &nbsp <img height="20"  src="https://firmas.lvs2.net/allcms/img/ico/TelfFijo.png" alt="Teléfono Fijo" style="width: 20px; vertical-align: middle; border: 0;">
                                                </td>
                                                <td style="vertical-align: middle; text-align: left; padding-left: 5px;">
                                                    <span style="font-size: 11px; font-family: 'Lato', sans-serif; color: #004d82;"><?php echo $phone ?></span>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="background-color: #ffffff; vertical-align: middle; text-align: left; border-left: 1px solid #004d82;">
                                        <table align="left" border="0" cellpadding="0" cellspacing="0">
                                            <tr>
                                                <td style="vertical-align: middle; text-align: center;">
                                                    <img height="20" src="https://firmas.lvs2.net/allcms/img/ico/direccion.png" alt="Dirección" style="width: 20px; height: 20px; vertical-align: middle; border: 0;">
                                                </td>
                                                <td style="vertical-align: middle; text-align: left; padding-left: 5px;">
                                                    <span style="font-size: 11px; font-family: 'Lato', sans-serif; color: #004d82;"><?php echo $address ?></span>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </tbody>
                            </table>
                        </td>  
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td colspan="3" style="border-collapse:0; padding-top: 2%;">
                            <table  cellspacing="0" cellpadding="0" style="width: 60%; height: 100%; margin-left: 5%; margin-right: 5%; background-color: #23a8e9; margin-top:3%;">
                                <tbody>
                            <tr>
                                <td style="padding: 4px; background-color: #23a8e9; vertical-align: middle; text-align: center;">
                                    <table align="center" border="0" cellpadding="0" cellspacing="0" style="margin: auto;">
                                        <tr>
                                            <td style="vertical-align: middle; text-align: center;">
                                                <a href="mailto:<?php echo $email ?>" style="text-decoration: none; color: #004d82;">
                                                    <img height="30" src="https://firmas.lvs2.net/allcms/img/ico/email.png" alt="Email" style="width: 30px; vertical-align: middle; border: 0; margin-right: 5px;">
                                                </a>
                                            </td>
                                            <td style="vertical-align: middle; text-align: center;">
                                                <a href="mailto:<?php echo $email ?>" style="text-decoration: none; color: #004d82;">
                                                    <span style="font-size: 11px; font-family: 'Lato', sans-serif; color: #004d82;"><?php echo $email ?></span>
                                                </a>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                                <td style="background-color: #23a8e9; vertical-align: middle; text-align: center;">
                                    <table align="center" border="0" cellpadding="0" cellspacing="0" style="margin: auto;">
                                        <tr>
                                            <td style="vertical-align: middle; text-align: center;">
                                                <a href="<?php echo $website ?>" style="text-decoration: none; color: #004d82;">
                                                    <img height="30" src="https://firmas.lvs2.net/allcms/img/ico/web.png" alt="Website" style="width: 30px; vertical-align: middle; border: 0; margin-right: 5px;">
                                                </a>
                                            </td>
                                            <td style="vertical-align: middle; text-align: center;">
                                                <a href="<?php echo $website ?>" style="text-decoration: none; color: #004d82;">
                                                    <span style="font-size: 11px; font-family: 'Lato', sans-serif; color: #004d82;"><?php echo $empresa ?></span>
                                                </a>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                                <td style="padding: 4px; background-color: #23a8e9; vertical-align: middle; text-align: center;">
                                    <table align="center" border="0" cellpadding="0" cellspacing="0" style="margin: auto;">
                                        <tr>
                                            <td style="vertical-align: middle; text-align: center;">
                                                <a href="<?php echo $linkedin ?>" style="text-decoration: none; color: #004d82;">
                                                    <img height="30" src="https://firmas.lvs2.net/allcms/img/ico/LinkedIn.png" alt="LinkedIn" style="width: 30px; vertical-align: middle; border: 0;">
                                                </a>
                                            </td>
                                        </tr>
                                    </table>
                                </td>                               
                            </tr>
                            </tbody> 
                            </table>
                        </td>
                        <td></td>
                        <td></td>
                    </tr>
                </tbody>
                </table>
            </td>
        </tr>
    </table>
<br/>
<img src="https://firmas.lvs2.net/allcms/img/Consultores_Feliz_2025.png" alt="" style=" vertical-align: middle; border: 0;">
</div>
**/?>

</body>
</html>