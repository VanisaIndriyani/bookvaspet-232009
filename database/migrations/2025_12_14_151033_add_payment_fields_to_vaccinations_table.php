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
        Schema::table('vaccinations', function (Blueprint $table) {
            $table->decimal('amount', 12, 2)->nullable()->after('catatan'); // Nominal pembayaran
            $table->enum('payment_status', ['pending', 'paid', 'verified', 'rejected'])->default('pending')->after('amount'); // Status pembayaran
            $table->string('payment_proof')->nullable()->after('payment_status'); // Bukti transfer (path file)
            $table->string('payment_method')->nullable()->after('payment_proof'); // Metode pembayaran (transfer bank, dll)
            $table->text('payment_note')->nullable()->after('payment_method'); // Catatan pembayaran
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('vaccinations', function (Blueprint $table) {
            $table->dropColumn(['amount', 'payment_status', 'payment_proof', 'payment_method', 'payment_note']);
        });
    }
};
