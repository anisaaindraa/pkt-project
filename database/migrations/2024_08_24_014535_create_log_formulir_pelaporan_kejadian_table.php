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
        Schema::create('log_formulir_pelaporan_kejadian', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('formulir_pelaporan_kejadian_id');
            $table->softDeletes();
            $table->timestamps();
            $table->timestamp('action_at')->nullable(); // Mengganti ke dateTime
            $table->string('action_by')->nullable();
            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
            $table->string('deleted_by')->nullable();

            // Memberikan nama kunci asing yang lebih pendek
            $table->foreign('formulir_pelaporan_kejadian_id', 'log_fk')->references('id')->on('formulir_pelaporan_kejadian');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Memberikan nama kunci asing yang lebih pendek pada operasi drop
        Schema::table('log_formulir_pelaporan_kejadian', function (Blueprint $table) {
            $table->dropForeign('log_fk');
        });

        Schema::dropIfExists('log_formulir_pelaporan_kejadian');
    }
};
