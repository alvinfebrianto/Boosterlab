<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anak extends Model
{
    use HasFactory;

    // Nama tabel yang digunakan
    protected $table = 'anaks';

    // Nama kolom sebagai primary key
    protected $primaryKey = 'nomor';

    // Menyatakan primary key bertipe incrementing
    public $incrementing = true;

    // Daftar atribut yang dapat diisi (fillable) pada model ini
    protected $fillable = [
        'nama', 'gender', 'tanggal_lahir', 'umur', 'berat_lahir', 'tinggi_lahir'
    ];
}