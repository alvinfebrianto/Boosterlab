<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailAnak extends Model
{
    use HasFactory;

    // Daftar atribut yang dapat diisi (fillable) pada model ini
    protected $fillable = [
        'anak_nomor', 'bulan', 'berat', 'tinggi'
    ];

    public function anak()
    {
        return $this->belongsTo(Anak::class, 'anak_nomor', 'nomor');
    }
}
