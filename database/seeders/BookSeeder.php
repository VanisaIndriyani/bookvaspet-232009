<?php

namespace Database\Seeders;

use App\Models\Book;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $books = [
            [
                'kode_buku' => 'BK001',
                'nama_pengarang' => 'Dr. Ahmad Hidayat, M.Kom',
                'nama_penulis' => 'Prof. Siti Nurhaliza, Ph.D',
            ],
            [
                'kode_buku' => 'BK002',
                'nama_pengarang' => 'Budi Santoso, S.Kom',
                'nama_penulis' => 'Dr. Rina Wati, M.T',
            ],
            [
                'kode_buku' => 'BK003',
                'nama_pengarang' => 'Ir. Muhammad Fauzi',
                'nama_penulis' => 'Diana Sari, S.Si',
            ],
            [
                'kode_buku' => 'BK004',
                'nama_pengarang' => 'Dr. Andi Wijaya, M.Sc',
                'nama_penulis' => 'Lisa Permata, M.Kom',
            ],
            [
                'kode_buku' => 'BK005',
                'nama_pengarang' => 'Prof. Bambang Sutrisno, Ph.D',
                'nama_penulis' => 'Maya Indira, S.T',
            ],
        ];

        foreach ($books as $book) {
            Book::updateOrCreate(
                ['kode_buku' => $book['kode_buku']],
                $book
            );
        }

        $this->command->info('Seeder buku berhasil! 5 data buku telah ditambahkan.');
    }
}
