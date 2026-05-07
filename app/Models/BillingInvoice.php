<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BillingInvoice extends Model
{
    protected $fillable = [
        'invoice_number',
        'usariosapp_id',
        'cliente_nombre',
        'cliente_correo',
        'cliente_dpi',
        'cita_costo',
        'extras',
        'extras_total',
        'total',
        'generated_by_user_id',
        'billed_at',
    ];

    protected $casts = [
        'extras' => 'array',
        'cita_costo' => 'float',
        'extras_total' => 'float',
        'total' => 'float',
        'billed_at' => 'datetime',
    ];

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'generated_by_user_id');
    }

    public function usariosapp(): BelongsTo
    {
        return $this->belongsTo(Usariosapp::class);
    }
}
