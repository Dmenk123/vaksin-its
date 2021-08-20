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

    public function vaksinasi_simpan(Request $request)
    {
        //dd($request->all());

        ## maaf bapak/ibu validasinya belum

        $new_data = new \App\Models\T_pendaftaran();
        \DB::beginTransaction();

        $new_data->nama = $request->f_nama;
        $new_data->nik = $request->f_nik;
        $new_data->usia = $request->f_usia;
        $new_data->alamat_domisili = $request->f_alamat_domisili;
        $new_data->alamat_ktp = $request->f_alamat_ktp;
        $new_data->jk = $request->f_jk;
        $new_data->pekerjaan = $request->f_pekerjaan;
        $new_data->created_at = \Carbon\Carbon::now()->format('Y-m-d H:i:s');
        $new_data->id_vaksinasi = $request->f_id;

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
