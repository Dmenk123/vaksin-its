<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class T_kipi extends Model
{
    protected $table = "t_kipi";
    protected $primaryKey = "id";
    protected $guarded = [];
    use SoftDeletes;

    public function scopeMaxId($query)
    {
        return $query->max("id") + 1;
    }

    // public function scopeCounterPendaftar($query, $id_vaksinasi)
    // {
    //     return $query->where(['id_vaksinasi' => $id_vaksinasi, 'deleted_at' => null])->count();
    // }

}

