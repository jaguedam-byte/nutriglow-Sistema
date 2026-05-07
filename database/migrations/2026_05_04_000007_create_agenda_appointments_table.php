<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('agenda_appointments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('usariosapp_id')->nullable()->constrained('Usariosapp')->nullOnDelete();
            $table->string('cliente_nombre');
            $table->string('cliente_correo');
            $table->dateTime('appointment_at');
            $table->foreignId('created_by_user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('agenda_appointments');
    }
};
