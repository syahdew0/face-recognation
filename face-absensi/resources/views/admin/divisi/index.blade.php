@extends('admin.partials.main')

@section('container')
    <div class="row mb-4">
        <h4>Data Divisi</h4>
    </div>
    <div class="row mb-3">
        <div class="col text-end">
            <a href="/datadivisi/tambah"><button type="button" class="btn btn-primary"><i class="bi bi-plus me-2"></i>Tambah
                    Divisi</button></a>
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
    </div>
    <div class="row">
        <div class="col">
            <table class="table table-responsive table-hover">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Kode Divisi</th>
                        <th scope="col">Nama Divisi</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($divisions as $divisi)
                        <tr>
                            <th scope="row">{{ $nomor++ }}</th>
                            <td>{{ $divisi->kode_divisi }}</td>
                            <td>{{ $divisi->nama_divisi }}</td>
                            <td>
                                <form action="/datadivisi/hapus" method="post" class="d-inline">
                                    @csrf
                                    <input type="hidden" name="idDivisi" id="idDivisi" value="{{ $divisi->id }}">
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
    </div>
@endsection
