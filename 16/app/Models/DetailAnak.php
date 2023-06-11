<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailAnak extends Model
{
    use HasFactory;

    protected $fillable = [
        'bulan', 'berat', 'tinggi'
    ];
}