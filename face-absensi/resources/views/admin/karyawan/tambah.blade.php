@extends('admin.partials.main')

@section('container')
    <div class="row mb-5">
        <div class="col d-flex">
            <a href="/datakaryawan"><button type="button" class="btn btn-primary me-2 d-inline"><i
                        class="bi bi-arrow-left h-4"></i></button></a>
            <h5 class="pt-1">Tambah Data Karyawan</h5>
        </div>
    </div>
    <div class="row">
        <form action="/datakaryawan/tambahkaryawan" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-floating mb-3">
                <input type="text" class="form-control" name="nama_lengkap" id="nama_lengkap" required>
                <label for="nama_lengkap">Nama Lengkap</label>
            </div>
            <div class="form-floating mb-3">
                <input type="email" class="form-control" name="email" id="email" required>
                <label for="email">Email</label>
            </div>
            <div class="form-floating mb-3">
                <input type="password" class="form-control" name="password" id="password" required autofocus>
                <label for="password">Password</label>
            </div>            
            <div class="form-floating mb-3">
                <select class="form-select" name="role" id="role" aria-label="Floating label select example" required>
                    <option selected>Pilih role</option>
                    <option value="1">Admin</option>
                    <option value="2">User</option>
                </select>
                <label for="role">Role akun</label>
            </div>
            <div class="form-floating mb-3">
                <select class="form-select" name="divisi" id="divisi" aria-label="Floating label select example" required>
                    <option selected>Pilih divisi</option>
                    @foreach ($divisions as $divisi)
                        <option value="{{ $divisi->kode_divisi }}">{{ $divisi->nama_divisi }}</option>
                    @endforeach                                        
                </select>
                <label for="divisi">Divisi</label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" class="form-control" name="alamat" id="alamat">
                <label for="alamat">Alamat</label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" class="form-control" name="no_hp" id="no_hp">
                <label for="no_hp">Telepon</label>
            </div>
            <div class="mb-3">
                <label for="foto" class="form-label">Foto Diri</label>
                <input class="form-control" type="file" name="foto" id="foto">
            </div>
            <button type="submit" class="btn btn-primary d-block"><i class="bi bi-plus me-2"></i>Tambah Karyawan</button>
        </form>
    </div>
@endsection
