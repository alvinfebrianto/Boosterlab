<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailAnak extends Model
{
    use HasFactory;

    // Daftar atribut yang dapat diisi (fillable) pada model ini
    protected $fillable = [
        'bulan', 'berat', 'tinggi'
    ];
}