<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['nama_role'];

    protected $dates = ['deleted_at'];

    public function updateRole(array $data)
    {
        $this->fill($data);
        $this->save();
        return $this;
    }
}
