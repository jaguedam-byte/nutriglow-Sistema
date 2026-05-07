<p>Hola {{ $invoice->cliente_nombre }},</p>

<p>Te compartimos tu factura generada en Nutri Glow Admin.</p>

<p>
    <strong>No. factura:</strong> {{ $invoice->invoice_number }}<br>
    <strong>Fecha:</strong> {{ $invoice->billed_at->format('d/m/Y') }}<br>
    <strong>Hora:</strong> {{ $invoice->billed_at->format('H:i') }}<br>
    <strong>Total:</strong> Q {{ number_format($invoice->total, 2) }}
</p>

<p>La factura va adjunta en PDF en este mismo correo.</p>

<p>Gracias por confiar en nosotros.</p>
