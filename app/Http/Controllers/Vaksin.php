<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
class Vaksin extends Controller
{
    public function jadwal_vaksin()
    {
    	$jadwal = \App\Models\T_vaksinasi::orderBy('created_at','desc')->get();

		return view("vaksinasi.jadwal_vaksinasi")->with([
            'data' => [
                'jadwal' => $jadwal
            ]
        ]);
    }

    public function vaksinasi_detail($id)
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

		return view("vaksinasi.vaksinasi_detail")->with([
            'data' => [
                'jadwal' => $jadwal
            ]
        ]);
    }
}
