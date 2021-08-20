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
}
