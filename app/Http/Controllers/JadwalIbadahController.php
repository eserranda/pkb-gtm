<?php

namespace App\Http\Controllers;

use App\Models\JadwalIbadah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class JadwalIbadahController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $filterData = $request->input('filter');

            $query = JadwalIbadah::query();
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
                ->addColumn('id_anggota_pkb', function ($row) {
                    if ($row->id_anggota_pkb) {
                        return $row->anggota->nama_anggota;
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
        return view('pages.jadwal-ibadah.index');
    }


    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_jemaat' => 'required',
            'id_anggota_pkb' => 'required',
            'kelompok' => 'required',
            'tanggal' => 'required',
            'pelayan_firman' => 'required',
            'mc' => 'required',
            'persembahan' => 'required',
            'kolektan' => 'required',
            'lelang' => 'required',
            'tempat_ibadah' => 'required',
        ], [
            'required' => ':attribute harus diisi',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'messages' => $validator->errors()
            ], 422);
        }

        $save = JadwalIbadah::create($request->all());

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

    public function findById($id)
    {
        $data = JadwalIbadah::find($id);
        return response()->json($data);
    }

    /**
     * Display the specified resource.
     */
    public function show(JadwalIbadah $jadwalIbadah)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(JadwalIbadah $jadwalIbadah)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, JadwalIbadah $jadwalIbadah)
    {
        $validator = Validator::make($request->all(), [
            'edit_id_jemaat' => 'required',
            'edit_id_anggota_pkb' => 'required',
            'edit_kelompok' => 'required',
            'edit_tanggal' => 'required',
            'edit_pelayan_firman' => 'required',
            'edit_mc' => 'required',
            'edit_persembahan' => 'required',
            'edit_kolektan' => 'required',
            'edit_lelang' => 'required',
            'edit_tempat_ibadah' => 'required',
        ], [
            'required' => ':attribute harus diisi',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'messages' => $validator->errors()
            ], 422);
        }

        $update = $jadwalIbadah::where('id', $request->input('id'))->update([
            'id_jemaat' => $request->input('edit_id_jemaat'),
            'id_anggota_pkb' => $request->input('edit_id_anggota_pkb'),
            'kelompok' => $request->input('edit_kelompok'),
            'tanggal' => $request->input('edit_tanggal'),
            'pelayan_firman' => $request->input('edit_pelayan_firman'),
            'mc' => $request->input('edit_mc'),
            'persembahan' => $request->input('edit_persembahan'),
            'kolektan' => $request->input('edit_kolektan'),
            'lelang' => $request->input('edit_lelang'),
            'tempat_ibadah' => $request->input('edit_tempat_ibadah'),
        ]);

        if ($update) {
            return response()->json([
                'success' => true
            ], 200);
        } else {
            return response()->json([
                'success' => false
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(JadwalIbadah $jadwalIbadah, $id)
    {
        try {
            $deleted = $jadwalIbadah::findOrFail($id);
            $deleted->delete();

            return response()->json(['status' => true, 'message' => 'Data berhasil dihapus'], 200);
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'message' => 'Gagal menghapus data'], 500);
        }
    }
}
