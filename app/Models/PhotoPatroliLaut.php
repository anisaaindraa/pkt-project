<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PhotoPatroliLaut extends Model
{
    use HasFactory;

    protected $table = 'photo_patroli_laut';

    public function formulirPatroliLaut(): BelongsTo
    {
        return $this->belongsTo(FormulirPatroliLaut::class, 'formulir_patroli_laut_id');
    }
}
