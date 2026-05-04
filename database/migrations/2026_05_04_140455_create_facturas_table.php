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
        Schema::create('facturas', function (Blueprint $table) {
            $table->id();
            $table->date('fecha');
            $table->foreignId('cliente_id')->constrained('clientes');
            $table->string('numero_factura');
            $table->string('numero_control')->nullable();
            
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
        Schema::dropIfExists('facturas');
    }
};
