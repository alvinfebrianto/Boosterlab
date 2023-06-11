<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Anak extends Model
{
    use HasFactory;
    protected $table = 'anaks';
    protected $primaryKey = 'nomor';
    public $incrementing = true;
    protected $fillable = [
        'nama', 'gender', 'tanggal_lahir', 'umur', 'berat_lahir', 'tinggi_lahir'
    ];
}