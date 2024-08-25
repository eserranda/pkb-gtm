<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KegiatanSinode;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class KegiatanSinodeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $filterData = $request->input('jabatan');

            $query = KegiatanSinode::query();
            if ($filterData) {
                $query->where('jabatan',  $filterData);
            }

            $data = $query->latest('created_at')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('image', function ($row) {
                    return '<img src="' . asset('/storage/images/' . $row->image) . '"   class="avatar-lg rounded" alt="img"> ';
                })
                ->addColumn('action', function ($row) {
                    // $btn = '<a class="btn btn-outline-secondary btn-sm" title="Edit" onclick="edit(' . $row->id . ')"> <i class="fas fa-pencil-alt"></i> </a>';
                    $btn = '<a class="btn btn-outline-secondary btn-sm  text-danger mx-1" title="Hapus" onclick="hapus(' . $row->id . ')"> <i class="fas fa-trash-alt"></i> </a>';
                    return $btn;
                })
                ->rawColumns(['action', 'image'])
                ->make(true);
        }
        return view('pages.kegiatan-sinode.index');
    }


    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_kegiatan' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'tempat' => 'required',
        ], [
            'image.image' => 'File harus berupa gambar',
            'image.mimes' => 'File harus berupa jpeg,png,jpg,gif,svg',
            'image.max' => 'File melebihi batas ukuran 2 MB',
            'nama_kegiatan.required' => 'Nama tidak boleh kosong',
            'tempat.required' => 'Tempat tidak boleh kosong',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'messages' => $validator->errors()
            ], 422);
        }

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $fileName = time() . '.' . $extension;
            $file->move(public_path('storage/images'), $fileName);
        }

        $save = KegiatanSinode::create([
            'nama_kegiatan' => $request->nama_kegiatan,
            'image' => $fileName ?? null,
            'tempat' => $request->tempat,
            'waktu' => $request->waktu,
        ]);
        if ($save) {
            return response()->json([
                'success' => true
            ], 201);
        } else {
            return response()->json([
                'success' => false
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(KegiatanSinode $kegiatanSinode)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(KegiatanSinode $kegiatanSinode)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, KegiatanSinode $kegiatanSinode)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(KegiatanSinode $kegiatanSinode, $id)
    {
        try {
            $deleted = $kegiatanSinode::findOrFail($id);
            $deleted->delete();

            return response()->json(['status' => true, 'message' => 'Data berhasil dihapus'], 200);
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'message' => 'Gagal menghapus data'], 500);
        }
    }
}
