@extends('admin.partials.main')

@section('container')
    <div class="row mb-5">
        <div class="col d-flex">
            <a href="/datadivisi"><button type="button" class="btn btn-outline-primary me-2 d-inline"><i
                        class="bi bi-arrow-left h-4"></i></button></a>
            <h5 class="pt-1">Tambah Data Divisi</h5>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <form method="post" action="/datadivisi/tambahdivisi">
                @csrf
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" name="nama_divisi" id="nama_divisi" required>
                    <label for="nama_divisi">Nama Divisi</label>
                </div>
                <button type="submit" class="btn btn-primary d-block"><i class="bi bi-plus me-2"></i>Tambah Divisi</button>
            </form>
        </div>
    </div>
@endsection
