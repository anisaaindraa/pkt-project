<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\MShift;

class FormulirPatroliLaut extends Model
{
    use HasFactory, softDeletes;

    protected $table = 'formulir_patroli_laut';

    public function photoPatroliLaut(): HasMany
    {
        return $this->hasMany(PhotoPatroliLaut::class, 'formulir_patroli_laut_id');
    }

    public function photo_patroli_laut()
    {
        return $this->hasMany(PhotoPatroliLaut::class); // Adjust the class based on your model structure
    }

    public function posts(): HasMany
    {
        return $this->hasMany(Post::class);
    }

    protected $primaryKey = 'id';

    protected $fillable = [
        'users_id',
        'tanggal_kejadian',
        'm_shift_id',
        'uraian_hasil',
        'keterangan',
    ];

    protected $dates = ['deleted_at'];

    public function m_shift()
    {
        return $this->belongsTo(MShift::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function updateFormulirPatroliLaut(array $data)
    {
        // Sesuaikan dengan nama kolom di tabel database
        $this->fill($data);
        // Simpan perubahan
        $this->save();
        return $this;
    }
}
