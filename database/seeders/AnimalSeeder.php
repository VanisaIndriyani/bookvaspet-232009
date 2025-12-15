<?php

namespace Database\Seeders;

use App\Models\Animal;
use App\Models\User;
use Illuminate\Database\Seeder;

class AnimalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ambil user yang ada (bukan admin/dokter)
        $users = User::where('role', 'pengguna')->get();

        if ($users->isEmpty()) {
            $this->command->warn('Tidak ada user dengan role pengguna. Silakan jalankan UserSeeder terlebih dahulu.');
            return;
        }

        $animals = [
            [
                'nama' => 'Max',
                'jenis' => 'Anjing',
                'ras' => 'Golden Retriever',
                'jenis_kelamin' => 'jantan',
                'tanggal_lahir' => '2020-05-15',
                'warna' => 'Emas',
                'catatan' => 'Hewan yang sangat aktif dan ramah. Suka bermain di taman.',
            ],
            [
                'nama' => 'Luna',
                'jenis' => 'Kucing',
                'ras' => 'Persian',
                'jenis_kelamin' => 'betina',
                'tanggal_lahir' => '2021-03-20',
                'warna' => 'Putih',
                'catatan' => 'Kucing yang tenang dan suka diemong. Perlu perawatan bulu rutin.',
            ],
            [
                'nama' => 'Bobby',
                'jenis' => 'Anjing',
                'ras' => 'Bulldog',
                'jenis_kelamin' => 'jantan',
                'tanggal_lahir' => '2019-11-10',
                'warna' => 'Coklat',
                'catatan' => 'Anjing yang setia dan penyayang. Memiliki alergi makanan tertentu.',
            ],
            [
                'nama' => 'Mimi',
                'jenis' => 'Kucing',
                'ras' => 'Angora',
                'jenis_kelamin' => 'betina',
                'tanggal_lahir' => '2022-01-25',
                'warna' => 'Abu-abu',
                'catatan' => 'Kucing muda yang sangat lincah. Suka memanjat dan bermain.',
            ],
            [
                'nama' => 'Rocky',
                'jenis' => 'Anjing',
                'ras' => 'German Shepherd',
                'jenis_kelamin' => 'jantan',
                'tanggal_lahir' => '2020-08-30',
                'warna' => 'Hitam dan Coklat',
                'catatan' => 'Anjing yang pintar dan mudah dilatih. Sangat protektif terhadap keluarga.',
            ],
        ];

        foreach ($animals as $index => $animalData) {
            // Distribusikan hewan ke user yang berbeda (round-robin)
            $user = $users[$index % $users->count()];
            
            Animal::updateOrCreate(
                [
                    'user_id' => $user->id,
                    'nama' => $animalData['nama'],
                ],
                array_merge($animalData, [
                    'user_id' => $user->id,
                ])
            );
        }

        $this->command->info('Seeder hewan berhasil! 5 data hewan telah ditambahkan.');
    }
}
