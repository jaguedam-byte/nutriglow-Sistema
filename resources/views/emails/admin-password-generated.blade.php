<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Nueva contrasena de administrador</title>
</head>
<body style="font-family: Arial, sans-serif; background:#f4f7fb; color:#1f2937; padding:24px;">
    <div style="max-width:560px;margin:0 auto;background:#ffffff;border-radius:16px;padding:32px;border:1px solid #dbe4f0;">
        <h1 style="margin-top:0;">Nueva contrasena generada</h1>
        <p>Hola, {{ $user->name }}.</p>
        <p>Tu nueva contrasena de administrador ya fue generada con las reglas de seguridad del sistema:</p>
        <div style="font-size:24px;font-weight:800;letter-spacing:2px;padding:18px 22px;background:#0f172a;color:#ffffff;border-radius:14px;text-align:center;word-break:break-all;">
            {{ $password }}
        </div>
        <p style="margin-top:20px;">Recomendacion: ingresa cuanto antes y guardala en un lugar seguro.</p>
        <p>Si no solicitaste este cambio, avisa al administrador del sistema de inmediato.</p>
    </div>
</body>
</html>
