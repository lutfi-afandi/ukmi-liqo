<div class="modal fade modal-alert modal-warning in" id="modal_show" role="dialog" style="padding:0;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                Edit Data User
            </div>
            <form action="{{ route('admin.tutor.update', $tutor->id) }}" id="form-edit" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nama">Nama Lengkap</label>
                        <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror"
                            id="nama" placeholder="Masukan nama" autofocus autocomplete="false"
                            value="{{ old('nama', $tutor->nama) }}">
                        @error('nama')
                            <span class="error invalid-feedback"> {{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="jenis_kelamin">Jenis Kelamin</label>
                        <select type="text" name="jenis_kelamin"
                            class="form-control @error('jenis_kelamin') is-invalid @enderror" id="jenis_kelamin"
                            placeholder="Masukan jenis_kelamin" value="{{ old('jenis_kelamin') }}">
                            <option value="" hidden>-Pilih Jenis Kelamin</option>
                            <option value="Laki-Laki"
                                {{ old('jenis_kelamin', $tutor->jenis_kelamin) == 'Laki-Laki' ? 'selected' : '' }}>
                                Laki-Laki
                            </option>
                            <option value="Perempuan"
                                {{ old('jenis_kelamin', $tutor->jenis_kelamin) == 'Perempuan' ? 'selected' : '' }}>
                                Perempuan</option>
                        </select>
                        @error('jenis_kelamin')
                            <span class="error invalid-feedback"> {{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="no_telepon">Nomor Telepon</label>
                        <input type="text" name="no_telepon"
                            class="form-control @error('no_telepon') is-invalid @enderror" id="no_telepon"
                            placeholder="Masukan no_telepon" value="{{ old('no_telepon', $tutor->no_telepon) }}">
                        @error('no_telepon')
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
