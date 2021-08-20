<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Csr;
class Home extends Controller
{
    public function index()
    {
        $data = [
        ];

        return view("beranda.index")->with($data);
    }

    public function idx()
    {
        $total_bdh = 0;
        $total_swd = 0;

        $kesehatan = \App\Models\T_bantuan_apbd::header_total(1);
        $vaksin = \App\Models\T_bantuan_apbd::header_total(2);
        $ekonomi = \App\Models\T_bantuan_apbd::header_total(3);
        $jps = \App\Models\T_bantuan_apbd::header_total(4);

        $total_bantuan_bdh = \App\Models\T_bantuan_masyarakat::detail_bantuan(\Carbon\Carbon::now()->format('Y-m-d'), 11);

        foreach ($total_bantuan_bdh as $k1 => $v1) {
            $total_bdh += $v1->penerimaan *  $v1->hargasatuan;
        }

        $total_bantuan_soewandhie = \App\Models\T_bantuan_masyarakat::detail_bantuan(\Carbon\Carbon::now()->format('Y-m-d'), 12);

        foreach ($total_bantuan_soewandhie as $k1 => $v1) {
            $total_swd += $v1->penerimaan *  $v1->hargasatuan;
        }

        $total_bantuan_uang = $this->get_total_bantuan_uang();
        $total_bantuan_barang = $this->get_total_bantuan_barang();

        $bst = \App\Models\T_bantuan_pusat_provinsi::header_total(7, 5);
        $pkh = \App\Models\T_bantuan_pusat_provinsi::header_total(7, 6);
        $sembako = \App\Models\T_bantuan_pusat_provinsi::header_total(7, 7);
        $beras = \App\Models\T_bantuan_pusat_provinsi::header_total(7, 8);
        $beras_ppkm = \App\Models\T_bantuan_pusat_provinsi::header_total(7, 9);
        $santunan_covid = \App\Models\T_bantuan_pusat_provinsi::header_total(7, 10);

        $data_btt = \App\Models\T_bantuan_apbd::whereIn('bidang', ['Kesehatan', 'Jaring Pengaman Sosial (JPS)'])->where(['sub_kegiatan_nama' => 'Pengelolaan Dana Darurat dan Mendesak', 'deleted_at' => null])->get();

        // grouping data_btt
        $arr_bidang_btt = [];
        $arr_group_btt = [];
        foreach ($data_btt as $k => $v) {
            if (!in_array($v->bidang, $arr_bidang_btt)) {
                array_push($arr_bidang_btt, $v->bidang);
                $arr_group_btt[$v->bidang]['alokasi'] = (float)$v->alokasi;
                $arr_group_btt[$v->bidang]['realisasi'] = (float)$v->realisasi;
            } else {
                $arr_group_btt[$v->bidang]['alokasi'] += (float)$v->alokasi;
                $arr_group_btt[$v->bidang]['realisasi'] += (float)$v->realisasi;
            }
        }


        $log_penarikan = \DB::table('t_log_penarikan')->orderBy('created_at', 'DESC')->first();


        $data = [
            'kesehatan' => $kesehatan,
            'vaksin' => $vaksin,
            'ekonomi' => $ekonomi,
            'jps' => $jps,
            'bst' => $bst,
            'pkh' => $pkh,
            'sembako' => $sembako,
            'beras' => $beras,
            'beras_ppkm' => $beras_ppkm,
            'total_bantuan_uang' => $total_bantuan_uang,
            'total_bantuan_barang' => $total_bantuan_barang,
            'santunan_covid' => $santunan_covid,
            'total_bdh' => $total_bdh,
            'total_swd' => $total_swd,
            'data_btt' => $data_btt,
            'arr_group_btt' => $arr_group_btt,
            'log_penarikan' => $log_penarikan
        ];

        return view("home.index")->with($data);
    }

    private function get_total_bantuan_uang()
    {
        $total = 0;
        $obj_csr = new Csr;

        $bantuan_uang = $obj_csr->get_list_bantuan_uang();
        if($bantuan_uang) {
            foreach ($bantuan_uang->data as $key => $value) {
                $total += $value->penerimaan;
            }
        }


        return $total;
    }

    private function get_total_bantuan_barang()
    {
        $total = 0;
        $obj_csr = new Csr;

        $bantuan_barang = $obj_csr->get_list_bantuan_barang();
        if($bantuan_barang) {
            foreach ($bantuan_barang->data as $key => $value) {
                $total += $value->penerimaan * $value->hargasatuan;
            }
        }

        return $total;
    }


    public function datatable_rekap_penjualan_dist_perbulan()
    {
    	$table = \App\Models\Query_data::jmlTransaksi()->get();
    	dd($table);

        // dd(DB::getquerylog());
    	$datas = [];
    	$i = 1;
    	foreach ($table as $key => $value) {

    		$datas[$key][] = $i++;
            $datas[$key][] = $value->nama;
            $datas[$key][] = $value->satuan;
    		$datas[$key][] = date('d-m-Y',strtotime($value->tgl_kirim));
            $datas[$key][] = '<a class="btn btn-warning btn-sm" target="_blank" >Edit</a>';
    	}

    	$data = [
    		'data' => $datas
    	];

    	return response()->json($data);
    }
}
