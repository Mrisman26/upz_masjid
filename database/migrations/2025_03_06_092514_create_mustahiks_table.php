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
        Schema::create('mustahiks', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->enum('kriteria', ['Fakir', 'Miskin', 'Amil', 'Mualaf', 'Gharim', 'Riqab', 'Fi Sabilillah', 'Ibnu Sabil']);
            $table->string('lainnya')->nullable();
            $table->text('keterangan')->nullable();
            $table->unsignedBigInteger('rt_rw_id'); // ✅ Kolom ditambahkan sebelum foreign key
            $table->timestamps();

            $table->foreign('rt_rw_id')->references('id')->on('rt_rws')->onDelete('cascade'); // ✅ Tambahkan FK setelah kolom dibuat
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mustahiks');
    }
};
