<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AgendaAppointment extends Model
{
    protected $fillable = [
        'usariosapp_id',
        'cliente_nombre',
        'cliente_correo',
        'appointment_at',
        'is_completed',
        'completed_at',
        'created_by_user_id',
    ];

    protected $casts = [
        'appointment_at' => 'datetime',
        'is_completed' => 'boolean',
        'completed_at' => 'datetime',
    ];

    public function usariosapp(): BelongsTo
    {
        return $this->belongsTo(Usariosapp::class);
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by_user_id');
    }
}
