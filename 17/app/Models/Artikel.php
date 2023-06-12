<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Artikel extends Model
{
    use HasFactory;

    // Daftar atribut yang dapat diisi (fillable) pada model ini
    protected $fillable = [
        'image', 'title', 'content'
    ];
}
