<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BillingCashCut extends Model
{
    protected $fillable = [
        'cut_number',
        'total',
        'invoice_count',
        'generated_by_user_id',
        'cut_at',
    ];

    protected $casts = [
        'total' => 'float',
        'cut_at' => 'datetime',
    ];

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'generated_by_user_id');
    }
}
