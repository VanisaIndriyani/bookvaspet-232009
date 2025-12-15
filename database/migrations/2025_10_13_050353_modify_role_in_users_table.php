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
        Schema::table('users', function (Blueprint $table) {
            // Mengubah kolom 'role' dengan default baru 'pengguna'
            $table->string('role')->default('pengguna')->comment('Pilihan: pengguna, dokter_hewan')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Jika di-rollback, kembalikan ke state sebelumnya (default 'owner')
            $table->string('role')->default('owner')->comment('')->change();
        });
    }
};