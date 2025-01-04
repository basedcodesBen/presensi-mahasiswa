<aside class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start" id="sidenav-main">
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none" id="iconSidenav"></i>
        @if(Auth::user()->isAdmin())
        <a class="navbar-brand m-0" href="{{ route('admin.index') }}">
        @elseif(Auth::user()->isDosen())
        <a class="navbar-brand m-0" href="{{ route('dosen.index') }}">
        @endif
            <img src="{{ asset('assets/img/logo-ct-dark.png') }}" class="navbar-brand-img h-100" alt="logo">
            <span class="ms-1 font-weight-bold">
                {{ Auth::user()->role->nama_role ?? 'Dashboard' }} Dashboard
            </span>
        </a>
    </div>
    <hr class="horizontal dark mt-0">
    <div class="collapse navbar-collapse w-auto" id="sidenav-collapse-main">
        <ul class="navbar-nav">
            @if(Auth::user()->isAdmin())
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('admin') ? 'active' : '' }}" href="{{ route('admin.index') }}">
                        <div class="icon icon-shape icon-sm text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="ni ni-tv-2 text-primary text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Admin Dashboard</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('admin/fakultas*') ? 'active' : '' }}" href="{{ route('admin.fakultas.index') }}">
                        <div class="icon icon-shape icon-sm text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="ni ni-building text-warning text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Data Fakultas</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('admin/programstudi*') ? 'active' : '' }}" href="{{ route('admin.programstudi.index') }}">
                        <div class="icon icon-shape icon-sm text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="ni ni-briefcase-24 text-warning text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Data Program Studi</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('admin/mahasiswa*') ? 'active' : '' }}" href="{{ route('admin.mahasiswa.index') }}">
                        <div class="icon icon-shape icon-sm text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="ni ni-ungroup text-warning text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Data Mahasiswa</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('admin/dosen*') ? 'active' : '' }}" href="{{ route('admin.dosen.index') }}">
                        <div class="icon icon-shape icon-sm text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="ni ni-ungroup text-warning text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Data Dosen</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('admin/matakuliah*') ? 'active' : '' }}" href="{{ route('admin.matakuliah.index') }}">
                        <div class="icon icon-shape icon-sm text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="ni ni-ungroup text-warning text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Data Mata Kuliah</span>
                    </a>
                </li>
            @elseif(Auth::user()->isDosen())
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('dosen') ? 'active' : '' }}" href="{{ route('dosen.index') }}">
                        <div class="icon icon-shape icon-sm text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="ni ni-tv-2 text-primary text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Dashboard</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('dosen/Matakuliah*') ? 'active' : '' }}" href="{{route('dosen.matakuliah')}}">
                        <div class="icon icon-shape icon-sm text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="ni ni-calendar-grid-58 text-warning text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Matakuliah</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('dosen/kehadiran*') ? 'active' : '' }}" href="{{route('kehadiran.mahasiswa.create')}}">
                        <div class="icon icon-shape icon-sm text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="ni ni-calendar-grid-58 text-warning text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Kehadiran Mahasiswa</span>
                    </a>
                </li>
            @else
                <li class="nav-item">
                    <a class="nav-link active" href="#">
                        <div class="icon icon-shape icon-sm text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="ni ni-tv-2 text-primary text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">User Dashboard</span>
                    </a>
                </li>
            @endif
        </ul>
    </div>
</aside>
