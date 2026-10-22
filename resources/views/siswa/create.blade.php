<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tambah Data Siswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>

<body class="bg-light">

    <div class="container mt-5 mb-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card border-0 shadows-sm rounded">
                    <div class="card-header bg-dark text-white">
                        <h5 class="card-title my-1">Tambah Siswa Baru</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('siswa.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="mb-3">
                                <label for="nisn" class="form-label fw-bold">
                                    NISN (10 Digit)
                                </label>
                                <input type="text" name="nisn" id="nisn"
                                    class="form-control @error('nisn') is-invalid @enderror" value="{{ old('nisn') }}"
                                    placeholder="Masukkan NISN">
                                @error('nisn')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="nama" class="form-label fw-bold">Nama Lengkap</label>
                                <input type="text" class="form-control @error('nama') is-invalid @enderror"
                                    name="nama" value="{{ old('nama') }}" placeholder="Masukan Nama Lengkap">
                                @error('nama')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="tempat_lahir" class="form-label fw-bold">Tempat Lahir</label>
                                    <input type="text"
                                        class="form-control @error('tempat_lahir') is-invalid @enderror"
                                        name="tempat_lahir" value="{{ old('tempat_lahir') }}"
                                        placeholder="Masukan Tempat Lahir">
                                    @error('tempat_lahir')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="tanggal_lahir" class="form-label fw-bold">Tanggal Lahir</label>
                                    <input type="date"
                                        class="form-control @error('tanggal_lahir') is-invalid @enderror"
                                        name="tanggal_lahir" value="{{ old('tanggal_lahir') }}"
                                        placeholder="Masukan Nama Lengkap">
                                    @error('tanggal_lahir')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="jenis_kelamin" class="form-label fw-bold">Jenis Kelamin</label>
                                <select class="form-select @error('jenis_kelamin') is-invalid @enderror"
                                    name="jenis_kelamin" id="jenis_kelamin">
                                    <option value="">-- Pilih Jenis Kelamin -- </option>
                                    <option value="L" {{ old('jenis_kelamin') == 'L' ? 'selected' : '' }}>Laki-laki
                                    </option>
                                    <option value="P" {{ old('jenis_kelamin') == 'P' ? 'selected' : '' }}>
                                        Perempuan </option>
                                </select>
                                @error('jenis_kelamin')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="alamat" class="form-label fw-bold">Alamat Rumah</label>
                                <textarea class="form-control @error('alamat') is-invalid @enderror" name="alamat" placeholder="Alamat lengkap rumah.."
                                    rows="3"> {{ old('alamat') }} </textarea>
                                @error('alamat')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="nomor_telepon" class="form-label fw-bold">Nomor Handphone</label>
                                <input type="text" class="form-control @error('nomor_telepon') is-invalid @enderror"
                                    name="nomor_telepon" value="{{ old('nomor_telepon') }}"
                                    placeholder="Contoh : 081234567890">
                                @error('nomor_telepon')
                                    <div class="invalid-feedback">{{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="foto" class="form-label">Foto Profil</label>
                                <input class="form-control @error('foto') is-invalid @enderror" type="file"
                                    id="foto" name="foto" accept=".jpg,.jpeg,.png">
                                <div class="form-text">Format JPG, JPEG, PNG. Maksimal ukuran 2MB</div>
                                @error('foto')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary">Simpan Data</button>
                            <a href="{{ route('siswa.index') }}" class="btn btn-secondary">Kembali</a>

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
