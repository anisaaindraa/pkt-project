<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Korban extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = "korban";

    protected $primaryKey = "id";

    protected $fillable = [
        'formulir_pelaporan_kejadian_id',
        'nama_korban',
        'umur_korban',
        'pekerjaan_korban',
        'alamat_korban',
        'no_tlp_korban',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
