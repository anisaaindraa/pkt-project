<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('formulir_patroli_laut', function (Blueprint $table) {
            $table->enum('status', ['pending', 'accepted', 'declined'])->default('pending')->after('keterangan');
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('formulir_patroli_laut', function (Blueprint $table) {
            //
        });
    }
};
