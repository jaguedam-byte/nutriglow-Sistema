<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('Usariosapp', function (Blueprint $table) {
            $table->string('dpi', 13)->unique()->after('correo');
        });
    }

    public function down(): void
    {
        Schema::table('Usariosapp', function (Blueprint $table) {
            $table->dropUnique(['dpi']);
            $table->dropColumn('dpi');
        });
    }
};
