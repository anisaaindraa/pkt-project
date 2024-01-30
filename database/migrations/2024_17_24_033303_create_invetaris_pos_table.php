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
        Schema::create('invetaris_pos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('formulir_pelaksanaan_tugas_id');
            $table->unsignedBigInteger('m_barang_inventaris_id');
            $table->string('jumlah');
            $table->string('keterangan');
            $table->timestamps();
            $table->softDeletes();
            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
            $table->string('deleted_by')->nullable();

            $table->foreign('formulir_pelaksanaan_tugas_id')->references('id')->on('formulir_pelaksanaan_tugas')->onDelete('cascade');
            $table->foreign('m_barang_inventaris_id')->references('id')->on('m_barang_inventaris')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invetaris_pos');
    }
};
