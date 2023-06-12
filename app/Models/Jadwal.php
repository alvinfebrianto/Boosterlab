<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    use HasFactory;

    // Daftar atribut yang dapat diisi (fillable) pada model ini
    protected $fillable = [
        'status'
    ];
}