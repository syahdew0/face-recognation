<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index ()
    {
        $today = date('d F Y');

        $absensi = DB::table('attendance')->count();
        $divisi = DB::table('divisions')->count();
        $karyawan = DB::table('users')->count();

        return view('admin.dashboard.index',[
            'today' => $today,
            'absensi' => $absensi,
            'divisi' => $divisi,
            'karyawan' => $karyawan
        ]);
    }
}
