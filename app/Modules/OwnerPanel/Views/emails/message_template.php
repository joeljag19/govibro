<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Mensaje sobre tu reserva</title>
</head>
<body style="font-family: Arial, sans-serif; color: #333; line-height: 1.6;">
    <div style="max-width: 600px; margin: auto; padding: 20px; border: 1px solid #ddd; border-radius: 8px;">
        <h2 style="color: #0056b3;">Hola <?= esc($customer_name) ?>,</h2>
        <p>Has recibido un mensaje de <strong><?= esc($owner_name) ?></strong> (proveedor del tour) sobre tu reserva para <strong>"<?= esc($tour_title) ?>"</strong>.</p>
        <hr style="border: 0; border-top: 1px solid #eee;">
        <div style="background-color: #f9f9f9; padding: 15px; border-radius: 5px; margin: 20px 0;">
            <p style="margin: 0;"><?= nl2br(esc($message_content)) ?></p>
        </div>
        <hr style="border: 0; border-top: 1px solid #eee;">
        <p>Si necesitas responder, por favor, contacta directamente a nuestro equipo de soporte en GoVibro. No respondas a este correo.</p>
        <p>¡Gracias por usar GoVibro!</p>
    </div>
</body>
</html>
