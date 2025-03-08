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
        Schema::create('kepala_keluargas', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->unsignedBigInteger('rt_rw_id');
            $table->integer('jumlah_muzaki');
            $table->integer('jumlah_tanggungan');
            $table->timestamps();

            $table->foreign('rt_rw_id')->references('id')->on('rt_rws')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kepala_keluargas');
    }
};
