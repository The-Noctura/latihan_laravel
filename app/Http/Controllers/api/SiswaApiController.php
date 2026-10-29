<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\SiswaResource;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SiswaApiController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    $siswas = Siswa::latest()->paginate(5);
    return new SiswaResource(true, 'Daftar Seluruh Data Siswa', $siswas);
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(Request $request)
  {
    $validator = Validator::make($request->all(), [
      'nisn' => 'required|numeric|unique:siswas,nisn',
      'nama_lengkap' => 'required|string|max:100',
      'alamat' => 'required|string',
    ]);
    if ($validator->fails()) return response()->json($validator->errors(), 422);
    $siswa = Siswa::create($request->all());
    return response()->json(['success' => true, 'data' => $siswa], 201);
  }

  /**
   * Display the specified resource.
   */
  public function show(string $id)
  {
    $siswa = Siswa::find($id);
    if ($siswa) return response()->json(['success' => false, 'message' => 'Tidak Ditemukan'], 404);
    return new SiswaResource(true, 'Detail Siswa', $siswa);
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, string $id)
  {
    $siswa = Siswa::find($id);
    if (!$siswa) return response()->json(['succes' => false], 404);
    $siswa->update($request->all());
    return new SiswaResource(true, 'Data Diperbarui', $siswa);
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(string $id)
  {
    $siswa = Siswa::find($id);
    if (!$siswa) return response()->json(['succes' => false], 404);
    $siswa->delete();
    return new SiswaResource(true, 'Data Dihapus', null);
  }
}
