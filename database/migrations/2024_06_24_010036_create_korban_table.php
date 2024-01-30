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
        Schema::create('korban', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('formulir_pelaporan_kejadian_id');
            $table->string('nama_korban');
            $table->string('umur_korban');
            $table->string('pekerjaan_korban');
            $table->string('alamat_korban');
            $table->string('no_tlp_korban');
            $table->timestamps();
            $table->softDeletes();
            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
            $table->string('deleted_by')->nullable();

            $table->foreign('formulir_pelaporan_kejadian_id')->references('id')->on('formulir_pelaporan_kejadian');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('korban');
    }
};
