<?php

namespace App\Http\Controllers;

use App\Models\AnggotaPKB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class AnggotaPKBController extends Controller
{

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $filterData = $request->input('filter');

            $query = AnggotaPKB::query();
            if ($filterData) {
                $query->where('kelompok', $filterData);
            }

            if (auth()->user()->role == 'jemaat') {
                $id_jemaat = Auth::user()->id_jemaat;
                $data = $query->where('id_jemaat', $id_jemaat)->latest('created_at')->get();
            } else {
                $data = $query->latest('created_at')->get();
            }

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('id_klasis', function ($row) {
                    if ($row->id_klasis) {
                        return $row->klasis->nama_klasis;
                    } else {
                        return '-';
                    }
                })
                ->addColumn('id_jemaat', function ($row) {
                    if ($row->id_jemaat) {
                        return $row->jemaat->nama_jemaat;
                    } else {
                        return '-';
                    }
                })
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
        return view('pages.anggota-pkb.index');
    }

    public function findById($id)
    {
        $data = AnggotaPKB::find($id);
        return response()->json($data);
    }

    public function findOne($id)
    {
        $data = AnggotaPKB::find($id);
        return response()->json($data);
    }

    public function getAllAnggota(Request $request)
    {
        $search = $request->input('term'); // Dapatkan parameter pencarian dari Select2

        // Ambil data dari database berdasarkan parameter pencarian
        $klasis = AnggotaPKB::where('nama_anggota', 'LIKE', '%' . $search . '%')
            ->select('id', 'nama_anggota as text')
            ->get();

        return response()->json($klasis);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_klasis' => 'required',
            'id_jemaat' => 'required',
            'nama_anggota' => 'required',
            'kelompok' => 'required',
        ], [
            'id_klasis.required' => 'Klasis tidak boleh kosong',
            'id_jemaat.required' => 'Jemaat tidak boleh kosong',
            'kelompok.required' => 'Kelompok tidak boleh kosong',
            'nama_anggota.required' => 'Nama anggota tidak boleh kosong',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'messages' => $validator->errors()
            ], 422);
        }

        $save = AnggotaPKB::create([
            'id_klasis' => $request->id_klasis,
            'id_jemaat' => $request->id_jemaat,
            'kelompok' => $request->kelompok,
            'nama_anggota' => $request->nama_anggota,
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


    public function update(Request $request, AnggotaPKB $anggotaPKB)
    {
        $validator = Validator::make($request->all(), [
            'edit_id_klasis' => 'required',
            'edit_id_jemaat' => 'required',
            'edit_nama_anggota' => 'required',
            'edit_kelompok' => 'required',
        ], [
            'edit_id_klasis.required' => 'Klasis tidak boleh kosong',
            'edit_id_jemaat.required' => 'Jemaat tidak boleh kosong',
            'edit_nama_anggota.required' => 'Nama anggota tidak boleh kosong',
            'edit_kelompok.required' => 'Kelompok tidak boleh kosong',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'messages' => $validator->errors()
            ], 422);
        }

        $update = $anggotaPKB::find($request->id)->update([
            'id_klasis' => $request->edit_id_klasis,
            'id_jemaat' => $request->edit_id_jemaat,
            'kelompok' => $request->edit_kelompok,
            'nama_anggota' => $request->edit_nama_anggota,
        ]);

        if ($update) {
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
     * Remove the specified resource from storage.
     */
    public function destroy(AnggotaPKB $anggotaPKB, $id)
    {
        try {
            $deleted = $anggotaPKB::findOrFail($id);
            $deleted->delete();

            return response()->json(['status' => true, 'message' => 'Data berhasil dihapus'], 200);
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'message' => 'Gagal menghapus data'], 500);
        }
    }
}
