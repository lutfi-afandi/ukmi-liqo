<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

    <li class="nav-item">
        <a href="/dashboard" class="nav-link {{ request()->is('dashboard') ? 'active' : '' }}">
            <i class="nav-icon fas fa-th-large"></i>
            <p>
                Dashboard
            </p>
        </a>
    </li>
    @if (auth()->user()->level == 'tutor')
    @endif
    @if (auth()->user()->level == 'anggota')
    @endif

    @if (auth()->user()->level == 'admin')
        <div class="nav-header">MANAGE</div>
        <li class="nav-item ">
            <a href="{{ route('admin.kelompok.index') }}"
                class="nav-link {{ request()->is('admin/kelompok') ? 'active' : '' }}">
                <i class="nav-icon fas fa-users"></i>
                <p>
                    Kelompok
                </p>
            </a>
        </li>
        <div class="nav-header">MASTER DATA</div>
        <li class="nav-item ">
            <a href="{{ route('admin.anggota.index') }}"
                class="nav-link {{ request()->is('admin/anggota') ? 'active' : '' }}">
                <i class="nav-icon fas fa-users"></i>
                <p>
                    Anggota
                </p>
            </a>
        </li>
        <li class="nav-item ">
            <a href="{{ route('admin.tutor.index') }}"
                class="nav-link {{ request()->is('admin/tutor') ? 'active' : '' }}">
                <i class="nav-icon fas fa-chalkboard-teacher"></i>
                <p>
                    Tutor
                </p>
            </a>
        </li>
        <li class="nav-item ">
            <a href="{{ route('admin.user.index') }}"
                class="nav-link {{ request()->is('admin/user') ? 'active' : '' }}">
                <i class="nav-icon fas fa-users"></i>
                <p>
                    User
                </p>
            </a>
        </li>
        <div class="nav-header">KONFIGURASI</div>
        <li class="nav-item ">
            <a href="{{ route('admin.jurusan.index') }}"
                class="nav-link {{ request()->is('admin/jurusan') ? 'active' : '' }}">
                <i class="nav-icon fas fa-newspaper"></i>
                <p>
                    Jurusan
                </p>
            </a>
        </li>
    @endif


    <li class="nav-header">SETTINGS</li>
    <li class="nav-item">
        <a href="/perbarui-password" class="nav-link">
            <i class="nav-icon fas fa-users-cog"></i>
            <p>
                Profile
            </p>
        </a>
    </li>
</ul>
