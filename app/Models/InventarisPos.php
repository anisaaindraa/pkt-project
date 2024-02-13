<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class InventarisPos extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = "invetaris_pos";

    protected $primaryKey = 'id';

    protected $fillable = [
        'formuliir_pelaksanaan_tugas_id',
        'm_barang_inventaris_id',
        'jumlah',
        'keterangan'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
