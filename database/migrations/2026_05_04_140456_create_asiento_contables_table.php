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
        Schema::create('asientos_contables', function (Blueprint $table) {
            $table->id();
            $table->date('fecha');
            $table->string('descripcion');
            $table->morphs('documento'); // Crea documento_id y documento_type
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('asientos_contables');
    }
};
