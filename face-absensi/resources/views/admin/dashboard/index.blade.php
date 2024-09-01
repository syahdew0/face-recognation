@extends('admin.partials.main')

@section('container')
    <div class="row mb-3">
        <h4>Dashboard</h4>
    </div>
    <div class="row mb-3">
        <hr>
    </div>
    <div class="row mb-2">
        <div class="col"><p class="lead" style="color: #1c5084;">{{ $today }}</p></div>        
    </div>
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">                    
                    <div class="row ps-2"><h5>Absensi</h5></div>
                    <div class="row ps-2 d-inline"><strong class="display-6" style="color: #1c5084;">{{ $absensi }} <i class="bi bi-person-bounding-box h5"></i></div></strong>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card">
                <div class="card-body">                    
                    <div class="row ps-2"><h5>Divisi</h5></div>
                    <div class="row ps-2 d-inline"><strong class="display-6" style="color: #1c5084;">{{ $divisi }} <i class="bi bi-building h5"></i></div></strong>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card">
                <div class="card-body">                    
                    <div class="row ps-2"><h5>Karyawan</h5></div>
                    <div class="row ps-2 d-inline"><strong class="display-6" style="color: #1c5084;">{{ $karyawan }} <i class="bi bi-people-fill h5"></i></div></strong>
                </div>
            </div>
        </div>             
    </div>
@endsection
