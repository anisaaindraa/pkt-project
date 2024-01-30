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
        Schema::create('log_formulir_pelaksanaan_tugas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('formulir_pelaksanaan_tugas_id');
            $table->softDeletes();
            $table->timestamps();
            $table->timestamp('action_at')->nullable();
            $table->string('action_by')->nullable();
            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
            $table->string('deleted_by')->nullable();

            // Memberikan nama kunci asing yang lebih pendek
            $table->foreign('formulir_pelaksanaan_tugas_id', 'log_tugas_fk')->references('id')->on('formulir_pelaksanaan_tugas');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Memberikan nama kunci asing yang lebih pendek pada operasi drop
        Schema::table('log_formulir_pelaksanaan_tugas', function (Blueprint $table) {
            $table->dropForeign('log_tugas_fk');
        });

        Schema::dropIfExists('log_formulir_pelaksanaan_tugas');
    }
};
