<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class PhotoPatroliLaut extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'photo_patroli_laut';

    protected $primaryKey = 'id';

    protected $fillable = [
        'formulir_patroli_laut_id',
        'photo_path',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
