<?php
$receiving_email_address = 'ku.gonzalezduocuc.cl'; // reemplázar por gmail 

// Validación de campos
$name    = isset($_POST['name']) ? strip_tags(trim($_POST['name'])) : '';
$email   = isset($_POST['email']) ? filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL) : '';
$subject = isset($_POST['subject']) ? strip_tags(trim($_POST['subject'])) : '';
$message = isset($_POST['message']) ? trim($_POST['message']) : '';

if (!$name || !$email || !$subject || !$message || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    http_response_code(400);
    echo 'Completa todos los campos correctamente.';
    exit;
}

// Armado del mensaje
$headers = "From: $name <$email>\r\n";
$headers .= "Reply-To: $email\r\n";
$full_message = "Nombre: $name\nEmail: $email\n\nAsunto: $subject\n\nMensaje:\n$message";

if (mail($receiving_email_address, $subject, $full_message, $headers)) {
    http_response_code(200);
    echo "Mensaje enviado correctamente.";
} else {
    http_response_code(500);
    echo "Ocurrió un error al enviar el mensaje.";
}

http_response_code(200);
echo "Mensaje simulado. Datos recibidos:<br>";
echo "Nombre: $name<br>";
echo "Email: $email<br>";
echo "Asunto: $subject<br>";
echo "Mensaje: $message";
?>
