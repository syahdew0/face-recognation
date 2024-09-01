<?php

namespace App\Http\Controllers;

use App\Models\Division;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class KaryawanController extends Controller
{
    public function index()
    {
        $karyawans = User::get();
        $no = 1;

        return view('admin.karyawan.index', [
            'karyawans' => $karyawans,
            'nomor' => $no
        ]);
    }

    
    public function tambahPage()
    {
        $divisions = Division::get();

        return view('admin.karyawan.tambah', [
            'divisions' => $divisions
        ]);
    }

    public function tambahKaryawan(Request $request)
    {
        $divisi = DB::table('divisions')->where('kode_divisi', $request->divisi)->first();

        $validatedData = $request->validate([
            'email' => 'required',
            'password' => 'required',
            'foto' => 'image|file|max:2048'
        ]);

        $validatedData['nama_lengkap'] = $request->nama_lengkap;
        $validatedData['email'] = $request->email;
        $validatedData['password'] = bcrypt($request->password);
        $validatedData['role'] = $request->role;
        $validatedData['divisi'] = $divisi->nama_divisi;
        $validatedData['alamat'] = $request->alamat;
        $validatedData['no_hp'] = $request->no_hp;

        if ($request->file('foto')) {
            $validatedData['foto'] = $request->file('foto')->store('foto-karyawan');
        }

        $karyawan = User::create($validatedData);

        if ($karyawan) {
            return redirect()->intended('/datakaryawan')->with('success', 'Data karyawan berhasil ditambahkan');
        } else {
            return redirect()->intended('/datakaryawan')->with('failed', 'Data karyawan gagal ditambahkan');
        }
    }

    public function hapusKaryawan(Request $request)
    {
        $namaGambar = DB::table('users')->where('id', $request->idKaryawan)->first();
        if ($namaGambar->foto) {
            Storage::delete($namaGambar->foto);
        }

        $karyawan = User::destroy($request->idKaryawan);

        if ($karyawan) {
            return redirect()->intended('/datakaryawan')->with('success', 'Data karyawan berhasil dihapus');
        } else {
            return redirect()->intended('/datakaryawan')->with('failed', 'Data karyawan gagal dihapus');
        }
    }

    public function editPage(Request $request)
    {
        $karyawan = DB::table('users')->where('id', $request->idKaryawan)->first();
        $divisions = DB::table('divisions')->get();

        return view('admin.karyawan.edit', [
            'karyawan' => $karyawan,
            'divisions' => $divisions
        ]);
    }

    public function editKaryawan(Request $request)
    {
        $divisi = DB::table('divisions')->where('kode_divisi', $request->divisi)->first();

        $data = [
            'nama_lengkap' => $request->nama_lengkap,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => $request->role,
            'divisi' => $divisi->nama_divisi,
            'alamat' => $request->alamat,
            'no_hp' => $request->no_hp,
            // 'foto' => ''
        ];

        // if ($request->foto) {
        //     if ($request->oldFoto) {
        //         Storage::delete($request->oldFoto);
        //     }
        //     $data['foto'] = $request->file('foto')->store('foto-karyawan');
        // } else {
        //     $data['foto'] = $request->oldFoto;
        // }

        $karyawan = DB::table('users')->where('id', $request->idKaryawan)->update($data);

        if ($karyawan) {
            return redirect()->intended('/datakaryawan')->with('success', 'Data karyawan berhasil diubah');
        } else {
            return redirect()->intended('/datakaryawan')->with('failed', 'Data karyawan gagal diubah');
        }
    }

    public function getKaryawan($id)
    {
        $karyawan = User::find($id);
        if ($karyawan) {
            return response()->json(['nama_lengkap' => $karyawan->nama_lengkap]);
        } else {
            return response()->json(['error' => 'Karyawan not found'], 404);
        }
    }
    
    
    public function cariKaryawan(Request $request)
    {
        $no = 1;
        $cari = $request->cari;
        $karyawans = DB::table('users')->where('nama_lengkap', 'like', "%" . $cari . "%")->get();

        return view('admin.karyawan.index', [
            'karyawans' => $karyawans,
            'nomor' => $no
        ]);
    }
    
}
