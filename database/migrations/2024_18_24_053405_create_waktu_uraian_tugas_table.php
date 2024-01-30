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
        Schema::create('waktu_uraian_tugas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('formulir_pelaksanaan_tugas_id');
            $table->timestamp('waktu')->nullable();
            $table->string('uraian_tugas');
            $table->timestamps();
            $table->softDeletes();
            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
            $table->string('deleted_by')->nullable();

            $table->foreign('formulir_pelaksanaan_tugas_id')->references('id')->on('formulir_pelaksanaan_tugas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('waktu_uraian_tugas');
    }
};
