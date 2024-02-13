<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class FormulirPelaksanaanTugas extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = "formulir_pelaksanaan_tugas";

    protected $primaryKey = "id";

    public function waktuUraianTugas(): HasMany
    {
        return $this->hasMany(WaktuUraianTugas::class, 'formulir_pelaksanaan_tugas_id');
    }

    public function waktu_uraian_tugas()
    {
        return $this->hasMany(WaktuUraianTugas::class);
    }
    public function posts(): HasMany
    {
        return $this->hasMany(Post::class);
    }

    public function inventarisPos(): HasMany
    {
        return $this->hasMany(InventarisPos::class, 'formulir_pelaksanaan_tugas_id');
    }

    protected $fillable = [
        'users_id',
        'tanggal_kejadian',
        'm_pos_id',
        'm_sipam_id',
        'm_shift_id',
        'uraian_tugas',
        'keterangan'
    ];

    protected $dates = ['deleted_at'];

    public function m_shift()
    {
        return $this->belongsTo(MShift::class);
    }

    public function m_pos()
    {
        return $this->belongsTo(MPos::class);
    }

    public function m_sipam()
    {
        return $this->belongsTo(MSipam::class);
    }

    public function m_barang_inventaris()
    {
        return $this->belongsTo(MBarangInventaris::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function updateFormulirPelaksanaanTugas(array $data)
    {
        // Sesuaikan dengan nama kolom di tabel database
        $this->fill($data);
        // Simpan perubahan
        $this->save();
        return $this;
    }
}
