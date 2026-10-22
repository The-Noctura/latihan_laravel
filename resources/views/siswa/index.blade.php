<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Daftar Data Siswa') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="d-flex justify-content-between align-items-center mb-3">
                <h4 class="my-0">Daftar Data Siswa</h4>
                <div>
                    <a href="{{ route('siswa.create') }}" class="btn btn-primary btn-sm">Tambah Siswa</a>
                    <a href="{{ route('siswa.export.excel') }}" class="btn btn-success btn-sm">Export Excel</a>
                    <a href="{{ route('siswa.export.pdf') }}" class="btn btn-danger btn-sm" target="_blank">Export
                        PDF</a>
                </div>
            </div>

            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                </div>
            @endif

            <div class="row mb-4">
                <div class="col-md-6">
                    <form action="{{ route('siswa.index') }}" method="GET">
                        <div class="input-group">
                            <input type="text" name="keyword"
                                placeholder="Cari berdasarkan nama, nisn, atau alamat..." class="form-control"
                                value="{{ $keyword ?? '' }}">
                            <button class="btn btn-primary" type="submit">Cari</button>
                            @if (!empty($keyword))
                                <a href="{{ route('siswa.index') }}" class="btn btn-secondary">Reset</a>
                            @endif
                        </div>
                    </form>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="table-responsive">
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
                                <th width="10%" class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($daftarSiswa as $siswa)
                                <tr>
                                    <td class="text-center">
                                        {{ ($daftarSiswa->currentPage() - 1) * $daftarSiswa->perPage() + $loop->iteration }}
                                    </td>
                                    <td class="text-center">
                                        @if ($siswa->foto)
                                            <img src="{{ asset('storage/foto_siswa/' . $siswa->foto) }}"
                                                alt="Foto Siswa" class="rounded-circle"
                                                style="width: 50px; height: 50px; object-fit: cover;">
                                        @else
                                            <div class="bg-secondary text-white rounded-circle d-inline-flex align-items-center justify-content-center fw-semibold"
                                                style="width: 50px; height: 50px; font-size: 12px; letter-spacing: 0.5px;">
                                                No Image
                                            </div>
                                        @endif
                                    </td>
                                    <td><span class="badge bg-secondary">{{ $siswa->nisn }}</span></td>
                                    <td class="fw-semibold text-dark">{{ $siswa->nama }}</td>
                                    <td>
                                        {{ $siswa->tempat_lahir }},
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
                                    <td colspan="9" class="text-center text-danger fw-bold py-4">
                                        @if (!empty($keyword))
                                            Data siswa dengan kata kunci "{{ $keyword }}" tidak ditemukan
                                        @else
                                            Belum ada data siswa di dalam database. Silakan jalankan Seeder terlebih
                                            dahulu!
                                        @endif
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="d-flex justify-content-end mt-3">
                    {{ $daftarSiswa->withQueryString()->links() }}
                </div>

                <div class="mt-3 text-muted small">
                    Total Data: <strong>{{ $daftarSiswa->total() }}</strong> siswa
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
