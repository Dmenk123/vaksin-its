<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
class Riwayat extends Controller
{
    public function riwayat()
    {
    	// $imtas = \App\Models\T_detail_periode::whereHas('t_periode', function(Builder $query){
    	// 	$query->where('aktif', '1');
    	// 	$query->where('id_korcab', session('logged_in.id_korcab'));
    	// })->with('t_periode','m_agenda_kegiatan')->orderBy('urut','asc')->get();

		return view("riwayat.index")->with([
            'data' => []
        ]);
    }
}
