<?php

namespace App\Http\Controllers;

use App\Models\Klasis;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class KlasisController extends Controller
{

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $bidangFilter = $request->input('filter');

            $query = Klasis::query();
            if ($bidangFilter) {
                $query->where('wilayah', $bidangFilter);
            }

            $data = $query->latest('created_at')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<div class="d-flex justify-content-start align-items-center">';
                    $btn .= '<a class="btn btn-outline-secondary btn-sm mx-1" title="Edit" onclick="edit(' . $row->id . ')"> <i class="fas fa-pencil-alt"></i> </a>';
                    $btn .= '<a class="btn btn-outline-secondary btn-sm text-danger" title="Hapus" onclick="hapus(' . $row->id . ')"> <i class="fas fa-trash-alt"></i> </a>';
                    $btn .= '</div>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('pages.klasis.index');
    }


    public function getAllKlasis(Request $request)
    {
        $search = $request->input('term'); // Dapatkan parameter pencarian dari Select2

        // Ambil data dari database berdasarkan parameter pencarian
        $klasis = Klasis::where('nama_klasis', 'LIKE', '%' . $search . '%')
            ->select('id', 'nama_klasis as text')
            ->get();

        return response()->json($klasis);
    }

    public function findById($id)
    {
        $data = Klasis::find($id);
        return response()->json($data);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'wilayah' => 'required',
            'nama_klasis' => 'required',
        ], [
            'required' => ':attribute harus diisi',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'messages' => $validator->errors()
            ], 422);
        }


        $klasis = Klasis::create([
            'wilayah' => $request->wilayah,
            'nama_klasis' => $request->nama_klasis,
        ]);

        if ($klasis) {
            return response()->json([
                'success' => true,
                'messages' => 'Data klasis berhasil ditambahkan',
            ], 201);
        } else {
            return response()->json([
                'success' => false,
                'messages' => 'Data klasis gagal ditambahkan',
            ], 500);
        }
    }


    public function update(Request $request, Klasis $klasis)
    {
        $validator = Validator::make($request->all(), [
            'edit_wilayah' => 'required',
            'edit_nama_klasis' => 'required',
        ], [
            'required' => ':attribute harus diisi',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'messages' => $validator->errors()
            ], 422);
        }

        $update = $klasis::where('id', $request->input('id'))->update([
            'wilayah' => $request->input('edit_wilayah'),
            'nama_klasis' => $request->input('edit_nama_klasis'),
        ]);

        if ($update) {
            return response()->json([
                'success' => true
            ]);
        } else {
            return response()->json([
                'success' => false
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Klasis $klasis, $id)
    {
        try {
            $deleted = $klasis::findOrFail($id);
            $deleted->delete();

            return response()->json(['status' => true, 'message' => 'Data berhasil dihapus'], 200);
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'message' => 'Gagal menghapus data'], 500);
        }
    }
}
