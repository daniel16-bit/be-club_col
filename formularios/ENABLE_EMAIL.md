## Cómo reactivar el envío de correo (PHPMailer) — guía rápida

Este repositorio tiene el envío de correo deshabilitado por seguridad. Sigue estos pasos cuando quieras reactivar el envío de forma segura:

1. Instala PHPMailer con Composer (recomendado):

   - En la raíz del proyecto ejecuta:

     composer require phpmailer/phpmailer

   - Luego en `formulario.php` reemplaza las inclusiones manuales por:

     require __DIR__ . '/../vendor/autoload.php';

2. No añadas credenciales al código fuente. Usa variables de entorno o un archivo de configuración que no se incluya en Git (p. ej. `.env`). Ejemplo usando variables de entorno en PHP:

```php
$mail->Username = getenv('SMTP_USER');
$mail->Password = getenv('SMTP_PASS');
$mail->Host = getenv('SMTP_HOST') ?: 'smtp.gmail.com';
$mail->Port = getenv('SMTP_PORT') ?: 587;
$mail->SMTPSecure = getenv('SMTP_SECURE') ?: 'tls';
```

3. Para desarrollo/fase de pruebas usa servicios de buzón de pruebas (ej. Mailtrap) para no enviar correos reales.

4. Asegúrate de manejar errores sin revelar información sensible al usuario. Loguea los errores en archivos de logs que estén fuera del `wwwroot`.

5. Si alguna credencial ha sido expuesta, revócala/rotala inmediatamente (por ejemplo, revocar App Password de Gmail).

6. Recomendación adicional: crea un archivo `.env.example` con las claves de configuración necesarias (sin valores) y añádelo al repositorio para que otros sepan qué variables establecer.

Ejemplo mínimo de `.env.example`:

```
# SMTP settings
SMTP_HOST=smtp.gmail.com
SMTP_PORT=587
SMTP_USER=you@example.com
SMTP_PASS=your_app_password
SMTP_SECURE=tls
```

Con esto podrás reactivar PHPMailer de forma segura cuando lo necesites.
