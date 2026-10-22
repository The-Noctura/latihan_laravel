<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Daftar Data Siswa - Modul 9</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>

<body class="bg-light">
    <div class="container mt-5">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-primary text-white py-3">
                <h4 class="card-title mb-0 fw-bold">DATA INDUK SISWA</h4>
                <p class="mb-0 text-white-50">Menampilkan data langsung dari database menggunakan Eloquent ORM</p>

            </div>
            <div class="card-body p-4">
                <div class="d-flex justify-content-between aling-items-center mb-3">
                    <h4 class="my-0">Daftar Data Siswa</h4>
                    {{-- <a href="{{ route('siswa.create') }}" class="btn btn-success btn-sm">Tambah Siswa Baru</a> --}}
                    <div class="mb-3">
                        <a href="{{ route('siswa.create') }}" class="btn btn-primary btn-sm">Tambah
                            Siswa</a>
                        <a href="{{ route('siswa.export.excel') }}" class="btn btn-success btn-sm">Export
                            Excel</a> <a href="{{ route('siswa.export.pdf') }}" class="btn btn-danger btn-sm"
                            target="_blank">Export PDF</a>
                    </div>
                </div>

                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                    </div>
                @endif

                @if ($daftarSiswa->isEmpty())
                    <div class="alert alert-warning text-center" role="alert">
                        Belum ada data siswa di dalam database,
                        Silakan jalankan Seeder terlebih dahulu!
                    </div>
                @else
                    <div class="table-responsive">
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <form action="{{ route('siswa.index') }}" method="GET">
                                    <div class="input-group">
                                        <input type="text" name="keyword"
                                            placeholder="Cari berdasarkan nama, nisn, atau alamat..."
                                            class="form-control" value="{{ $keyword ?? '' }}">
                                        <button class="btn btn-primary" type="submit">
                                            <i class="bi bi-search"></i> Cari
                                        </button>
                                        @if (!empty($keyword))
                                            <a href="{{ route('siswa.index') }}" class="btn btn-secondary">Reset</a>
                                        @endif
                                    </div>
                                </form>
                            </div>
                        </div>
                        <table class="table table-striped table-hover align-middle">
                            <thead class="table-dark">
                                <tr>
                                    <th width="5%" class="text-center">No</th>
                                    <th width="10%">Foto</th>
                                    <th width="10%">NISN</th>
                                    <th width="18%">Nama Lengkap</th>
                                    <th width="18%">Tempat, Tgl Lahir</th>
                                    <th width="10%">L/P</th>
                                    <th width="12%">Nomor Hp</th>
                                    <th width="17%">Alamat</th>
                                    <th width="10%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($daftarSiswa as $siswa)
                                    <tr>
                                        <td>{{ ($daftarSiswa->currentPage() - 1) * $daftarSiswa->perPage() + $loop->iteration }}
                                        </td>
                                        <td class="text-center">
                                            @if ($siswa->foto)
                                                <img src="{{ asset('storage/foto_siswa/' . $siswa->foto) }}"
                                                    alt="Foto Siswa" class="rounded-circle"
                                                    style="width: 50px; height: 50px; object-fit: cover;">
                                            @else
                                                {{-- Tampilan avatar default, jika foto kosong --}}
                                                <div class="bg-secondary text-white rounded-circle d-inline-flex align-items-center justify-content-center fw-semibold"
                                                    style="width: 50px; height: 50px; font-size: 12px; letter-spacing: 0.5px;">
                                                    No Image
                                                </div>
                                            @endif
                                        </td>
                                        <td><span class="badge bg-secondary">{{ $siswa->nisn }}</span></td>
                                        <td class="fw-semibold text-dark">{{ $siswa->nama }}</td>
                                        <td>{{ $siswa->tempat_lahir }},
                                            {{ \Carbon\Carbon::parse($siswa->tanggal_lahir)->translatedFormat('d F Y') }}
                                        </td>
                                        <td>
                                            @if ($siswa->jenis_kelamin == 'L')
                                                <span class="badge bg-info text-dark">Laki-laki</span>
                                            @else
                                                <span class="badge bg-danger text-white">Perempuan</span>
                                            @endif
                                        </td>
                                        <td>{{ $siswa->nomor_telepon }}</td>
                                        <td>{{ $siswa->alamat }}</td>
                                        <td class="text-center">
                                            <div class="d-flex justify-content-center gap-1">
                                                <a href="{{ route('siswa.edit', $siswa->id) }}"
                                                    class="btn btn-sm btn-warning">Edit</a>
                                                <form action="{{ route('siswa.destroy', $siswa->id) }}" method="POST"
                                                    onsubmit="return confirm('Apakah Anda yakin ingin menghapus data siswa ini?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center text-danger fw-bold py-4">
                                            Data siswa dengan kata kunci "{{ $keyword }}" tidak ditemukan
                                        </td>
                                    </tr>
                                @endforelse

                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex justify-content-end mt-3">{!! $daftarSiswa->appends(['keyword' => $keyword])->links() !!}</div>
                    <div class="mt-3 text-muted small">
                        Total Data Terhitung: <strong>{{ $daftarSiswa->count() }}</strong> siswa
                    </div>
                @endif
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous">
    </script>
</body>

</html>
