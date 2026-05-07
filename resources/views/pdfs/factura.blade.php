<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Factura {{ $invoiceNumber }}</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            color: #1f2a3d;
            font-size: 12px;
            margin: 0;
            padding: 28px;
        }

        .header {
            border-bottom: 2px solid #1aa7ff;
            padding-bottom: 14px;
            margin-bottom: 24px;
        }

        .brand {
            font-size: 24px;
            font-weight: 800;
            color: #0f62fe;
            margin-bottom: 4px;
        }

        .subtitle {
            color: #5b6b84;
            font-size: 12px;
        }

        .meta {
            width: 100%;
            margin-bottom: 20px;
        }

        .meta td {
            vertical-align: top;
            padding: 4px 0;
        }

        .meta-label {
            font-weight: 700;
            color: #4b5f80;
            width: 130px;
        }

        .section-title {
            font-size: 15px;
            font-weight: 800;
            margin: 18px 0 10px;
            color: #22334f;
        }

        table.items {
            width: 100%;
            border-collapse: collapse;
            margin-top: 8px;
        }

        table.items th,
        table.items td {
            border: 1px solid #d7e2ef;
            padding: 10px 12px;
        }

        table.items th {
            background: #eff6ff;
            text-align: left;
            color: #33537c;
        }

        table.items td.amount,
        .totals td.amount {
            text-align: right;
        }

        .totals {
            width: 320px;
            margin-left: auto;
            margin-top: 18px;
            border-collapse: collapse;
        }

        .totals td {
            border: 1px solid #d7e2ef;
            padding: 10px 12px;
        }

        .totals .label {
            font-weight: 700;
            background: #f7fbff;
        }

        .totals .grand-total td {
            background: #0f62fe;
            color: #ffffff;
            font-weight: 800;
            font-size: 14px;
        }

        .footer {
            margin-top: 28px;
            color: #6c7f99;
            font-size: 11px;
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="brand">Nutri Glow Admin</div>
        <div class="subtitle">Factura generada desde el panel administrativo</div>
    </div>

    <table class="meta">
        <tr>
            <td style="width:50%;padding-right:20px;">
                <div class="section-title">Datos del cliente</div>
                <table>
                    <tr>
                        <td class="meta-label">Nombre:</td>
                        <td>{{ $clienteNombre }}</td>
                    </tr>
                    <tr>
                        <td class="meta-label">Correo:</td>
                        <td>{{ $clienteCorreo }}</td>
                    </tr>
                    <tr>
                        <td class="meta-label">DPI:</td>
                        <td>{{ $clienteDpi ?: 'No registrado' }}</td>
                    </tr>
                </table>
            </td>
            <td style="width:50%;padding-left:20px;">
                <div class="section-title">Datos de la factura</div>
                <table>
                    <tr>
                        <td class="meta-label">No. factura:</td>
                        <td>{{ $invoiceNumber }}</td>
                    </tr>
                    <tr>
                        <td class="meta-label">Fecha:</td>
                        <td>{{ $generatedAt->format('d/m/Y') }}</td>
                    </tr>
                    <tr>
                        <td class="meta-label">Hora:</td>
                        <td>{{ $generatedAt->format('H:i') }}</td>
                    </tr>
                    <tr>
                        <td class="meta-label">Generada por:</td>
                        <td>{{ $generatedBy }}</td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>

    <div class="section-title">Detalle</div>
    <table class="items">
        <thead>
            <tr>
                <th>Concepto</th>
                <th style="width:160px;">Monto</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Costo de la cita</td>
                <td class="amount">Q {{ number_format($citaCosto, 2) }}</td>
            </tr>
            @forelse ($extras as $extra)
                <tr>
                    <td>{{ $extra['descripcion'] ?: 'Compra adicional' }}</td>
                    <td class="amount">Q {{ number_format($extra['monto'], 2) }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="2">No se registraron compras adicionales.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <table class="totals">
        <tr>
            <td class="label">Cita</td>
            <td class="amount">Q {{ number_format($citaCosto, 2) }}</td>
        </tr>
        <tr>
            <td class="label">Compras extra</td>
            <td class="amount">Q {{ number_format($extrasTotal, 2) }}</td>
        </tr>
        <tr class="grand-total">
            <td>Total</td>
            <td class="amount">Q {{ number_format($total, 2) }}</td>
        </tr>
    </table>

    <div class="footer">
        Documento generado automaticamente por Nutri Glow Admin.
    </div>
</body>
</html>
