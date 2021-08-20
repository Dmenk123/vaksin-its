<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class Login extends Controller
{
    public function index()
    {
        if(session('logged_in') != null){
            return redirect('/');
        }

		return view("home.login")->with([

        ]);
    }

    public function cek(Request $request)
    {
    	$messages = [
            'username.required' => '* masukkan Username<br>',
            'password.required' => '* masukkan password<br>',
        ];

        $validator = Validator::make($request->all(), [
            'username' => ['required','string'],
            'password' => ['required','string'],
        ], $messages);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return \Response::json([
                'error' => [
                    'username' => $errors->first('username'),
                    'password' => $errors->first('password'),
                ]
            ]);
        }


		$cek = \App\Models\M_user::where([
			'username' => $request->username,
			'is_aktif' => '1',
		])->first();

		if($cek){
			$cek_hash = \Hash::check($request->password, $cek->password);
			if ($cek_hash == false) {
                return \Response::json([
                    'error'  => ['Mohon maaf, username dan password Anda salah'],
                ]);
            } else if ($cek_hash === true) {
                $request->session()->put('logged_in', 'true');
                $request->session()->put('logged_in.id', $cek->id);
                $request->session()->put('logged_in.nama', $cek->nama);
                $request->session()->put('logged_in.nip', $cek->nip);
                $request->session()->put('logged_in.username', $cek->username);
                // $request->session()->put('logged_in.role', $cek->role);
                $request->session()->regenerate();
            }

            return \Response::json([
                'redirect' => route('index'),
                'status'  => true,
            ]);
		}

		return \Response::json([
            'status'  => false,
            'messages'  => 'User dan password salah !',
        ]);
    }

    public function generate_hash($txt)
    {
        echo \Hash::make($txt);
    }
}
