@extends('user.partials.main')

@section('container')
    <h3 class="h3 mb-5">{{ auth()->user()->nama_lengkap }}</h3>
    <div class="row mt-5">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <div class="row ps-2">
                        <h5>Absen Masuk</h5>
                    </div>
                    <div class="row ps-2 d-inline"><strong class="display-6"
                            style="color: #1c5084;">{{ $absensiToday != null ? $absensiToday->jam_masuk : '-' }} <i
                                class="bi bi-door-open h5"></i></div></strong>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <div class="row ps-2">
                        <h5>Absen Pulang</h5>
                    </div>
                    <div class="row ps-2 d-inline"><strong class="display-6"
                            style="color: #1c5084;">{{ $absensiToday != null && $absensiToday->jam_pulang != null ? $absensiToday->jam_pulang : '-' }}
                            <i class="bi bi-door-closed h5"></i></div></strong>
                </div>
            </div>
        </div>
    </div>

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
@endsection
