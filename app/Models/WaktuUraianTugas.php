<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class WaktuUraianTugas extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'waktu_uraian_tugas';

    protected $primaryKey = 'id';

    protected $fillable = [
        'formulir_pelaksanaan_tugas_id',
        'waktu',
        'uraian_tugas'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
