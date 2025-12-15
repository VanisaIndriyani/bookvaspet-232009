<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Animal extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'nama',
        'jenis',
        'ras',
        'jenis_kelamin',
        'tanggal_lahir',
        'warna',
        'catatan',
    ];

    protected $casts = [
        'tanggal_lahir' => 'date',
    ];

    /**
     * Relasi ke User (pemilik hewan)
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relasi ke Vaccination (riwayat vaksinasi)
     */
    public function vaccinations()
    {
        return $this->hasMany(Vaccination::class);
    }
}
