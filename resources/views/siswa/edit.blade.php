<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Data Siswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>

<body class="bg-light">

    <div class="container mt-5 mb-5">
        <div class="row justify-conter-center">
            <div class="col-md-8">
                <div class="card border-0 shadow-sm rounded">
                    <div class="card-header bg-dark text-white">
                        <h5 class="card-title my-1">Formulir Ubah Data Siswa</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('siswa.update', $siswa->id) }}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label class="form-label fw-bold">NISN</label>
                                <input type="text" name="nisn"
                                    class="form-control  @error('nisn') is-invalid @enderror"
                                    value="{{ old('nisn', $siswa->nisn) }}">
                                @error('nisn')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold">Nama Lengkap</label>
                                <input type="text"
                                    class="form-control @error('nama')
                                  is -invalid
                                @enderror"
                                    name="nama" value="{{ old('nama', $siswa->nama) }}">
                                @error('nama')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold">Tempat Lahir</label>
                                    <input type="text"
                                        class="form-control @error('tempat_lahir')
                                  is -invalid
                                @enderror"
                                        name="tempat_lahir" value="{{ old('tempat_lahir', $siswa->tempat_lahir) }}">
                                    @error('tempat_lahir')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold">Tanggal Lahir</label>
                                    <input type="date"
                                        class="form-control @error('tanggal_lahir')
                                  is -invalid
                                @enderror"
                                        name="tanggal_lahir" value="{{ old('tanggal_lahir', $siswa->tanggal_lahir) }}">
                                    @error('tanggal_lahir')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold">Jenis Kelamin</label>
                                <select name="jenis_kelamin"
                                    class="form-select @error('jenis_kelamin') is-invalid @enderror">
                                    <option value="">-- Pilih --</option>
                                    <option value="L"
                                        {{ old('jenis_kelamin', $siswa->jenis_kelamin) == 'L' ? 'selected' : '' }}>
                                        Laki-laki</option>
                                    <option value="P"
                                        {{ old('jenis_kelamin', $siswa->jenis_kelamin) == 'P' ? 'selected' : '' }}>
                                        Perempuan</option>
                                </select>
                                @error('jenis')
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold">Alamat</label>
                                <textarea name="alamat" rows="3"
                                    class="form-control @error('alamat')
                                is-invalid
                              @enderror">{{ old('alamat', $siswa->alamat) }}</textarea>
                                @error('alamat')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold">Nomor HP</label>
                                <input type="text" class="form-control @error('nomor_telepon') is-invalid @enderror"
                                    name="nomor_telepon" value="{{ old('nomor_telepon', $siswa->nomor_telepon) }}">
                                @error('nomor_telepon')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="text-end">
                                <a href="{{ route('siswa.index') }}" class="btn btn-secondary me-2">Kembali</a>
                                <button type="submit" class="btn brn-primary">Simpan Perubahan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous">
    </script>
</body>

</html>
