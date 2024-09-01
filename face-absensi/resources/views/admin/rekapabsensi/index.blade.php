@extends('admin.partials.main')

@section('container')
    <div class="row mb-5">
        <div class="col">
            <h4>Cetak Rekapitulasi Absensi</h4>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <form action="/rekapabsensi/cetak" target="_blank" method="POST">
                @csrf
                <div class="input-group mb-3">
                    <select name="bulan" id="bulan" class="form-select" required>
                        <option value="">Bulan</option>
                        @for ($i = 1; $i < +12; $i++)
                            <option value="{{ $i }}" {{ date('m') == $i ? 'selected' : '' }}>{{ $bulan[$i] }}
                            </option>
                        @endfor
                    </select>
                </div>
                <div class="input-group mb-3">
                    <select name="tahun" id="tahun" class="form-select" required>
                        <option value="">Tahun</option>
                        @foreach ($years as $tahun)
                            <option value="{{ $tahun }}">{{ $tahun }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="input-group">
                    <button type="submit" name="cetak" id="cetak" class="btn btn-primary"><i
                            class="bi bi-printer me-2"></i>Cetak</button>
                </div>
            </form>
        </div>
    </div>
@endsection
