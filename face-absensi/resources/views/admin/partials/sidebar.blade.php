<div>
    <div class="sidebar p-4" id="sidebar">
        <img class="mb-4" src="{{ asset('storage/logo/logo.png') }}" alt="logo" width="150px">
        <li>
            <a class="{{ Request::is('dashboard') ? 'active' : '' }}" href="/dashboard">
                <i class="bi bi-house-fill mr-2"></i>
                Dashboard
            </a>
        </li>
        <li>
            <a class="{{ Request::is('datakaryawan') ? 'active' : '' }}" href="/datakaryawan">
                <i class="bi bi-people-fill mr-2"></i>
                Data Karyawan
            </a>
        </li>
        <li>
            <a class="{{ Request::is('datadivisi') ? 'active' : '' }}" href="/datadivisi">
                <i class="bi bi-building-fill mr-2"></i>
                Data Divisi
            </a>
        </li>
        <li>
            <a class="{{ Request::is('monitoringabsensi') ? 'active' : '' }}" href="/monitoringabsensi">
                <i class="bi bi-person-bounding-box mr-2"></i>
                Monitoring Absensi
            </a>
        </li>
        <li>
            <a class="{{ Request::is('pengajuanizin') ? 'active' : '' }}" href="/pengajuanizin">
                <i class="bi bi-person-exclamation mr-2"></i>
                Pengajuan Izin
            </a>
        </li>
        <li>
            <a class="{{ Request::is('rekapabsensi') ? 'active' : '' }}" href="/rekapabsensi">
                <i class="bi bi-file-earmark-text-fill mr-2"></i>
                Rekapitulasi Absensi
            </a>
        </li>
        <li>
            @auth
                <a href="">
                    <form action="/logout" method="POST">
                        @csrf
                        <button type="submit" class="btn"><i class="bi bi-door-closed-fill mr-2"></i>
                            Logout</button>
                    </form>
                </a>
            @endauth
        </li>
    </div>
</div>
