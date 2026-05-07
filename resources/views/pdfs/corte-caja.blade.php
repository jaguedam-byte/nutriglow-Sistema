<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Corte de caja {{ $cutNumber }}</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; color:#1f2a3d; font-size:12px; margin:0; padding:28px; }
        .header { border-bottom:2px solid #17a5ff; padding-bottom:14px; margin-bottom:22px; }
        .brand { font-size:24px; font-weight:800; color:#0f62fe; }
        .subtitle { color:#6c7f99; margin-top:4px; }
        .summary { width:100%; margin:18px 0 20px; border-collapse:collapse; }
        .summary td { padding:8px 10px; border:1px solid #d7e2ef; }
        .summary .label { width:180px; font-weight:700; background:#f5f9ff; }
        table.items { width:100%; border-collapse:collapse; margin-top:10px; }
        table.items th, table.items td { border:1px solid #d7e2ef; padding:10px 12px; vertical-align:top; }
        table.items th { background:#eff6ff; color:#33537c; text-align:left; }
        .amount { text-align:right; white-space:nowrap; }
        .footer { margin-top:24px; color:#6c7f99; font-size:11px; }
    </style>
</head>
<body>
    <div class="header">
        <div class="brand">Nutri Glow Admin</div>
        <div class="subtitle">Corte de caja generado desde Auditoria</div>
    </div>

    <table class="summary">
        <tr>
            <td class="label">No. de corte</td>
            <td>{{ $cutNumber }}</td>
        </tr>
        <tr>
            <td class="label">Fecha</td>
            <td>{{ $generatedAt->format('d/m/Y') }}</td>
        </tr>
        <tr>
            <td class="label">Hora</td>
            <td>{{ $generatedAt->format('H:i') }}</td>
        </tr>
        <tr>
            <td class="label">Generado por</td>
            <td>{{ $generatedBy }}</td>
        </tr>
        <tr>
            <td class="label">Ultimo corte previo</td>
            <td>{{ $lastCashCut ? $lastCashCut->cut_at->format('d/m/Y H:i') : 'No existe corte previo' }}</td>
        </tr>
        <tr>
            <td class="label">Clientes facturados</td>
            <td>{{ $invoiceCount }}</td>
        </tr>
        <tr>
            <td class="label">Total acumulado</td>
            <td>Q {{ number_format($total, 2) }}</td>
        </tr>
    </table>

    <table class="items">
        <thead>
            <tr>
                <th>Factura</th>
                <th>Cliente</th>
                <th>Fecha</th>
                <th>Cita</th>
                <th>Extras</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($invoices as $invoice)
                <tr>
                    <td>{{ $invoice->invoice_number }}</td>
                    <td>{{ $invoice->cliente_nombre }}</td>
                    <td>{{ $invoice->billed_at->format('d/m/Y H:i') }}</td>
                    <td class="amount">Q {{ number_format($invoice->cita_costo, 2) }}</td>
                    <td>
                        @php
                            $extras = collect($invoice->extras ?? []);
                        @endphp
                        @if ($extras->isEmpty())
                            Sin extras
                        @else
                            @foreach ($extras as $extra)
                                <div>{{ $extra['descripcion'] ?: 'Compra adicional' }} - Q {{ number_format((float) ($extra['monto'] ?? 0), 2) }}</div>
                            @endforeach
                        @endif
                    </td>
                    <td class="amount">Q {{ number_format($invoice->total, 2) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        Documento generado automaticamente por Nutri Glow Admin.
    </div>
</body>
</html>
