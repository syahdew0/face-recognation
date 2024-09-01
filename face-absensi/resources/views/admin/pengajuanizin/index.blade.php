@extends('admin.partials.main')

@section('container')
    <div class="row mb-5">
        <div class="col">
            <h4>Pengajuan Izin</h4>
        </div>        
    </div>
    <div class="row mt-5">
        <div class="col">
            <table class="table table-responsive table-hover">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Nama Lengkap</th>
                        <th scope="col">Divisi</th>                        
                        <th scope="col">Jenis Izin</th>
                        <th scope="col">Tanggal</th>                        
                        <th scope="col">Keterangan</th>                        
                    </tr>
                </thead>
                <tbody>
                    @foreach ($permits as $permit)
                        <tr>
                            <th scope="row">{{ $nomor++ }}</th>
                            <td>{{ $permit->nama_lengkap }}</td>
                            <td>{{ $permit->nama_divisi }}</td>
                            <td>
                                @if ($permit->jenis_izin == '1')
                                    Izin
                                @else
                                    Sakit
                                @endif
                            </td>
                            <td>{{ $permit->tanggal_izin }}</td>
                            <td>{{ $permit->keterangan_izin }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection