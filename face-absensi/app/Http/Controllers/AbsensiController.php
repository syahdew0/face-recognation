<?php

namespace App\Http\Controllers;

use App\Models\Attend;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class AbsensiController extends Controller
{
    public function index()
    {
        $today = date("Y-m-d");
        $idKaryawan = auth()->user()->id;
        $karyawan = DB::table('users')->where('id', $idKaryawan)->first();

        $cek = DB::table('attendance')->where('tanggal_absensi', $today)->where('nama_lengkap', $karyawan->nama_lengkap)->count();

        return view('user.absensi.index', [
            'cek' => $cek
        ]);
    }

    public function store(Request $request)
    {
        $kode = DB::table('attendance')->count();
        $kode_absensi = $kode + 1;

        $karyawan = DB::table('users')->where('id', $request->idKaryawan)->first();
        $nama_lengkap = $karyawan->nama_lengkap;
        $nama_divisi = $karyawan->divisi;
        $image = $request->image;

        $tanggal_absensi = date("Y-m-d");
        $jam = date("H:i:s");

        $cek = DB::table('attendance')->where('tanggal_absensi', $tanggal_absensi)->where('nama_lengkap', $nama_lengkap)->count();

        if ($cek > 0) {
            $ket = "out";
        } else {
            $ket = "in";
        }

        // $folderPath = "absensi/";
        // $formatName = $nama_lengkap . "-" . $tanggal_absensi . "-" . $ket;
        // $image_parts = explode(";base64", $image);
        // $image_base64 = base64_decode($image_parts[1]);
        // $fileName = $formatName . ".jpg";
        // $file = $folderPath . $fileName;

        if ($cek > 0) {
            $absenPulang = [
                'jam_pulang' => $jam,
                // 'foto_pulang' => $fileName
            ];

            $pulang = DB::table('attendance')->where('tanggal_absensi', $tanggal_absensi)->where('nama_lengkap', $nama_lengkap)->update($absenPulang);
            if ($pulang) {
                echo "success|Terima Kasih, Selamat Pulang";
                // Storage::put($file, $image_base64);
            } else {
                echo "error|Maaf gagal absen, Silahkan ulangi";
            }
            
        } else {
            $absenMasuk = [
                'kode_absensi' => 'KA' . $kode_absensi,
                'nama_lengkap' => $nama_lengkap,
                'nama_divisi' => $nama_divisi,
                'tanggal_absensi' => $tanggal_absensi,
                'jam_masuk' => $jam,
                // 'foto_masuk' => $fileName
            ];

            $masuk = DB::table('attendance')->insert($absenMasuk);
            if ($masuk) {
                echo "success|Terima Kasih, Selamat Bekerja";
                // Storage::put($file, $image_base64);
            } else {
                echo "error|Maaf gagal absen, silahkan ulangi";
            }
        }
    }

    public function monitoringPage ()
    {
        $attendance = DB::table('attendance')->get();
        $no = 1;

        return view('admin.monitoringabsensi.index',[
            'attendance' => $attendance,
            'nomor' => $no
        ]);
    }   

    public function cariAbsensi (Request $request)
    {        
        $no = 1;
        $cari = $request->cari;
        $attendace = DB::table('attendance')->where('nama_lengkap', 'like', "%".$cari."%")->get();

        return view('admin.monitoringabsensi.index',[
            'attendance' => $attendace,
            'nomor' => $no
        ]);

    }

}
