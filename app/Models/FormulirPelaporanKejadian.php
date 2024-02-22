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
        'tanggal_waktu_kejadian',
        'tempat_kejadian',
        'kerugian_akibat_kejadian',
        'penanganan',
        'keterangan_lain',
    ];
    protected $dates = ['deleted_at'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function korban()
    {
        return $this->hasMany(Korban::class);
    }

    public function pelaku()
    {
        return $this->hasMany(Pelaku::class);
    }

    public function updateFormulirPelaporanKejadian(array $data)
    {
        // Sesuaikan dengan nama kolom di tabel database
        $this->fill($data);
        // Simpan perubahan
        $this->save();
        return $this;
    }

}
