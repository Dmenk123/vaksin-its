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
            $kipi = \App\Models\T_kipi::with('vaksinasi')->where('id_vaksinasi', $id)->get();
            $cek_kuota = \App\Models\T_pendaftaran::CounterPendaftar($id);
            if($cek_kuota >= (int)$jadwal->kuota) {
                abort(404);
            }
         }else{
            abort(404);
        }

		return view("riwayat.riwayat_detail")->with([
            'data' => [
                'jadwal' => $jadwal,
                'kipi' => $kipi
            ]
        ]);
    }


    public function kipi_simpan(Request $request)
    {
        ## maaf bapak/ibu validasinya belum

        $new_data = new \App\Models\T_kipi();
        \DB::beginTransaction();
        $new_data->id_pendaftaran = $request->f_id_pendaftaran;
        $new_data->id_vaksinasi = $request->f_id;
        $new_data->tanggal = \Carbon\Carbon::parse($request->f_tanggal)->format('Y-m-d');
        $new_data->gejala = $request->f_gejala;
        $new_data->tindakan = $request->f_tindakan;
        $new_data->is_hub_dokter = $request->f_is_hub_dokter;
        $new_data->created_at = \Carbon\Carbon::now()->format('Y-m-d H:i:s');

        try {
            $new_data->save();

            \DB::commit();

            return \Response::json([
                "status"    => "success",
                "message"    => 'Berhasil Melakukan Simpan Data',
            ]);
        } catch (\Exception $e) {
            \DB::rollback();
            // dd($e);
            return \Response::json([
                "status"    => "error",
                "message"    => 'Gagal Melakukan Simpan Data',
            ]);
        }

    }
}
