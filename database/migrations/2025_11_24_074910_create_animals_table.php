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
        Schema::create('animals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Pemilik hewan
            $table->string('nama'); // Nama hewan
            $table->string('jenis'); // Jenis hewan (kucing, anjing, dll)
            $table->string('ras')->nullable(); // Ras hewan
            $table->enum('jenis_kelamin', ['jantan', 'betina'])->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->string('warna')->nullable();
            $table->text('catatan')->nullable(); // Catatan tambahan
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('animals');
    }
};
