<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index ()
    {
        $today = date("Y-m-d");
        $idKaryawan = auth()->user()->id;
        $karyawan = DB::table('users')->where('id', $idKaryawan)->first();

        $absensiToday = DB::table('attendance')->where('tanggal_absensi', $today)->where('nama_lengkap', $karyawan->nama_lengkap)->first();

        return view('user.home.index',[
            'absensiToday' => $absensiToday
        ]);
    }
}
