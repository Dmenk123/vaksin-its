<?php

namespace App\Http\Controllers;
use App\Models\T_bantuan_masyarakat;
use App\Models\T_bantuan_pusat_provinsi;
use App\Models\T_bantuan_apbd;

use App\Http\Controllers\Csr;
use App\Http\Controllers\Apbd;

use Carbon\Carbon;
use Illuminate\Http\Request;
use League\CommonMark\Block\Element\ListData;

class Tarikdata extends Controller
{
    const ID_BANTUAN_BARANG = 13;
    const ID_BANTUAN_UANG = 14;

    public function proses_tarik($tanggal=null, $metode='crontab')
    {

        if($tanggal == null) {
            $tanggal = Carbon::now()->format('Y-m-d');
        }else{
            $tanggal = Carbon::parse($tanggal)->format('Y-m-d');
        }

        $arr_id_jenis = [self::ID_BANTUAN_BARANG, self::ID_BANTUAN_UANG];
        $obj_csr = new Csr;
        $obj_apbd = new Apbd;
        $is_next = false;

        foreach ($arr_id_jenis as $v) {
            $tarik_csr = $obj_csr->insert_db_api_csr($v);
            $response_csr = $tarik_csr->getData();

            if ($response_csr->status == 'success') {
                $is_next = true;
            } else {
                return \Response::json([
                    "status"    => "error",
                    "message"    => 'Gagal Melakukan Penarikan Data inspektorat',
                ]);
            }
        }

        if($is_next) {
            $tarik_apbd = $obj_apbd->insert_db_api($tanggal);
            $response_apbd = $tarik_apbd->getData();

            if ($response_apbd->status == 'success') {
                ## insert log
                \DB::table('t_log_penarikan')->insert(
                    array(
                        'metode'   =>  $metode,
                        'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                        'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    )
                );

                return \Response::json([
                    "status"    => "success",
                    "message"    => 'Berhasil Melakukan Penarikan Data',
                ]);

            } else {
                return \Response::json([
                    "status"    => "error",
                    "message"    => 'Gagal Melakukan Penarikan Data bpkpd',
                ]);
            }
        }else{
            return \Response::json([
                "status"    => "error",
                "message"    => 'Gagal Melakukan Penarikan Data bpkpd',
            ]);
        }
    }
}
