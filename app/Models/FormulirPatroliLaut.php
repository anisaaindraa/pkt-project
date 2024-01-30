<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\MShift;

class FormulirPatroliLaut extends Model
{
    use HasFactory, softDeletes;

    protected $table = 'formulirpatrolilaut';

    protected $primaryKey = 'id';

    protected $fillable = [
        'tanggal_kejadian',
        'm_shift_id',
        'uraian_hasil',
        'keterangan',
    ];

    public function m_shift()
    {
        return $this->belongsTo(MShift::class);
    }

}
