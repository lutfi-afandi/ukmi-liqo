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
        {{-- SPMI --}}

        <li class="nav-header">BERKAS</li>
        <li class="nav-item">
            <a href="/berkas" class="nav-link">
                <i class="nav-icon fas fa-folder-open"></i>
                <p>Berkas LPM</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="/upload" class="nav-link">
                <i class="nav-icon fas fa-cloud-upload-alt"></i>
                <p>Unggah Laporan</p>
            </a>
        </li>

        <li class="nav-header">DOKUMEN</li>
        <li class="nav-item">
            <a href="/dokumen" class="nav-link">
                <i class="nav-icon fas fa-folder-plus "></i>
                <p>Dokumen</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('admin.sop.index') }}" class="nav-link">
                <i class="nav-icon fas fa-file-signature "></i>
                <p>SOP</p>
            </a>
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
        @php
            $helper = new \App\Helpers\Helper();
            $menu = $helper->menu();
        @endphp
        <li class="nav-header">BARKAS</li>
        <li class="nav-item">
            <a href="{{ route('divisi.berkas.index') }}" class="nav-link">
                <i class="nav-icon fas fa-folder-open"></i>
                <p>Berkas LPM</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-folder-plus"></i>
                <p>
                    Dokumen
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            @if ($menu['dokumens']->count() == 0)
            @else
                @foreach ($menu['dokumens'] as $dokumen)
                    <ul class="nav nav-treeview">
                        {{-- menu --}}
                        <li class="nav-item">
                            <a href="#" class="nav-link text-success">
                                <i class="far fa-folder-open nav-icon"></i>
                                <p>
                                    {{ $dokumen->nama_dokumen }}
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            {{-- Sub menu --}}
                            @foreach ($dokumen->sub_dokumen as $subdok)
                                <ul class="nav nav-treeview" style="display: none;">
                                    <li class="nav-item">
                                        <a href="#" class="nav-link text-warning">
                                            <i class="far nav-icon"></i>
                                            <p>{{ $subdok->nama_subdok }}</p>
                                        </a>
                                    </li>
                                </ul>
                            @endforeach

                        </li>

                    </ul>
                @endforeach

            @endif

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
