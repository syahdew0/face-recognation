<?php

namespace App\Http\Controllers;

use App\Models\Permit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PengajuanizinController extends Controller
{
    public function index ()
    {
        $permits = Permit::get();
        $no = 1;
        
        return view('admin.pengajuanizin.index',[
            'permits' => $permits,
            'nomor' => $no
        ]);
    }


    public function tambahPage ()
    {
        return view('user.ajukanizin.tambah');
    }

    public function ajukanIzin (Request $request)
    {
        $kode = DB::table('permits')->count();
        $kode_izin = $kode + 1;

        $data = [
            'kode_izin' => 'KI' . $kode_izin,
            'nama_lengkap' => $request->nama_lengkap,
            'nama_divisi' => $request->nama_divisi,
            'jenis_izin' => $request->jenis_izin,
            'tanggal_izin' => $request->tanggal_izin,
            'keterangan_izin' => $request->keterangan_izin
        ];

        $izin = Permit::create($data);

        if ($izin) {
            return redirect()->intended('/home')->with('success', 'Pengajuan izin berhasil dilakukan');
        } else {
            return redirect()->intended('/home')->with('failed', 'Pengajuan izin gagal diajukan');
        }
        
    }
}
