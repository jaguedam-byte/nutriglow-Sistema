<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('agenda_appointments', function (Blueprint $table) {
            $table->boolean('is_completed')->default(false)->after('appointment_at');
            $table->dateTime('completed_at')->nullable()->after('is_completed');
        });
    }

    public function down(): void
    {
        Schema::table('agenda_appointments', function (Blueprint $table) {
            $table->dropColumn(['is_completed', 'completed_at']);
        });
    }
};
