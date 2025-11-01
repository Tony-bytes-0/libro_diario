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
        Schema::create('libro_movimientos', function (Blueprint $table) {
            $table->id();
            $table->string('rif')->nullable();
            $table->string('tipo_documento')->nullable();
            $table->date('periodo');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('movimientos', function (Blueprint $table) {
            $table->id();
            $table->date('fecha')->nullable();
            $table->foreignId('cliente_id')->nullable()->constrained();
            $table->foreignId('libro_movimiento_id')->nullable()->constrained();
            $table->string('tipo_documento')->nullable();
            $table->string('maquina_fiscal')->nullable();
            $table->string('primera_factura')->nullable();
            $table->string('ultima_factura')->nullable();
            $table->string('numero_factura')->nullable();
            $table->string('factura_afectada')->nullable();
            $table->decimal('total_ventas', 30, 2)->nullable();
            $table->decimal('total_ventas_no_gravadas', 30, 2)->nullable();
            $table->decimal('base_imponible_alic_contribuyente', 30, 2)->nullable();
            $table->decimal('base_imponible_alic_no_contribuyente', 30, 2)->nullable();
            $table->decimal('porcentaje_iva_contribuyente', 30, 2)->nullable();
            $table->decimal('porcentaje_iva_no_contribuyente', 30, 2)->nullable();
            $table->decimal('impuesto_iva', 30, 2)->nullable();
            $table->decimal('retencion_iva_soportada', 30, 2)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('libro_movimientos');
        Schema::dropIfExists('movimientos');
    }
};
