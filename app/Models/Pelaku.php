<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pelaku extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = "pelaku";

    protected $primaryKey = "id";

    protected $fillable = [
        'formulir_pelaporan_kejadian_id',
        'nama_pelaku',
        'umur_pelaku',
        'pekerjaan_pelaku',
        'alamat_pelaku',
        'no_tlp_pelaku',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
