<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('cuentas_contables', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->softDeletes();
            $table->string('descripcion');
            $table->string('codigo');
            $table->string('tipo')->nullable();
        });

        Schema::table('movimientos', function (Blueprint $table) {
            $table->foreignId('cuenta_contable_id')->nullable()->constrained('cuentas_contables');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cuentas_contables');
    }
};
