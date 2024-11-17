<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UnitSekolah;

class UnitSekolahController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $unitSekolah = UnitSekolah::all();
        return response()->json($unitSekolah);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'jenjang' => 'required|in:TK,KB,SD,SMP',
            'alamat' => 'required|string',
            'telepon' => 'required|string',
            'email' => 'nullable|email',
            'kode_pos' => 'nullable|string',
            'status' => 'required|in:aktif,non-aktif',
            'tanggal_dibentuk' => 'nullable|date',
            'kepala_sekolah' => 'nullable|string',
            'jumlah_siswa' => 'nullable|integer',
        ]);

        $unitSekolah = UnitSekolah::create([
            'id' => \Illuminate\Support\Str::ulid(), // Menggunakan ULID
            'nama' => $request->nama,
            'jenjang' => $request->jenjang,
            'alamat' => $request->alamat,
            'telepon' => $request->telepon,
            'email' => $request->email,
            'kode_pos' => $request->kode_pos,
            'status' => $request->status,
            'tanggal_dibentuk' => $request->tanggal_dibentuk,
            'kepala_sekolah' => $request->kepala_sekolah,
            'jumlah_siswa' => $request->jumlah_siswa,
        ]);

        return response()->json($unitSekolah, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $unitSekolah = UnitSekolah::find($id);

        if (!$unitSekolah) {
            return response()->json(['message' => 'Unit sekolah tidak ditemukan'], 404);
        }

        return response()->json($unitSekolah);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama' => 'nullable|string|max:255',
            'jenjang' => 'nullable|in:TK,KB,SD,SMP',
            'alamat' => 'nullable|string',
            'telepon' => 'nullable|string',
            'email' => 'nullable|email',
            'kode_pos' => 'nullable|string',
            'status' => 'nullable|in:aktif,non-aktif',
            'tanggal_dibentuk' => 'nullable|date',
            'kepala_sekolah' => 'nullable|string',
            'jumlah_siswa' => 'nullable|integer',
        ]);

        $unitSekolah = UnitSekolah::find($id);

        if (!$unitSekolah) {
            return response()->json(['message' => 'Unit sekolah tidak ditemukan'], 404);
        }

        $unitSekolah->update($request->only([
            'nama',
            'jenjang',
            'alamat',
            'telepon',
            'email',
            'kode_pos',
            'status',
            'tanggal_dibentuk',
            'kepala_sekolah',
            'jumlah_siswa'
        ]));

        return response()->json($unitSekolah);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $unitSekolah = UnitSekolah::find($id);

        if (!$unitSekolah) {
            return response()->json(['message' => 'Unit sekolah tidak ditemukan'], 404);
        }

        $unitSekolah->delete();
        return response()->json(['message' => 'Unit sekolah berhasil dihapus']);
    }
}
