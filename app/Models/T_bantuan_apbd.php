<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class T_bantuan_apbd extends Model
{
    protected $table = "t_bantuan_apbd";
    protected $primaryKey = "id";
    protected $guarded = [];
    // use SoftDeletes;

    public function scopeMaxId($query)
    {
        return $query->max("id") + 1;
    }

    public static function header_total($jenis){

        switch ($jenis) {
            case '1':
                $jenis_text = 'Kesehatan';
                break;

            case '2':
                $jenis_text = 'Vaksin';
                break;

            case '3':
                $jenis_text = 'Ekonomi';
                break;

            default:
                $jenis_text = 'Jaring Pengaman Sosial (JPS)';
                break;
        }

        return \DB::select(\DB::raw("
            SELECT
                SUM ( alokasi ) AS kuota,
                SUM ( realisasi ) AS real
            FROM
                t_bantuan_apbd
            WHERE
                bidang = '$jenis_text'
                AND deleted_at is null
            ")
        );
    }

    public static function massSoftDelete($sumber = null)
    {
        if($sumber == null) {
            $where = 'WHERE sumber is null';
        }else{
            $where = "WHERE sumber = '$sumber'";
        }

        return \DB::select(\DB::raw("
            UPDATE t_bantuan_apbd
            SET deleted_at = '".\Carbon\Carbon::now()->format('Y-m-d H:i:s')."'
            $where
            ")
        );
    }

    // public static function detail_bantuan($bulan, $jenis){
    //     return \DB::select(\DB::raw("
    //         SELECT t_bantuan_pusat_provinsi.*, m_jenis_bantuan.jenis_bantuan
    //         FROM
    //             t_bantuan_pusat_provinsi
    //         JOIN
    //             m_jenis_bantuan on t_bantuan_pusat_provinsi.id_jenis_bantuan = m_jenis_bantuan.id
    //         WHERE
    //             t_bantuan_pusat_provinsi.bulan :: INTEGER <= '$bulan'
    //             and t_bantuan_pusat_provinsi.id_jenis_bantuan = '$jenis'
    //             AND t_bantuan_pusat_provinsi.tahun = 2021
    //             AND t_bantuan_pusat_provinsi.deleted_at is null
    //         ")
    //     );
    // }

}

