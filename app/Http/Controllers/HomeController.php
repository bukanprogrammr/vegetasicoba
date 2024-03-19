<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data = [
            'title' => 'Welcome.',
            'kecamatan' => DB::table('tbl_kec')->count(),
            'level' => DB::table('tbl_level')->count(),
            'vegetasi' => DB::table('tbl_vegetasi')->count(),
        ];
        return view('home', $data);
    }
}
