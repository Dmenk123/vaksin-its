<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
class Dashboard extends Controller
{
    public function index()
    {
		$data = [
        ];

        return view("beranda.index")->with($data);
    }
}
