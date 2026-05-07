<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('Usariosapp', function (Blueprint $table) {
            if (! Schema::hasColumn('Usariosapp', 'rango_receta')) {
                $table->string('rango_receta', 20)->default('bajo')->after('password');
            }

            if (! Schema::hasColumn('Usariosapp', 'receta_opinion')) {
                $table->text('receta_opinion')->nullable()->after('rango_receta');
            }

            if (! Schema::hasColumn('Usariosapp', 'receta_imagen')) {
                $table->string('receta_imagen')->nullable()->after('receta_opinion');
            }
        });
    }

    public function down(): void
    {
        Schema::table('Usariosapp', function (Blueprint $table) {
            foreach (['receta_imagen', 'receta_opinion', 'rango_receta'] as $column) {
                if (Schema::hasColumn('Usariosapp', $column)) {
                    $table->dropColumn($column);
                }
            }
        });
    }
};
