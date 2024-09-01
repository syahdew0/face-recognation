<?php

namespace App\Http\Controllers;

use App\Models\Division;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DivisiController extends Controller
{
    public function index ()
    {
        $divisions = Division::get();
        $no = 1;

        return view('admin.divisi.index',[
            'divisions' => $divisions,
            'nomor' => $no
        ]);
    }

    public function tambahPage ()
    {
        return view('admin.divisi.tambah');
    }

    public function tambahDivisi (Request $request)
    {
        $kode = DB::table('divisions')->count();
        $kode_divisi = $kode + 1;

        $data = [
            'kode_divisi' => 'KD' . $kode_divisi,
            'nama_divisi' => $request->nama_divisi
        ];

        $divisi = Division::create($data);

        if ($divisi) {
            return redirect()->intended('/datadivisi')->with('success', 'Data divisi berhasil ditambahkan');
        } else {
            return redirect()->intended('/datadivisi')->with('failed', 'Data divisi gagal ditambahkan');
        }        
    }

    public function hapusDivisi (Request $request)
    {
        $divisi = Division::destroy($request->idDivisi);

        if ($divisi) {
            return redirect()->intended('/datadivisi')->with('success', 'Data divisi berhasil dihapus');
        } else {
            return redirect()->intended('/datadivisi')->with('failed', 'Data divisi gagal dihapus');
        }
    }
}
