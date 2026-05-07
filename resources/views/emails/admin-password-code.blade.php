<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Codigo de cambio de contrasena</title>
</head>
<body style="font-family: Arial, sans-serif; background:#f4f7fb; color:#1f2937; padding:24px;">
    <div style="max-width:560px;margin:0 auto;background:#ffffff;border-radius:16px;padding:32px;border:1px solid #dbe4f0;">
        <h1 style="margin-top:0;">Cambio de contrasena para administrador</h1>
        <p>Hola, {{ $user->name }}.</p>
        <p>Este es tu codigo para autorizar el cambio de contrasena:</p>
        <div style="font-size:32px;font-weight:800;letter-spacing:10px;padding:18px 22px;background:#0f172a;color:#ffffff;border-radius:14px;text-align:center;">
            {{ $code }}
        </div>
        <p style="margin-top:20px;">El codigo vence en 10 minutos.</p>
        <p>Si no solicitaste este cambio, ignora este mensaje.</p>
    </div>
</body>
</html>
