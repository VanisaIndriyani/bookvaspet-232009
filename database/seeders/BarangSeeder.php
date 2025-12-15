<?php

namespace Database\Seeders;

use App\Models\Barang;
use Illuminate\Database\Seeder;

class BarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $barangs = [
            [
                'kode_barang' => 'BRG001',
                'nama_barang' => 'Obat Anti Kutu',
                'jenis_barang' => 'Obat',
            ],
            [
                'kode_barang' => 'BRG002',
                'nama_barang' => 'Vaksin Rabies',
                'jenis_barang' => 'Vaksin',
            ],
            [
                'kode_barang' => 'BRG003',
                'nama_barang' => 'Makanan Kucing Premium',
                'jenis_barang' => 'Makanan',
            ],
            [
                'kode_barang' => 'BRG004',
                'nama_barang' => 'Kandang Portable',
                'jenis_barang' => 'Perlengkapan',
            ],
            [
                'kode_barang' => 'BRG005',
                'nama_barang' => 'Vitamin Hewan',
                'jenis_barang' => 'Suplemen',
            ],
        ];

        foreach ($barangs as $barang) {
            Barang::updateOrCreate(
                ['kode_barang' => $barang['kode_barang']],
                $barang
            );
        }

        $this->command->info('Seeder barang berhasil! 5 data barang telah ditambahkan.');
    }
}

