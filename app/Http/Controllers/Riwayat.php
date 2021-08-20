<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
class Riwayat extends Controller
{
    public function riwayat()
    {
    	$jadwal = \App\Models\T_vaksinasi::orderBy('created_at','desc')->get();

		return view("riwayat.index")->with([
            'data' => [
                'jadwal' => $jadwal
            ]
        ]);
    }

    public function riwayat_detail($id)
    {
        $jadwal = \App\Models\T_vaksinasi::where('id', $id)->first();

        if($jadwal) {
            $cek_kuota = \App\Models\T_pendaftaran::CounterPendaftar($id);
            if($cek_kuota >= (int)$jadwal->kuota) {
                abort(404);
            }
         }else{
            abort(404);
        }

		return view("riwayat.riwayat_detail")->with([
            'data' => [
                'jadwal' => $jadwal
            ]
        ]);
    }
}
