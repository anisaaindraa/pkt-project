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
        Schema::create('photo_patroli_laut', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('formulir_patroli_laut_id');
            $table->string('photo_path');
            $table->softDeletes();
            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
            $table->string('deleted_by')->nullable();

            $table->foreign('formulir_patroli_laut_id')->references('id')->on('formulir_patroli_laut');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('photo_patroli_laut');
    }
};
