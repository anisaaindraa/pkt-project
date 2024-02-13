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
        Schema::create('formulir_pelaksanaan_tugas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('users_id');
            $table->dateTime('tanggal_kejadian');
            $table->unsignedBigInteger('m_pos_id');
            $table->unsignedBigInteger('m_sipam_id');
            $table->unsignedBigInteger('m_shift_id');
            $table->string('keterangan');
            $table->timestamps();
            $table->softDeletes();
            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
            $table->string('deleted_by')->nullable();

            $table->foreign('users_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('m_pos_id')->references('id')->on('m_pos')->onDelete('cascade');
            $table->foreign('m_sipam_id')->references('id')->on('m_sipam')->onDelete('cascade');
            $table->foreign('m_shift_id')->references('id')->on('m_shift')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('formulir_pelaksanaan_tugas');
    }
};
