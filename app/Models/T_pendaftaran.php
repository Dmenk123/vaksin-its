<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class T_vaksinasi extends Model
{
    protected $table = "t_vaksinasi";
    protected $primaryKey = "id";
    protected $guarded = [];
    use SoftDeletes;

    public function scopeMaxId($query)
    {
        return $query->max("id") + 1;
    }

}

