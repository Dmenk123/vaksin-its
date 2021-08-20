<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class T_bantuan_pusat_provinsi extends Model
{
    protected $table = "t_bantuan_pusat_provinsi";
    protected $primaryKey = "id";
    protected $guarded = [];

    public function scopeMaxId($query)
    {
        return $query->max("id") + 1;
    }

    public static function header_total($bulan, $jenis){
        return \DB::select(\DB::raw('
            SELECT
                SUM ( total_kuota ) AS kuota,
                SUM ( total_real ) AS REAL
            FROM
                t_bantuan_pusat_provinsi
            WHERE
                bulan :: INTEGER <= '.$bulan.'
                and id_jenis_bantuan = '.$jenis.'
                AND tahun = 2021
                AND deleted_at is null
            ')
        );
    }

    public static function detail_bantuan($bulan, $jenis){
        return \DB::select(\DB::raw("
            SELECT t_bantuan_pusat_provinsi.*, m_jenis_bantuan.jenis_bantuan
            FROM
                t_bantuan_pusat_provinsi
            JOIN
                m_jenis_bantuan on t_bantuan_pusat_provinsi.id_jenis_bantuan = m_jenis_bantuan.id
            WHERE
                t_bantuan_pusat_provinsi.bulan :: INTEGER <= '$bulan'
                and t_bantuan_pusat_provinsi.id_jenis_bantuan = '$jenis'
                AND t_bantuan_pusat_provinsi.tahun = 2021
                AND t_bantuan_pusat_provinsi.deleted_at is null
            ")
        );
    }

}

