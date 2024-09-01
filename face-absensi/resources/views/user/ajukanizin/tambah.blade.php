@extends('user.partials.main')

@section('container')
    <h3 class="h3 mb-5">Ajukan Izin</h3>
    <form action="/pengajuanizin/ajukan" method="POST">
        @csrf
        <input type="hidden" name="nama_lengkap" id="nama_lengkap" value="{{ auth()->user()->nama_lengkap }}">
        <input type="hidden" name="nama_divisi" id="nama_divisi" value="{{ auth()->user()->divisi }}">
        <div class="form-floating mb-3">
            <select class="form-select" name="jenis_izin" id="jenis_izin" aria-label="Floating label select example" required>
                <option selected>Pilih jenis izin</option>
                <option value="1">Izin</option>
                <option value="2">Sakit</option>
            </select>
            <label for="jenis_izin">Jenis izin</label>
        </div>
        <div class="form-floating mb-3">
            <input type="date" class="form-control" name="tanggal_izin" id="tanggal_izin" required>
            <label for="tanggal_izin">Tanggal izin</label>
        </div>
        <div class="form-floating mb-4">
            <textarea class="form-control" placeholder="Leave a comment here" name="keterangan_izin" id="keterangan_izin" required></textarea>
            <label for="keterangan_izin">Keterangan</label>
        </div>
        <button class="btn btn-outline-primary" type="submit">Ajukan Izin</button>
    </form>
@endsection
