<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vaccination extends Model
{
    use HasFactory;

    protected $fillable = [
        'animal_id',
        'jenis_vaksin',
        'tanggal_vaksin',
        'tanggal_booster',
        'dokter',
        'lokasi',
        'catatan',
        'amount',
        'payment_status',
        'payment_proof',
        'payment_method',
        'payment_note',
    ];

    protected $casts = [
        'tanggal_vaksin' => 'date',
        'tanggal_booster' => 'date',
    ];

    /**
     * Relasi ke Animal
     */
    public function animal()
    {
        return $this->belongsTo(Animal::class);
    }
}
