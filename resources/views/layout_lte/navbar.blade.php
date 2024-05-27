@php
    $helper = new \App\Helpers\Helper();
@endphp
<ul class="navbar-nav ml-auto">
    <div class="btn-group btn-sm btn-group-toggle mb-2" data-toggle="buttons">
        <label class="btn bg-maroon active">
            <input type="radio" name="options" id="option_b1"><i class="far fa-calendar-alt"></i> Periode Sekarang
            :
        </label>
        <label class="btn bg-maroon">
            <input type="radio" name="options" id="option_b2"checked=""> {{ $helper->periode_aktif() }}
        </label>
    </div>
    <li class="nav-item">
        <a href="#" class="nav-link">Hai, {{ auth()->user()->name }}</a>
    </li>
    <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
            <i class="fa fa-id-card"></i>
            {{-- <span class="badge badge-success navbar-badge">...</span> --}}
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <span class="dropdown-item dropdown-header">Hai, {{ auth()->user()->name }}</span>
            <div class="dropdown-divider"></div>
            <a href="{{ route('perbarui_password') }}" class="dropdown-item "><i
                    class="dropdown-icon fa fa-key"></i>&nbsp;&nbsp;Change
                Password</a>
            <div class="dropdown-divider"></div>
            <a href="{{ route('logout') }}" class="dropdown-item dropdown-footer bg-danger"
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i
                    class="fa fa-power-off"></i>&nbsp;&nbsp;Log
                Out</a>
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">@csrf</form>

        </div>
    </li>

</ul>
