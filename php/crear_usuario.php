<?php
// Requiere la conexión a la base de datos
require_once 'conexion.php';  // Incluye el archivo que contiene la clase de conexión a la base de datos.

// Usamos PHPMailer para enviar correos electrónicos
use PHPMailer\PHPMailer\PHPMailer;   // Carga la clase PHPMailer.
use PHPMailer\PHPMailer\Exception;   // Carga la clase de excepciones de PHPMailer.

// Validación y creación del usuario
if ($_SERVER['REQUEST_METHOD'] == 'POST') {  // Verifica si la solicitud es de tipo POST (cuando se envía el formulario).
    // Recibir datos del formulario
    $correo = $_POST['correo'];  // Obtiene el correo electrónico del formulario.
    $empresa = $_POST['empresa'];  // Obtiene la empresa seleccionada del formulario.

    // Validar el correo y la empresa
    if (filter_var($correo, FILTER_VALIDATE_EMAIL) && !empty($empresa)) {  
        // Validación del correo electrónico utilizando FILTER_VALIDATE_EMAIL.
        // Asegura que el correo sea válido y que el campo de la empresa no esté vacío.

        // Conectar a la base de datos
        $db = new DB();  // Crea una instancia de la clase DB (que contiene la lógica de conexión a la base de datos).
        $conn = $db->getConnection();  // Obtiene la conexión activa a la base de datos.

        // Insertar el nuevo usuario en la base de datos
        $stmt = $conn->prepare("INSERT INTO Usuario (correo, id_empresa, aprobado) VALUES (:correo, :empresa, 0)"); 
        // Prepara la consulta SQL para insertar un nuevo usuario. Se asigna '0' al campo 'aprobado' (pendiente de aprobación).
        
        $stmt->bindParam(':correo', $correo);  // Asocia el valor de la variable '$correo' al parámetro ':correo' en la consulta SQL.
        $stmt->bindParam(':empresa', $empresa);  // Asocia el valor de la variable '$empresa' al parámetro ':empresa' en la consulta SQL.
        
        $stmt->execute();  // Ejecuta la consulta de inserción en la base de datos.

        // Obtener el ID del nuevo usuario
        $usuario_id = $conn->lastInsertId();  // Obtiene el ID del último usuario insertado en la base de datos.

        // Enviar correo con la contraseña temporal
        $contraseña_temporal = bin2hex(random_bytes(8));  // Genera una contraseña temporal de 8 bytes y la convierte en hexadecimal.
        enviarCorreo($correo, $contraseña_temporal);  // Llama a la función 'enviarCorreo' para enviar el correo con la contraseña temporal.

        echo "Usuario creado correctamente. Ahora espera la aprobación.";  // Mensaje de éxito al gestor indicando que el usuario fue creado.
    } else {
        echo "Por favor, rellene todos los campos correctamente.";  // Mensaje de error si el correo no es válido o la empresa no está seleccionada.
    }
}

// Función para enviar el correo al usuario con su contraseña temporal
function enviarCorreo($correo, $contraseña_temporal) {  
    // Esta función se encarga de enviar un correo con la contraseña temporal al usuario.

    $mail = new PHPMailer(true);  // Crea una nueva instancia de PHPMailer.
    try {
        $mail->setFrom('no-reply@lvs2.com', 'Gestor');  
        // Define la dirección de correo del remitente ('no-reply@lvs2.com') y el nombre del remitente ('Gestor').

        $mail->addAddress($correo);  // Añade la dirección de correo del destinatario (el usuario al que se le va a enviar la contraseña).

        $mail->isHTML(true);  // Establece que el contenido del correo será HTML.
        $mail->Subject = 'Acceso a la plataforma';  // Define el asunto del correo.

        // Cuerpo del correo
        $mail->Body    = 'Su contraseña temporal es: ' . $contraseña_temporal;  
        // El cuerpo del correo contiene un mensaje que incluye la contraseña temporal generada.

        // Enviar el correo
        $mail->send();  // Intenta enviar el correo.
    } catch (Exception $e) {
        echo "Error al enviar el correo: {$mail->ErrorInfo}";  // Si ocurre algún error, muestra el mensaje de error.
    }
}
?>
