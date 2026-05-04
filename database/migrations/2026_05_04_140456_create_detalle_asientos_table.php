<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('detalle_asientos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('asiento_contable_id')->constrained('asientos_contables')->onDelete('cascade');
            $table->foreignId('cuenta_contable_id')->constrained('cuentas_contables');
            $table->decimal('debe', 20, 2)->default(0);
            $table->decimal('haber', 20, 2)->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detalle_asientos');
    }
};
