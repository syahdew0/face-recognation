<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RekapabsensiController extends Controller
{
    public function index()
    {
        $namaBulan = [
            "", "Januari", "Februari", "Maret",
            "April", "Mei", "Juni", "Juli",
            "Agustus", "September", "Oktober", "Desember"
        ];

        $index = 0;
        $tahunNow = date("Y");
        for ($i = 2023; $i <= $tahunNow; $i++) {
            $tahun[$index++] = $i;
        }

        return view('admin.rekapabsensi.index', [
            'bulan' => $namaBulan,
            'years' => $tahun
        ]);
    }

    public function cetak(Request $request)
    {
        $bulan = $request->bulan;
        $tahun = $request->tahun;

        $rekapitulasi = DB::table('attendance')
            ->selectRaw(
                'nama_lengkap,
        MAX(IF(DAY(tanggal_absensi) = 1, CONCAT(jam_masuk,"-", IFNULL(jam_pulang,"00:00:00")),"")) as tgl_1,
        MAX(IF(DAY(tanggal_absensi) = 2, CONCAT(jam_masuk,"-", IFNULL(jam_pulang,"00:00:00")),"")) as tgl_2,
        MAX(IF(DAY(tanggal_absensi) = 3, CONCAT(jam_masuk,"-", IFNULL(jam_pulang,"00:00:00")),"")) as tgl_3,
        MAX(IF(DAY(tanggal_absensi) = 4, CONCAT(jam_masuk,"-", IFNULL(jam_pulang,"00:00:00")),"")) as tgl_4,
        MAX(IF(DAY(tanggal_absensi) = 5, CONCAT(jam_masuk,"-", IFNULL(jam_pulang,"00:00:00")),"")) as tgl_5,
        MAX(IF(DAY(tanggal_absensi) = 6, CONCAT(jam_masuk,"-", IFNULL(jam_pulang,"00:00:00")),"")) as tgl_6,
        MAX(IF(DAY(tanggal_absensi) = 7, CONCAT(jam_masuk,"-", IFNULL(jam_pulang,"00:00:00")),"")) as tgl_7,
        MAX(IF(DAY(tanggal_absensi) = 8, CONCAT(jam_masuk,"-", IFNULL(jam_pulang,"00:00:00")),"")) as tgl_8,
        MAX(IF(DAY(tanggal_absensi) = 9, CONCAT(jam_masuk,"-", IFNULL(jam_pulang,"00:00:00")),"")) as tgl_9,
        MAX(IF(DAY(tanggal_absensi) = 10, CONCAT(jam_masuk,"-", IFNULL(jam_pulang,"00:00:00")),"")) as tgl_10,
        MAX(IF(DAY(tanggal_absensi) = 11, CONCAT(jam_masuk,"-", IFNULL(jam_pulang,"00:00:00")),"")) as tgl_11,
        MAX(IF(DAY(tanggal_absensi) = 12, CONCAT(jam_masuk,"-", IFNULL(jam_pulang,"00:00:00")),"")) as tgl_12,
        MAX(IF(DAY(tanggal_absensi) = 13, CONCAT(jam_masuk,"-", IFNULL(jam_pulang,"00:00:00")),"")) as tgl_13,
        MAX(IF(DAY(tanggal_absensi) = 14, CONCAT(jam_masuk,"-", IFNULL(jam_pulang,"00:00:00")),"")) as tgl_14,
        MAX(IF(DAY(tanggal_absensi) = 15, CONCAT(jam_masuk,"-", IFNULL(jam_pulang,"00:00:00")),"")) as tgl_15,
        MAX(IF(DAY(tanggal_absensi) = 16, CONCAT(jam_masuk,"-", IFNULL(jam_pulang,"00:00:00")),"")) as tgl_16,
        MAX(IF(DAY(tanggal_absensi) = 17, CONCAT(jam_masuk,"-", IFNULL(jam_pulang,"00:00:00")),"")) as tgl_17,
        MAX(IF(DAY(tanggal_absensi) = 18, CONCAT(jam_masuk,"-", IFNULL(jam_pulang,"00:00:00")),"")) as tgl_18,
        MAX(IF(DAY(tanggal_absensi) = 19, CONCAT(jam_masuk,"-", IFNULL(jam_pulang,"00:00:00")),"")) as tgl_19,
        MAX(IF(DAY(tanggal_absensi) = 20, CONCAT(jam_masuk,"-", IFNULL(jam_pulang,"00:00:00")),"")) as tgl_20,
        MAX(IF(DAY(tanggal_absensi) = 21, CONCAT(jam_masuk,"-", IFNULL(jam_pulang,"00:00:00")),"")) as tgl_21,
        MAX(IF(DAY(tanggal_absensi) = 22, CONCAT(jam_masuk,"-", IFNULL(jam_pulang,"00:00:00")),"")) as tgl_22,
        MAX(IF(DAY(tanggal_absensi) = 23, CONCAT(jam_masuk,"-", IFNULL(jam_pulang,"00:00:00")),"")) as tgl_23,
        MAX(IF(DAY(tanggal_absensi) = 24, CONCAT(jam_masuk,"-", IFNULL(jam_pulang,"00:00:00")),"")) as tgl_24,
        MAX(IF(DAY(tanggal_absensi) = 25, CONCAT(jam_masuk,"-", IFNULL(jam_pulang,"00:00:00")),"")) as tgl_25,
        MAX(IF(DAY(tanggal_absensi) = 26, CONCAT(jam_masuk,"-", IFNULL(jam_pulang,"00:00:00")),"")) as tgl_26,
        MAX(IF(DAY(tanggal_absensi) = 27, CONCAT(jam_masuk,"-", IFNULL(jam_pulang,"00:00:00")),"")) as tgl_27,
        MAX(IF(DAY(tanggal_absensi) = 28, CONCAT(jam_masuk,"-", IFNULL(jam_pulang,"00:00:00")),"")) as tgl_28,
        MAX(IF(DAY(tanggal_absensi) = 29, CONCAT(jam_masuk,"-", IFNULL(jam_pulang,"00:00:00")),"")) as tgl_29,
        MAX(IF(DAY(tanggal_absensi) = 30, CONCAT(jam_masuk,"-", IFNULL(jam_pulang,"00:00:00")),"")) as tgl_30,
        MAX(IF(DAY(tanggal_absensi) = 31, CONCAT(jam_masuk,"-", IFNULL(jam_pulang,"00:00:00")),"")) as tgl_31'
            )->whereRaw('MONTH(tanggal_absensi)="' . $bulan . '"')
            ->whereRaw('YEAR(tanggal_absensi)="' . $tahun . '"')
            ->groupByRaw('nama_lengkap')
            ->get();

        $namaBulan = [
            "", "Januari", "Februari", "Maret",
            "April", "Mei", "Juni", "Juli",
            "Agustus", "September", "Oktober", "Desember"
        ];

        $no = 1;

        return view('admin.rekapabsensi.cetak',[
            'bulan' => $bulan,
            'tahun' => $tahun,
            'nomor' => $no,
            'rekapitulasi' => $rekapitulasi,
            'namabulan' => $namaBulan
        ]);
    }
}
