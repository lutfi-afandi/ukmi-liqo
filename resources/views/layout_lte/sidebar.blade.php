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
        <li class="nav-item ">
            <a href="{{ route('admin.user.index') }}" class="nav-link {{ request()->is('admin/user') ? 'active' : '' }}">
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
