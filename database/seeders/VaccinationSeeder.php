<?php

namespace Database\Seeders;

use App\Models\Vaccination;
use App\Models\Animal;
use Illuminate\Database\Seeder;

class VaccinationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ambil hewan yang ada
        $animals = Animal::all();

        if ($animals->isEmpty()) {
            $this->command->warn('Tidak ada data hewan. Silakan jalankan AnimalSeeder terlebih dahulu.');
            return;
        }

        $vaccinations = [
            [
                'jenis_vaksin' => 'DHPP',
                'tanggal_vaksin' => '2024-01-15',
                'tanggal_booster' => '2024-02-15',
                'dokter' => 'Dr. Budi Santoso',
                'lokasi' => 'Klinik Hewan Sejahtera',
                'catatan' => 'Vaksinasi pertama untuk Max. Hewan dalam kondisi sehat.',
            ],
            [
                'jenis_vaksin' => 'Rabies',
                'tanggal_vaksin' => '2024-03-20',
                'tanggal_booster' => '2025-03-20',
                'dokter' => 'Dr. Siti Nurhaliza',
                'lokasi' => 'Klinik Hewan Sejahtera',
                'catatan' => 'Vaksinasi rabies tahunan untuk Luna. Tidak ada reaksi alergi.',
            ],
            [
                'jenis_vaksin' => 'DHPP',
                'tanggal_vaksin' => '2024-05-10',
                'tanggal_booster' => '2024-06-10',
                'dokter' => 'Dr. Budi Santoso',
                'lokasi' => 'Klinik Hewan Sejahtera',
                'catatan' => 'Vaksinasi untuk Bobby. Perlu monitoring setelah vaksin.',
            ],
            [
                'jenis_vaksin' => 'FVRCP',
                'tanggal_vaksin' => '2024-07-25',
                'tanggal_booster' => '2024-08-25',
                'dokter' => 'Dr. Siti Nurhaliza',
                'lokasi' => 'Klinik Hewan Sejahtera',
                'catatan' => 'Vaksinasi pertama untuk Mimi. Kucing masih muda dan aktif.',
            ],
            [
                'jenis_vaksin' => 'Rabies',
                'tanggal_vaksin' => '2024-09-30',
                'tanggal_booster' => '2025-09-30',
                'dokter' => 'Dr. Budi Santoso',
                'lokasi' => 'Klinik Hewan Sejahtera',
                'catatan' => 'Vaksinasi rabies untuk Rocky. German Shepherd dalam kondisi prima.',
            ],
        ];

        foreach ($vaccinations as $index => $vaccinationData) {
            // Distribusikan vaksinasi ke hewan yang berbeda (round-robin)
            $animal = $animals[$index % $animals->count()];
            
            Vaccination::updateOrCreate(
                [
                    'animal_id' => $animal->id,
                    'jenis_vaksin' => $vaccinationData['jenis_vaksin'],
                    'tanggal_vaksin' => $vaccinationData['tanggal_vaksin'],
                ],
                array_merge($vaccinationData, [
                    'animal_id' => $animal->id,
                ])
            );
        }

        $this->command->info('Seeder vaksinasi berhasil! 5 data vaksinasi telah ditambahkan.');
    }
}

