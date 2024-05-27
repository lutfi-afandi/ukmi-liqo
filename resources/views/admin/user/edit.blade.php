<div class="modal fade modal-alert modal-warning in" id="modal_show" role="dialog" style="padding:0;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                Edit Data User
            </div>
            <form action="{{ route('admin.user.update', $user->id) }}" id="form-edit" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">Nama Lengkap</label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                            id="name" placeholder="Masukan name" autofocus autocomplete="false"
                            value="{{ old('name', $user->name) }}">
                        @error('name')
                            <span class="error invalid-feedback"> {{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" name="username"
                            class="form-control @error('username') is-invalid @enderror" id="username"
                            placeholder="Masukan username" value="{{ old('username', $user->username) }}" readonly>
                        @error('username')
                            <span class="error invalid-feedback"> {{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="level">Level</label>
                        <select name="level" id="level" class="form-control @error('level') is-invalid @enderror">
                            <option value="" hidden>-Pilih Level-</option>
                            <option value="admin" {{ $user->level == 'admin' ? 'selected' : '' }}>admin</option>
                            <option value="lpm" {{ $user->level == 'lpm' ? 'selected' : '' }}>lpm</option>
                            <option value="divisi" {{ $user->level == 'divisi' ? 'selected' : '' }}>divisi</option>
                        </select>
                        @error('level')
                            <span class="error invalid-feedback"> {{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
