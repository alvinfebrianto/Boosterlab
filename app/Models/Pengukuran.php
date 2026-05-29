<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengukuran extends Model
{
    use HasFactory;

    protected $fillable = [
        'anak_nomor', 'bulan', 'berat', 'tinggi'
    ];

    public function anak()
    {
        return $this->belongsTo(Anak::class, 'anak_nomor', 'nomor');
    }
}
