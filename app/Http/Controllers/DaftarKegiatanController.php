<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DaftarKegiatan;
use Illuminate\Support\Facades\Validator;

class DaftarKegiatanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pages.daftar_kegiatan.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.daftar_kegiatan.create');
    }

    public function findById($id)
    {
        $data = DaftarKegiatan::find($id);
        return response()->json($data);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_kegiatan' => 'required',
        ], [
            'nama_kegiatan.required' => ':attribute harus diisi',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors(),
            ], 422);
        }

        $kegiatan = DaftarKegiatan::create([
            'nama_kegiatan' => $request->nama_kegiatan,
        ]);

        if ($kegiatan) {
            return response()->json([
                'success' => true,
                'message' => 'Kegiatan baru ditambahkan',
            ], 201);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Kegiatan gagal ditambahkan',
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(DaftarKegiatan $daftarKegiatan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DaftarKegiatan $daftarKegiatan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, DaftarKegiatan $daftarKegiatan)
    {
        $validator = Validator::make($request->all(), [
            'nama_kegiatan' => 'required',
        ], [
            'required' => ':attribute harus diisi',
        ]);
    }

    public function destroy(DaftarKegiatan $daftarKegiatan, $id)
    {
        try {
            $deleted = $daftarKegiatan::findOrFail($id);
            $deleted->delete();

            return response()->json(['status' => true, 'message' => 'Data berhasil dihapus'], 200);
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'message' => 'Gagal menghapus data'], 500);
        }
    }
}
