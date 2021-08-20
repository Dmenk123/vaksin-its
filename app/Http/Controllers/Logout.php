<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Logout extends Controller
{
	public function index(Request $request)
	{

	    $request->session()->invalidate();

	    $request->session()->regenerateToken();

	    return redirect('/login');
	}
}
