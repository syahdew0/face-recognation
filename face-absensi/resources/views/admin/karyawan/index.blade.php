@extends('admin.partials.main')

@section('container')
    <div class="row mb-4">
        <h4>Data Karyawan</h4>
    </div>
    <div class="row mb-3">
        <div class="col text-end">
            <a href="/datakaryawan/tambah"><button type="button" class="btn btn-primary"><i class="bi bi-plus me-2"></i>Tambah
                    Karyawan</button></a>
        </div>
    </div>
    
    <div class="row mb-3">
        <div class="col">
            <form class="d-flex" role="search" action="/datakaryawan/cari" method="GET">
                <input class="form-control me-2" type="text" aria-label="Search" name="cari" id="cari"
                    placeholder="Cari nama">
                <button class="btn btn-outline-success" type="submit">Search</button>
            </form>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col">
            @if (session()->has('failed'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('failed') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            @if (session()->has('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
        </div>
        <div class="row px-2">
            <table class="table table-responsive table-hover">
                <thead>
                    <th scope="col">No</th>
                    <th scope="col">Nama Lengkap</th>
                    <th scope="col">Email</th>
                    <th scope="col">Divisi</th>
                    <th scope="col">Alamat</th>
                    <th scope="col">Telepon</th>
                    {{-- <th scope="col">Foto</th> --}}
                    <th scope="col">Aksi</th>
                </thead>
                <tbody>
                    @foreach ($karyawans as $karyawan)
                        <tr>
                            <th scope="row">{{ $nomor++ }}</th>
                            <td>{{ $karyawan->nama_lengkap }}</td>
                            <td>{{ $karyawan->email }}</td>
                            <td>{{ $karyawan->divisi }}</td>
                            <td>{{ $karyawan->alamat }}</td>
                            <td>{{ $karyawan->no_hp }}</td>
                            {{-- @if ($karyawan->foto)
                                <td><img src="{{ asset('storage/' . $karyawan->foto) }}" alt="{{ $karyawan->nama_lengkap }}"
                                        class="img-fluid rounded" width="35px"></td>
                            @else
                                <td><svg xmlns="http://www.w3.org/2000/svg" width="35" height="35"
                                        fill="currentColor" class="bi bi-person-square" viewBox="0 0 16 16">
                                        <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0" />
                                        <path
                                            d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2zm12 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1v-1c0-1-1-4-6-4s-6 3-6 4v1a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1z" />
                                    </svg></td>
                            @endif --}}
                            <td>
                                <form action="/datakaryawan/edit" method="get" class="d-inline">
                                    <input type="hidden" name="idKaryawan" id="idKaryawan" value="{{ $karyawan->id }}">
                                    <button class="btn btn-warning border-0"><i class="bi bi-pencil-fill"
                                            style="color: white;"></i></button>
                                </form>
                                <form action="/datakaryawan/hapus" method="post" class="d-inline">
                                    @csrf
                                    <input type="hidden" name="idKaryawan" id="idKaryawan" value="{{ $karyawan->id }}">
                                    <button class="btn btn-danger border-0"
                                        onclick="return confirm('Apakah kamu yakin ?')"><i
                                            class="bi bi-trash3-fill"></i></button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endsection
