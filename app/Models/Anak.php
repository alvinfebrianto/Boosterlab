<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anak extends Model
{
    use HasFactory;

    protected $table = 'anaks';

    protected $primaryKey = 'nomor';

    public $incrementing = true;

    protected $fillable = [
        'nama', 'gender', 'tanggal_lahir', 'berat_lahir', 'tinggi_lahir'
    ];

    protected function umur(): Attribute
    {
        return Attribute::make(
            get: fn () => Carbon::parse($this->tanggal_lahir)->diff(Carbon::now())->format('%y tahun %m bulan %d hari'),
        );
    }

    public function pengukurans()
    {
        return $this->hasMany(Pengukuran::class, 'anak_nomor', 'nomor');
    }
}
