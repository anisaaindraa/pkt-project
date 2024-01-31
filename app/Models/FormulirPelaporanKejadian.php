<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FormulirPelaporanKejadian extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = "formulir_pelaporan_kejadian";

    protected $primaryKey = 'id';

    protected $fillable = [
        'users_id',
        'jenis_kejadian',
        'tanggal_kejadian',
        'waktu_kejadian',
        'tempat_kejadian',
        'kerugian_akibat_jadian',
        'keterangan_lain',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
