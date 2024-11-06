<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('reservations', function (Blueprint $table) {
            Schema::table('reservations', function (Blueprint $table) {
                // Cambiar 'start_date' para que tenga un valor por defecto de la fecha y hora actual
                $table->timestamp('start_date')->default(DB::raw('CURRENT_TIMESTAMP'))->change();
            });
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('reservations', function (Blueprint $table) {
            //
        });
    }
};
