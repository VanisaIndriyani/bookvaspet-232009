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
        Schema::create('vaccinations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('animal_id')->constrained()->onDelete('cascade'); // Hewan yang divaksin
            $table->string('jenis_vaksin'); // Jenis vaksin (DHPP, Rabies, dll)
            $table->date('tanggal_vaksin'); // Tanggal vaksinasi
            $table->date('tanggal_booster')->nullable(); // Tanggal booster berikutnya
            $table->string('dokter')->nullable(); // Nama dokter yang memberikan vaksin
            $table->string('lokasi')->nullable(); // Lokasi vaksinasi
            $table->text('catatan')->nullable(); // Catatan tambahan
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vaccinations');
    }
};
