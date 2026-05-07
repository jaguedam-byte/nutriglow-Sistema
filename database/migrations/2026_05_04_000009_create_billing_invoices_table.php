<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('billing_invoices', function (Blueprint $table) {
            $table->id();
            $table->string('invoice_number')->unique();
            $table->foreignId('usariosapp_id')->nullable()->constrained('Usariosapp')->nullOnDelete();
            $table->string('cliente_nombre');
            $table->string('cliente_correo');
            $table->string('cliente_dpi', 13)->nullable();
            $table->decimal('cita_costo', 10, 2)->default(0);
            $table->json('extras')->nullable();
            $table->decimal('extras_total', 10, 2)->default(0);
            $table->decimal('total', 10, 2)->default(0);
            $table->foreignId('generated_by_user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->dateTime('billed_at');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('billing_invoices');
    }
};
