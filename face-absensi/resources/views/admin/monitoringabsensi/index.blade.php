@extends('admin.partials.main')

@section('container')
    <div class="row mb-3">
        <div class="col">
            <form class="d-flex" role="search" action="/monitoringabsensi/cari" method="GET">
                <input class="form-control me-2" type="text" aria-label="Search" name="cari" id="cari"
                    placeholder="Cari nama">
                <button class="btn btn-outline-success" type="submit">Search</button>
            </form>
        </div>
    </div>    
    <div class="row">
        <div class="col">
            <table class="table table-responsive table-hover">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Nama Lengkap</th>
                        <th scope="col">Divisi</th>
                        <th scope="col">Tanggal</th>
                        <th scope="col">Jam Masuk</th>
                        <th scope="col">Keterangan Masuk</th>
                        <th scope="col">Jam Pulang</th>
                        <th scope="col">keterangan Pulang</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($attendance as $attend)
                        <tr>
                            <th scope="row">{{ $nomor++ }}</th>
                            <td>{{ $attend->nama_lengkap }}</td>
                            <td>{{ $attend->nama_divisi }}</td>
                            <td>{{ $attend->tanggal_absensi }}</td>
                            <td>{{ $attend->jam_masuk }}</td>
                            <td>
                                @if ($attend->jam_masuk >= '07:00:00' && $attend->jam_masuk <= '08:00:00')
                                    <span class="badge text-bg-success">Tepat Waktu</span>
                                @else
                                    <span class="badge text-bg-danger">Terlambat</span>
                                @endif
                            </td>
                            <td>
                                @if ($attend->jam_pulang == null)
                                    -
                                @else
                                    {{ $attend->jam_pulang }}
                                @endif
                            </td>
                            <td>
                                @if ($attend->jam_pulang)
                                    @if ($attend->jam_pulang > "08:00:00" && $attend->jam_pulang < "17:00:00")
                                        <span class="badge text-bg-danger">Lebih Awal</span>
                                    @endif
                                    @if ($attend->jam_pulang >= "17:00:00" && $attend->jam_pulang <= "17:30:00")
                                        <span class="badge text-bg-success">Tepat Waktu</span>
                                    @endif
                                    @if ($attend->jam_pulang > "17:30:00" && $attend->jam_pulang < '23:59:00')
                                        <span class="badge text-bg-warning">diluar jam kerja</span>
                                    @endif
                                    @if ($attend->jam_pulang >= "00:00:00" && $attend->jam_pulang < "07:00:00")
                                        <span class="badge text-bg-warning">diluar jam kerja</span>
                                    @endif
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
