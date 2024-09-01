<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Cetak Rekapitulasi Presensi</title>

    <!-- Normalize or reset CSS with your favorite library -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/7.0.0/normalize.min.css">

    <!-- Load paper.css for happy printing -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/paper-css/0.4.1/paper.css">

    <!-- Set page size here: A5, A4 or A3 -->
    <!-- Set also "landscape" if you need -->
    <style>
        @page {
            size: A4
        }

        .tabelpresensi tr th {
            border: 1px #131212;
            padding: 8px;
            background-color: #dbdbdb;
            font-size: 10px;
        }
    </style>
</head>

<!-- Set "A5", "A4" or "A3" for class name -->
<!-- Set also "landscape" if you need -->

<body class="A4 landscape">

    <!-- Each sheet element should have the class "sheet" -->
    <!-- "padding-**mm" is optional: you can set 10, 15, 20 or 25 -->
    <section class="sheet padding-10mm">

        <!-- Write HTML just like a web page -->
        <table style="width: 100%">
            <tr>
                <td style="width: 80px">
                    <img src="{{ asset('storage/logo/logo.png') }}" width="120" height="60" alt="">
                </td>
                <td>
                    <h5>
                        REKAPITULASI PRESENSI KARYAWAN<br>
                        PERIODE {{ strtoupper($namabulan[$bulan]) }} {{ $tahun }}<br>
                        PERUM BULOG KANTOR WILAYAH SUMATERA UTARA
                    </h5>
                </td>
            </tr>
        </table>
        <table class="tabelpresensi">
            <tr>
                <th rowspan="2">No</th>
                <th rowspan="2">Nama Karyawan</th>
                <th colspan="31">Tanggal</th>
                <th rowspan="2">TH</th>                
            </tr>
            <tr>
                @for ($i = 1; $i <= 31; $i++)
                    <th>{{ $i }}</th>
                @endfor
            </tr>

            @foreach ($rekapitulasi as $rekap)
                <tr>
                    <td>{{ $nomor++ }}</td>
                    <td>{{ $rekap->nama_lengkap }}</td>
                    @php
                        $totalhadir = 0;
                    @endphp
                    @for ($i = 1; $i <= 31; $i++)
                        @php
                            
                            $tgl = 'tgl_' . $i;
                            $jammasuk = [];
                            $jamkeluar = [];
                            $masuk = "";
                            $keluar = "";
                            if (empty($rekap->$tgl)) {
                                $absensi = ['', ''];                                
                            } else {                                
                                $absensi = explode('-', $rekap->$tgl);
                                $totalhadir += 1;
                                $jammasuk = explode(':', $absensi[0]);
                                $masuk = $jammasuk[0] . "." . $jammasuk[1];    
                                $jamkeluar = explode(':', $absensi[1]);
                                $keluar = $jamkeluar[0] . "." . $jamkeluar[1];                                    
                            }
                            
                        @endphp
                        <td>
                            @if (($masuk >= "07.00") && ($masuk <= "08.00"))
                                <span style="color:green;">{{ $masuk }}</span>
                            @else
                                <span style="color:red;">{{ $masuk }}</span>
                            @endif
                            <br>
                            @if (($keluar > "08.00") && ($keluar < "17.00"))
                                <span style="color:red;">{{ $keluar }}</span>
                            @else
                                <span>{{ $keluar }}</span>
                            @endif                            
                        </td>                        
                    @endfor
                    <td>{{ $totalhadir }}</td>                    
                </tr>
            @endforeach

        </table>

    </section>

</body>

</html>
