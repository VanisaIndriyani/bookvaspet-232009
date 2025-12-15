<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Hapus user yang sudah ada jika ingin reset
        // User::truncate();

        // Buat Dokter Hewan (Admin = Dokter)
        User::updateOrCreate(
            ['email' => 'dokter@bookvaspet.com'],
            [
                'name' => 'Dokter Hewan',
                'email' => 'dokter@bookvaspet.com',
                'password' => Hash::make('dokter123'),
                'role' => 'dokter_hewan',
                'email_verified_at' => now(),
            ]
        );

        // Buat User Biasa
        User::updateOrCreate(
            ['email' => 'user@bookvaspet.com'],
            [
                'name' => 'User Test',
                'email' => 'user@bookvaspet.com',
                'password' => Hash::make('user123'),
                'role' => 'pengguna',
                'email_verified_at' => now(),
            ]
        );

        // Buat User tambahan untuk seeder hewan
        User::updateOrCreate(
            ['email' => 'user2@bookvaspet.com'],
            [
                'name' => 'User Test 2',
                'email' => 'user2@bookvaspet.com',
                'password' => Hash::make('user123'),
                'role' => 'pengguna',
                'email_verified_at' => now(),
            ]
        );

        $this->command->info('Seeder berhasil!');
        $this->command->info('Dokter: dokter@bookvaspet.com / dokter123');
        $this->command->info('User: user@bookvaspet.com / user123');
        $this->command->info('User 2: user2@bookvaspet.com / user123');
    }
}

