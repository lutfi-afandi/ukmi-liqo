<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

    <li class="nav-item">
        <a href="/dashboard" class="nav-link {{ request()->is('dashboard') ? 'active' : '' }}">
            <i class="nav-icon fas fa-th-large"></i>
            <p>
                Dashboard
            </p>
        </a>
    </li>
    @if (auth()->user()->level == 'lpm')
        <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-file-medical-alt"></i>
                <p>
                    Laporan
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview" style="display: block;">
                <li class="nav-item">
                    <a href="{{ route('admin.penetapan.index') }}"
                        class="nav-link {{ request()->is('penetapan/*') ? 'active' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Penetapan</p>
                    </a>
                </li>

            </ul>
        </li>
        <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-recycle"></i>
                <p>
                    Siklus SPMI
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview" style="display: block;">
                <li class="nav-item">
                    <a href="{{ route('admin.penetapan.index') }}"
                        class="nav-link {{ request()->is('penetapan/*') ? 'active' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Penetapan</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="../../index2.html" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Pelaksanaan</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="../../index3.html" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Evaluasi</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="../../index3.html" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Pengendalian</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="../../index3.html" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Pengendalian</p>
                    </a>
                </li>
            </ul>
        </li>

        <li class="nav-header">SETTING</li>
        <li class="nav-item">
            <a href="{{ route('admin.periode.index') }}" class="nav-link">
                <i class="nav-icon fas fa-business-time"></i>
                <p>Periode</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('admin.kategori.index') }}"
                class="nav-link {{ request()->is('kategori') ? 'active' : '' }}">
                <i class="nav-icon fas fa-filter"></i>
                <p>
                    Kategori
                </p>
            </a>
        </li>
    @endif
    @if (auth()->user()->level == 'divisi')
        <li class="nav-item menu-is-opening menu-opens">
            <a href="#" class="nav-link">
                <i class="nav-icon far fa-folder "></i>
                <p>
                    SPMI
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview" style="display: block;">
                <li class="nav-item">
                    <a href="{{ route('divisi.penetapan.index') }}"
                        class="nav-link {{ request()->is('penetapan/*') ? 'active' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Penetapan</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="../../index2.html" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Pelaksanaan</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="../../index3.html" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Evaluasi</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="../../index3.html" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Pengendalian</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="../../index3.html" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Pengendalian</p>
                    </a>
                </li>
            </ul>
        </li>
    @endif

    @if (auth()->user()->level == 'admin')
        <li class="nav-item">
            <a href="{{ route('admin.kategori.index') }}"
                class="nav-link {{ request()->is('kategori') ? 'active' : '' }}">
                <i class="nav-icon fas fa-filter"></i>
                <p>
                    Kategori
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
    @endif


    <li class="nav-item">
        <a href="#" class="nav-link">
            <i class="nav-icon fas fa-users-cog"></i>
            <p>
                Profile
            </p>
        </a>
    </li>
</ul>
