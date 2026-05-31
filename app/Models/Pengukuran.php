<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Number;

class Pengukuran extends Model
{
    use HasFactory;

    protected $fillable = [
        'anak_nomor', 'bulan', 'berat', 'tinggi'
    ];

    protected function berat(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => Number::trim((float) $value),
        );
    }

    protected function tinggi(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => Number::trim((float) $value),
        );
    }

    public function anak()
    {
        return $this->belongsTo(Anak::class, 'anak_nomor', 'nomor');
    }
}
