<?php

namespace App\Exports;

use App\Models\Siswa;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class SiswaExport implements FromCollection, WithHeadings, WithMapping
{
  // Mengambil seluruh koleksi data siswa dari databsae
  public function collection(): Collection
  {
    return Siswa::latest()->get();
  }

  // Mendefinisikan baris judul paling atas tablel excel
  public function headings(): array
  {
    return [
      'No',
      'NISN',
      'Nama Lengkap',
      'Tempat Lahir',
      'Tanggal Lahir',
      'Jenis Kelamin',
      'Alamat',
      'Nomor HP'
    ];
  }

  // Memetakan nilai atribut agar rapi pada setiap baris sel excel
  public function map($siswa): array
  {
    static $rowNumber = 0;
    $rowNumber++;

    return [
      $rowNumber,
      "'" . $siswa->nisn, // Menggunakan tanda petik agar NISN tidak dianggap angka nol hilang
      $siswa->nama,
      $siswa->tempat_lahir,
      $siswa->tanggal_lahir,
      $siswa->jenis_kelamin,
      $siswa->alamat,
      $siswa->nomor_telepon
    ];
  }
}
