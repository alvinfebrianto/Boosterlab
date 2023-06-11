<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anak extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'anaks';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'nomor';

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = true;

    /**
     * fillable
     *
     * @var array
     */
    protected $fillable = [
        'nama', 'gender', 'tanggal_lahir', 'umur', 'berat_lahir', 'tinggi_lahir'
    ];
}
