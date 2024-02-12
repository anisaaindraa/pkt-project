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
        Schema::create('formulir_patroli_laut', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('users_id');
            $table->dateTime('tanggal_kejadian');
            $table->unsignedBigInteger('m_shift_id');
            $table->string('uraian_hasil');
            $table->string('keterangan');
            $table->timestamps();
            $table->softDeletes();
            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
            $table->string('deleted_by')->nullable();

            $table->foreign('users_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('m_shift_id')->references('id')->on('m_shift')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('formulir_patroli_laut');
    }
};
