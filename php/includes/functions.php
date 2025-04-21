<?php

// Función para sanitizar entradas y evitar inyecciones SQL
function sanitizeInput($input) {
    return htmlspecialchars(trim($input), ENT_QUOTES, 'UTF-8');
}

// Función para validar el formato de correo electrónico
function validateEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
}

// Función para mostrar mensajes de error o éxito
function showMessage($message, $type = 'success') {
    if ($type === 'success') {
        echo "<div class='alert alert-success'>$message</div>";
    } else {
        echo "<div class='alert alert-danger'>$message</div>";
    }
}

// Función para manejar las consultas preparadas con MySQLi
function executeQuery($conn, $query, $params = []) {
    $stmt = $conn->prepare($query);

    // Si hay parámetros, los vinculamos
    if (!empty($params)) {
        $types = str_repeat('s', count($params)); // Asumimos que todos los parámetros son cadenas (si hay diferentes tipos, ajusta esto)
        $stmt->bind_param($types, ...$params);
    }

    $stmt->execute();
    return $stmt;
}

// Función para subir archivos (como imagenes de avatar)
function uploadFile($file, $targetDir = "uploads/") {
    $targetFile = $targetDir . basename($file["name"]);
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    // Comprobar si el archivo es una imagen
    if (getimagesize($file["tmp_name"]) === false) {
        showMessage("El archivo no es una imagen válida.", "error");
        return false;
    }

    // Comprobar el tamaño del archivo (por ejemplo, 2MB)
    if ($file["size"] > 2000000) {
        showMessage("El archivo es demasiado grande.", "error");
        return false;
    }

    // Intentar mover el archivo al directorio de destino
    if (move_uploaded_file($file["tmp_name"], $targetFile)) {
        return $targetFile;
    } else {
        showMessage("Hubo un error al subir el archivo.", "error");
        return false;
    }
}
?>
