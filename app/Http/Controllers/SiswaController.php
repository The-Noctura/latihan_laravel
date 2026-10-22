<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Exports\SiswaExport;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;

class SiswaController extends Controller
{
  public function index(Request $request)
  {
    // tangkap kata kunci dari input bernama 'keyword'
    $keyword = $request->input('keyword');

    // buat instansiasi awal query builder tanpa mengeksekusinya dahulu
    $query = Siswa::query();

    // Jika pengguna memasukan kata kunci pencarian
    if (!empty($keyword)) {
      $query->where(function ($q) use ($keyword) {
        $q->where('nama', 'LIKE', '%' . $keyword . '%')
          ->orWhere('nisn', 'LIKE', '%' . $keyword . '%')
          ->orWhere('alamat', 'LIKE', '%' . $keyword . '%');
      });
    }

    // eksekusi query
    $daftarSiswa = $query->orderBy('nama', 'asc')->latest()->paginate(10);

    // mengirim data ke view 'siswa.index' dengan varibel bernama daftarSiswa
    return view('siswa.index', compact('daftarSiswa', 'keyword'));
  }

  // fungsi menampilkan halaman form tambah siswa
  public function create()
  {
    return view('siswa.create');
  }

  // fungsi memproses validasi dan penyimpanan data
  public function store(Request $request)
  {
    // validasi input data dari form
    $validatedData = $request->validate([
      'nisn' => 'required|numeric|digits:10|unique:siswas,nisn',
      'nama' => 'required|string|max:100',
      'jenis_kelamin' => 'required|in:L,P',
      'alamat' => 'required|string',
      'nomor_telepon' => 'required|string|max:14',
      'tempat_lahir' => 'required|string',
      'tanggal_lahir' => 'required|date',
      'foto' => 'nullable|image|mimes:jpeg,jpg,png|max:2048'
    ], [
      // Kustomisasi pesan error bahasa Indonesia
      'required' => ':attribute wajib diisi.',
      'unique' => ':attribute sudah terdaftar di sistem.',
      'numeric' => ':attribute harus berupa angka.',
      'digits' => ':attribute harus berukuran :digits digit.',
      'foto.image' => 'Berkas yang diunggah harus berupa gambar.',
      'foto.mimes' => 'Format gambar yang diperbolehkan hanya JPEG, JPG, PNG.',
      'foto.max' => 'Ukuran file gambar tidak boleh melebihi 2 Megabytes (2048 KB).'
    ]);

    // mengumpulkan seluruh array request input teks
    $data = $validatedData;

    // logika jika pengguna mengunggah file foto
    if ($request->hasFile('foto')) {
      $file = $request->file('foto');

      //Membuat nama berkas unik menggunakan kombinasi NISN dan waktu timestamp
      $namaFoto = $request->nisn . '_' . time() . '.' . $file->getClientOriginalExtension();

      // menyimpan file fisik ke direktori storage/app/public/foto_siswa
      $file->storeAs('public/foto_siswa', $namaFoto);

      // mengisi nama file ke dalam field data array yang akan masuk DB
      $data['foto'] = $namaFoto;
    }

    Siswa::create($data);

    return redirect()->route('siswa.index')->with('success', 'Data siswa dan foto profile berhasil ditambahkan!');
  }

  // fungsi untuk menampilkan halaman formulir edit
  public function edit($id)
  {
    $siswa = Siswa::findOrFail($id);
    return view('siswa.edit', compact('siswa'));
  }

  // fungsi untuk memproses pembaruan data ke database
  public function update(Request $request, $id)
  {
    // cari data yang akan di update
    $siswa = Siswa::findOrFail($id);

    // validasi inputan
    $request->validate([
      'nisn' => ['required', 'string', 'size:10', 'unique:siswas,nisn,' . $id],
      'nama' => ['required', 'string', 'max:100'],
      'jenis_kelamin' => ['required', 'in:L,P'],
      'jurusan' => ['nullable', 'string'],
      'alamat' => ['nullable', 'string'],
      'email' => ['nullable', 'email', 'unique:siswas,email' . $id],
      'nomor_telepon' => ['required', 'string', 'max:12'],
      'tempat_lahir' => ['required', 'string'],
      'tanggal_lahir' => ['required', 'date'],
      'foto' => 'nullable|image|mimes:jpeg,jpg,png|max:2048'
    ], [
      'nisn.required' => 'NISN wajib diisi.',
      'nisn.unique' => 'NISN sudah terdaftar oleh siswa lain.',
      'nama.required' => 'Nama lengkap wajib diisi.',
      'jenis_kelamin.required' => 'Silahkan pilih jenis kelamin.'
    ]);


    $data = $request->all();

    if ($request->hasFile('foto')) {
      $file = $request->file('foto');
      $namaFoto = $request->nisn . '_' . time() . '.' . $file->getClientOriginalExtension();
      $file->storeAs('public/foto_siswa', $namaFoto);

      // Hapus foto lama dari storage jika sebelumnya sudah ada foto
      if ($siswa->foto && Storage::exists('public/foto_siswa/' . $siswa->foto)) {
        Storage::delete('public/foto_siswa/' . $siswa->foto);
      }

      $data['foto'] = $namaFoto;
    }

    // eksekusi perubahan data menggunakan mass assignment
    $siswa->update($data);

    // alihkan halaman ke indeks dengan membawa flash message sukses
    return redirect()->route('siswa.index')->with('success', 'Data siswa dan foto profil berhasil diperbarui!');
  }

  public function destroy($id)
  {
    $siswa = Siswa::findOrFail($id);

    if ($siswa->foto && Storage::exists('public/foto_siswa/' . $siswa->foto)) {
      Storage::delete('public/foto_siswa/' . $siswa->foto);
    }

    $siswa->delete();

    return redirect()->route('siswa.index')->with('succes', 'Data siswa beserta berkas foto profil berhasil dihapus secara permanen!');
  }

  // Menghasilkan file unduhan Excel instan
  public function exportExcel()
  {
    $namaBerkas = 'Laporan_Data_Siswa' . date('Ymd_His') . '.xlsx';
    return Excel::download(new SiswaExport, $namaBerkas);
  }

  // Merender layout HTMl menjadi file stream dokumen PDF.
  public function exportPdf()
  {
    $daftarSiswa = Siswa::latest()->get();

    // Memuat view khusus cetak dan mempassing data koleksi siswa
    $pdf = Pdf::loadView('siswa.pdf', compact('daftarSiswa'));

    $namaBerkas = 'Laporan_Data_Siswa' . date('Ymd_His') . '.xlsx';

    // Fungsi stream membuat PDF terbuka langsung di tab baru browser
    return $pdf->stream($namaBerkas);
  }
}
