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
        Schema::create('zakats', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('kepala_keluarga_id');
            $table->decimal('zakat_fitrah_beras', 8, 2);
            $table->decimal('zakat_fitrah_uang', 10, 2);
            $table->decimal('zakat_mal', 10, 2)->nullable();
            $table->decimal('zakat_penghasilan', 10, 2)->nullable();
            $table->decimal('infaq', 10, 2);
            $table->timestamps();

            $table->foreign('kepala_keluarga_id')->references('id')->on('kepala_keluargas')->onDelete('cascade');

            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('zakats');
    }
};
