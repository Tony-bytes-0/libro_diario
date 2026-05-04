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
        Schema::create('reportes_z', function (Blueprint $table) {
            $table->id();
            $table->date('fecha');
            $table->string('maquina_fiscal');
            $table->string('numero_reporte_z');
            $table->string('primera_factura')->nullable();
            $table->string('ultima_factura')->nullable();
            
            $table->decimal('total_ventas', 20, 2)->default(0);
            $table->decimal('total_ventas_no_gravadas', 20, 2)->default(0);
            $table->decimal('base_imponible', 20, 2)->default(0);
            $table->decimal('porcentaje_iva', 5, 2)->default(16);
            $table->decimal('impuesto_iva', 20, 2)->default(0);
            
            $table->enum('estado_contable', ['pendiente', 'contabilizado'])->default('pendiente');
            
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reportes_z');
    }
};
