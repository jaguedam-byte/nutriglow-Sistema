<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Cita programada</title>
</head>
<body style="font-family: Arial, sans-serif; background:#f4f7fb; color:#1f2937; padding:24px;">
    <div style="max-width:560px;margin:0 auto;background:#ffffff;border-radius:16px;padding:32px;border:1px solid #dbe4f0;">
        <h1 style="margin-top:0;">Cita programada</h1>
        <p>Hola, {{ $appointment->cliente_nombre }}.</p>
        <p>Tu cita ya fue programada en el sistema.</p>
        <div style="margin:24px 0;padding:18px 22px;background:#0f172a;color:#ffffff;border-radius:14px;">
            <p style="margin:0 0 10px;"><strong>Dia:</strong> {{ $appointment->appointment_at->timezone(config('app.timezone'))->translatedFormat('d/m/Y') }}</p>
            <p style="margin:0;"><strong>Hora:</strong> {{ $appointment->appointment_at->timezone(config('app.timezone'))->format('H:i') }}</p>
        </div>
        <p>Si necesitas reprogramarla, comunicate con el administrador.</p>
        <p style="margin-bottom:0;">Nutri Glow Admin</p>
    </div>
</body>
</html>
