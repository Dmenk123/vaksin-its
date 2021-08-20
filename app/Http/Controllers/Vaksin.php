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

    public function vaksinasi_detail()
    {
		return view("vaksinasi.vaksinasi_detail")->with([
            'data' => []
        ]);
    }
}
