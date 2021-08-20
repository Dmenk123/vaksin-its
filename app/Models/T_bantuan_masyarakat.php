<?php

namespace App\Models;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class T_bantuan_masyarakat extends Model
{
    protected $table = "t_bantuan_masyarakat";
    protected $primaryKey = "id";
    protected $guarded = [];
    // use SoftDeletes;

    public function scopeMaxId($query)
    {
        return $query->max("id") + 1;
    }

    public static function header_total($jenis){


        return \DB::select(\DB::raw("
            SELECT
                SUM ( alokasi ) AS kuota,
                SUM ( realisasi ) AS real
            FROM
                t_bantuan_apbd
            WHERE
                bidang = '$jenis'
                AND deleted_at is null
            ")
        );
    }

    public static function detail_header_bantuan($tanggal, $jenis){
        if($jenis == 14) {
            return \DB::select(
                \DB::raw("
                    SELECT
                        sum(t_bantuan_masyarakat.penerimaan * t_bantuan_masyarakat.hargasatuan) as total_penerimaan,
                        t_bantuan_masyarakat.barang, t_bantuan_masyarakat.satuan
                    FROM
                        t_bantuan_masyarakat
                    WHERE
                        t_bantuan_masyarakat.tanggal <= '$tanggal'
                        AND t_bantuan_masyarakat.id_jenis_bantuan = '15'
                        AND t_bantuan_masyarakat.deleted_at IS NULL
                        GROUP BY t_bantuan_masyarakat.barang, t_bantuan_masyarakat.satuan

                    UNION ALL

                    SELECT sum(t_bantuan_masyarakat.penerimaan * t_bantuan_masyarakat.hargasatuan) as total_penerimaan,
                    t_bantuan_masyarakat.barang, t_bantuan_masyarakat.satuan
                    FROM
                        t_bantuan_masyarakat
                    JOIN
                        m_jenis_bantuan on t_bantuan_masyarakat.id_jenis_bantuan = m_jenis_bantuan.id
                    WHERE
                        t_bantuan_masyarakat.tanggal <= '$tanggal'
                        and t_bantuan_masyarakat.id_jenis_bantuan = '$jenis'
                        AND t_bantuan_masyarakat.deleted_at is null
                    GROUP BY t_bantuan_masyarakat.barang, t_bantuan_masyarakat.satuan
                    ")
            );
        }else if($jenis == 13){
            return \DB::select(
                \DB::raw("
                    SELECT SUM
                        ( t_bantuan_masyarakat.penerimaan * t_bantuan_masyarakat.hargasatuan ) AS total_penerimaan,
                        concat(t_bantuan_masyarakat.barang,' - ',t_bantuan_masyarakat.satuan) as barang,
                        t_bantuan_masyarakat.satuan
                    FROM
                        t_bantuan_masyarakat
                        JOIN m_jenis_bantuan ON t_bantuan_masyarakat.id_jenis_bantuan = m_jenis_bantuan.id
                    WHERE
                        t_bantuan_masyarakat.tanggal <= '$tanggal'
                        AND t_bantuan_masyarakat.id_jenis_bantuan = '$jenis'
                        AND t_bantuan_masyarakat.deleted_at IS NULL
                    GROUP BY
                        t_bantuan_masyarakat.barang, t_bantuan_masyarakat.satuan
                    ORDER BY barang, satuan
                ")
            );
        }else {
            return null;
        }

    }

    public static function detail_bantuan($tanggal, $jenis){
        return \DB::select(\DB::raw("
            SELECT t_bantuan_masyarakat.*, m_jenis_bantuan.jenis_bantuan
            FROM
                t_bantuan_masyarakat
            JOIN
                m_jenis_bantuan on t_bantuan_masyarakat.id_jenis_bantuan = m_jenis_bantuan.id
            WHERE
                t_bantuan_masyarakat.tanggal <= '$tanggal'
                and t_bantuan_masyarakat.id_jenis_bantuan = '$jenis'
                AND t_bantuan_masyarakat.deleted_at is null
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

