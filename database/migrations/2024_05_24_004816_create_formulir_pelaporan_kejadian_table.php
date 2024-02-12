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
        Schema::create('formulir_pelaporan_kejadian', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('users_id');
            $table->string('jenis_kejadian');
            $table->dateTime('tanggal_kejadian');
            $table->timestamp('waktu_kejadian');
            $table->string('tempat_kejadian');
            $table->string('kerugian_akibat_kejadian')->nullable();
            $table->string('keterangan_lain');
            $table->timestamps();
            $table->softDeletes();
            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
            $table->string('deleted_by')->nullable();

            // Pastikan tipe data dan ukuran kolom role_id sesuai dengan kolom id pada tabel roles
            $table->foreign('users_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('formulir_pelaporan_kejadian');
    }
};
