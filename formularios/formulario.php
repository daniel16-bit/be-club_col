<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Incluir PHPMailer (ajusta la ruta si usas Composer o ZIP manual)
require '../PHPMailer-master/src/Exception.php';
require '../PHPMailer-master/src/PHPMailer.php';
require '../PHPMailer-master/src/SMTP.php';

$mensaje = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $correo = $_POST['email'];
    $telefono = $_POST['telefono'];
    $asunto = $_POST['asunto'];
    $mensajeUsuario = $_POST['mensaje'];
    $como = $_POST['como'];
    $area = $_POST['area'];

    $mail = new PHPMailer(true);

    try {
        // Configuración SMTP (Gmail)
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'camargocamargodaniel0@gmail.com';  // Tu Gmail
        $mail->Password = 'pzwq prdw volx iobo';           // Tu clave app
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        // Remitente y destinatario
        $mail->setFrom('camargocamargodaniel0@gmail.com', $nombre);
        $mail->addAddress('camargocamargodaniel0@gmail.com');

        // HTML
        $mail->isHTML(true);
        $mail->Subject = $asunto;

        // ✅ Cuerpo del correo con diseño y logo
        $mail->Body = "
            <div style='font-family: Arial, sans-serif; font-size:16px; max-width:600px; margin:auto; padding:20px; border:1px solid #ddd; border-radius:8px; background:#f9f9f9;'>

                <div style='text-align:center; margin-bottom:20px;'>
                    <img src='https://imgur.com/a/LnKXAWG' alt='' style='max-width:180px; height:auto;'>
                </div>

                <h2 style='color:#2c3e50;'>📩 Nuevo mensaje de contacto</h2>

                <p><strong>👤 Nombre:</strong> <span style='font-size:18px;'>$nombre</span></p>
                <p><strong>✉️ Correo:</strong> <span style='font-size:18px;'>$correo</span></p>
                <p><strong>📞 Teléfono:</strong> <span style='font-size:18px;'>$telefono</span></p>
                <p><strong>📝 Asunto:</strong> <span style='font-size:18px;'>$asunto</span></p>

                <hr style='margin:20px 0;'>

                <p><strong>💬 Mensaje:</strong></p>
                <p style='background:#fff; padding:10px; border:1px solid #ccc; border-radius:5px; font-size:17px;'>$mensajeUsuario</p>

                <hr style='margin:20px 0;'>

                <p><strong>📢 ¿Cómo se enteró?:</strong> $como</p>
                <p><strong>🎯 Área de interés:</strong> $area</p>

                <p style='margin-top:30px; font-size:14px; color:#888;'>Enviado desde el sitio web del Club Deportivo</p>
            </div>
        ";

        $mail->send();
        $mensaje = '<p style="color: green;">✅ El mensaje ha sido enviado correctamente.</p>';
    } catch (Exception $e) {
        $mensaje = '<p style="color: red;">❌ Error al enviar el mensaje: ' . $mail->ErrorInfo . '</p>';
    }
}
?>

<!-- HTML del formulario -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Contacto - Club Deportivo</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">
    <h1>Formulario de Contacto</h1>
    <form action="" method="post">
        <label for="nombre">Nombre Completo:</label>
        <input type="text" id="nombre" name="nombre" value="<?= $_POST['nombre'] ?? '' ?>" required>

        <label for="email">Correo Electrónico:</label>
        <input type="email" id="email" name="email" value="<?= $_POST['email'] ?? '' ?>" required>

        <label for="telefono">Teléfono de Contacto (opcional):</label>
        <input type="text" id="telefono" name="telefono" value="<?= $_POST['telefono'] ?? '' ?>">

        <label for="asunto">Asunto:</label>
        <input type="text" id="asunto" name="asunto" value="<?= $_POST['asunto'] ?? '' ?>" required>

        <label for="mensaje">Mensaje:</label>
        <textarea id="mensaje" name="mensaje" rows="4" required><?= $_POST['mensaje'] ?? '' ?></textarea>

        <label for="como">¿Cómo te enteraste de nuestro club?</label>
        <select id="como" name="como" required>
            <option value="">Selecciona una opción</option>
            <option value="redes_sociales" <?= (($_POST['como'] ?? '') == 'redes_sociales') ? 'selected' : '' ?>>Redes sociales</option>
            <option value="recomendacion" <?= (($_POST['como'] ?? '') == 'recomendacion') ? 'selected' : '' ?>>Recomendación</option>
            <option value="publicidad" <?= (($_POST['como'] ?? '') == 'publicidad') ? 'selected' : '' ?>>Publicidad</option>
            <option value="otro" <?= (($_POST['como'] ?? '') == 'otro') ? 'selected' : '' ?>>Otro</option>
        </select>

        <label for="area">¿Qué área te interesa más?</label>
        <select id="area" name="area" required>
            <option value="">Selecciona un área</option>
            <option value="inscripcion" <?= (($_POST['area'] ?? '') == 'inscripcion') ? 'selected' : '' ?>>Inscripción</option>
            <option value="informacion" <?= (($_POST['area'] ?? '') == 'informacion') ? 'selected' : '' ?>>Información</option>
            <option value="voluntariado" <?= (($_POST['area'] ?? '') == 'voluntariado') ? 'selected' : '' ?>>Voluntariado</option>
            <option value="otro" <?= (($_POST['area'] ?? '') == 'otro') ? 'selected' : '' ?>>Otro</option>
        </select>

        <label>
            <input type="checkbox" name="terminos" required <?= isset($_POST['terminos']) ? 'checked' : '' ?>> Acepto los términos y condiciones
        </label>

        <button type="submit">Enviar</button>
    </form>

    <!-- Mostrar mensaje de envío -->
    <?= $mensaje ?>

    <div class="ubicacion">
        <h2>Ubicación del Club Deportivo</h2>
        <address>
            Calle Ejemplo, 123<br>
            Ciudad, País<br>
            CP 12345
        </address>

        <div class="mapa">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d63623.18732448249!2d-74.1394275263123!3d4.6917374873917606!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8e3f9ba1c08ec19d%3A0x5f9ec486a1e86b08!2sPista%20Atletismo!5e0!3m2!1ses-419!2sco!4v1738168649365!5m2!1ses-419!2sco" width="325" height="225" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
        </div>
    </div>
</div>

</body>
</html>




