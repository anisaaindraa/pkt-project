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
        Schema::create('pelaku', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('formulir_pelaporan_kejadian_id');
            $table->string('nama_pelaku');
            $table->string('umur_pelaku');
            $table->string('pekerjaan_pelaku');
            $table->string('alamat_pelaku');
            $table->string('no_tlp_pelaku');
            $table->softDeletes();
            $table->timestamps();
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
        Schema::dropIfExists('pelaku');
    }
};
