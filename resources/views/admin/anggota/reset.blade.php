<div class="modal fade modal-alert modal-warning in" id="modal_show" role="dialog" style="padding:0;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                Reset Password User
            </div>
            <form action="{{ route('admin.anggota.reset_password', $user->id) }}" id="form-edit" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="callout callout-info">
                        <h5>Yakin reset Password akun <br>
                            <b>{{ $user->name }}?</b>
                        </h5>
                        <p>password baru adalah : <b>yuk_liqo123</b></p>
                    </div>
                    <button type="submit" class="btn btn-block btn-primary"><i class="fas fa-wrench"></i>
                        Reset Password</button>
                </div>
            </form>
        </div>
    </div>
</div>
