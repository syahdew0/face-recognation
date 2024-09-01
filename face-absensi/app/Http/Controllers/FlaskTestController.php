<?php

namespace App\Http\Controllers;


use App\Models\User;

use App\Models\Karyawan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class FlaskTestController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // public function uploadImage()
    // {
    //     $user = auth()->user();
    //     $fullName = $user->nama_lengkap; // Mengambil nama lengkap dari kolom 'nama_lengkap'

    //     return redirect()->away('http://127.0.0.1:5000/upload?fullName=' . urlencode($fullName));
    // }

    public function uploadImage(Request $request)
    {
        // Ambil idKaryawan dari request
        $idKaryawan = $request->query('idKaryawan');

        // Cari user berdasarkan idKaryawan
        $user = User::find($idKaryawan);

        // Pastikan user ditemukan
        if (!$user) {
            return redirect()->back()->with('error', 'User tidak ditemukan.');
        }

        // Ambil nama lengkap dari kolom 'nama_lengkap'
        $fullName = $user->nama_lengkap;

        // Redirect ke server Python dengan parameter fullName
        return redirect()->away('http://127.0.0.1:5000/upload?fullName=' . urlencode($fullName));
    }


    public function accessTestEndpoint()
    {
        // Mengirim permintaan GET ke server Flask
        $response = Http::get('http://127.0.0.1:5000/test');

        // Memeriksa apakah permintaan berhasil
        if ($response->successful()) {
            // Mengembalikan respon dari Flask sebagai view
            return response($response->body());
        }

        return response()->json(['message' => 'Request failed'], 500);
    }


    public function showDashboard(Request $request)
    {
        // Ambil data dari query parameter
        $status = $request->query('status');
        $name = $request->query('name');

        // Mendapatkan data pengguna yang sedang login
        $user = Auth::user();

        // Cek apakah nama yang dikirim sesuai dengan nama pengguna yang sedang login
        if ($user->nama_lengkap !== $name) {
            return view('test-eror', ['message' => 'Wajah tidak sesuai dengan wajah pengguna yang sedang login']);
        }

        $nama_lengkap = $user->nama_lengkap;
        $nama_divisi = $user->divisi;
        $tanggal_absensi = date("Y-m-d");
        $jam = date("H:i:s");

        // Mengecek apakah sudah ada absensi hari ini
        $cek = DB::table('attendance')
            ->where('tanggal_absensi', $tanggal_absensi)
            ->where('nama_lengkap', $nama_lengkap)
            ->count();

        // Menentukan jenis absensi (masuk atau pulang)
        $ket = $cek > 0 ? "out" : "in";

        // Proses absensi masuk atau pulang
        if ($cek > 0) {
            // Proses pulang
            $absenPulang = [
                'jam_pulang' => $jam,
                'updated_at' => now()
            ];

            $pulang = DB::table('attendance')
                ->where('tanggal_absensi', $tanggal_absensi)
                ->where('nama_lengkap', $nama_lengkap)
                ->update($absenPulang);

            if ($pulang) {
                // echo "success|Terima Kasih, Selamat Pulang";
                return redirect()->intended('/home')->with('success', 'Terima Kasih, Selamat Pulang');
            } else {
                echo "error|Maaf gagal absen, Silahkan ulangi";
            }
        } else {
            // Proses masuk
            $absenMasuk = [
                'kode_absensi' => 'KA' . (DB::table('attendance')->count() + 1),
                'nama_lengkap' => $nama_lengkap,
                'nama_divisi' => $nama_divisi,
                'tanggal_absensi' => $tanggal_absensi,
                'jam_masuk' => $jam,
                'created_at' => now(),
                'updated_at' => now()
            ];

            $masuk = DB::table('attendance')->insert($absenMasuk);
            if ($masuk) {
                // echo "success|Terima Kasih, Selamat Bekerja";
                return redirect()->intended('/home')->with('success', 'Terima Kasih, Selamat Bekerja');
            } else {
                echo "error|Maaf gagal absen, silahkan ulangi";
            }
        }

        return view('test', compact('status', 'name', 'nama_lengkap'));
    }
}
