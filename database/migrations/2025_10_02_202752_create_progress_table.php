<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('progress', function (Blueprint $table) {
            $table->id();
            $table->string('proses');
            $table->string('data_pendukung');
            $table->text('keterangan');
            $table->unsignedBigInteger('mahasiswas_id');
            $table->unsignedBigInteger('users_id');
            $table->foreign('mahasiswas_id')->references('id')->on('mahasiswas');
            $table->foreign('users_id')->references('id')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('progress');
    }
};
