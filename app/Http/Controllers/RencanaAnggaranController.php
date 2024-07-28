<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RencanaAnggaran;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class RencanaAnggaranController extends Controller
{

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $filterData = $request->input('filter');

            $query = RencanaAnggaran::query();
            if ($filterData) {
                $query->where('jenis_anggaran', 'LIKE', '%' . $filterData . '%');
            }

            $data = $query->latest('created_at')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('nominal_anggaran', function ($row) {
                    return 'Rp' . number_format($row->nominal_anggaran, 0, ',', '.');
                })
                ->addColumn('action', function ($row) {
                    $btn = '<a class="btn btn-outline-secondary btn-sm" title="Edit" onclick="edit(' . $row->id . ')"> <i class="fas fa-pencil-alt"></i> </a>';
                    $btn .= '<a class="btn btn-outline-secondary btn-sm  text-danger mx-1" title="Hapus" onclick="hapus(' . $row->id . ')"> <i class="fas fa-trash-alt"></i> </a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('pages.rencana-anggaran.index');
    }


    public function findById($id)
    {
        $data = RencanaAnggaran::find($id);
        return response()->json($data);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'jenis_anggaran' => 'required',
            'sumber_anggaran' => 'required',
            'nominal_anggaran' => 'required|numeric',
        ], [
            'required' => ':attribute harus diisi',
            'numeric' => ':attribute harus berupa angka',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'messages' => $validator->errors()
            ], 422);
        }

        $save = RencanaAnggaran::create([
            'jenis_anggaran' => $request->input('jenis_anggaran'),
            'sumber_anggaran' => $request->input('sumber_anggaran'),
            'nominal_anggaran' => $request->input('nominal_anggaran'),
        ]);

        if ($save) {
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
     * Display the specified resource.
     */
    public function show(RencanaAnggaran $rencanaAnggaran)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(RencanaAnggaran $rencanaAnggaran)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, RencanaAnggaran $rencanaAnggaran)
    {
        $validator = Validator::make($request->all(), [
            'edit_jenis_anggaran' => 'required',
            'edit_sumber_anggaran' => 'required',
            'edit_nominal_anggaran' => 'required|numeric',
        ], [
            'required' => ':attribute harus diisi',
            'numeric' => ':attribute harus berupa angka',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'messages' => $validator->errors()
            ], 422);
        }

        $update = $rencanaAnggaran::where('id', $request->input('id'))->update([
            'jenis_anggaran' => $request->input('edit_jenis_anggaran'),
            'sumber_anggaran' => $request->input('edit_sumber_anggaran'),
            'nominal_anggaran' => $request->input('edit_nominal_anggaran'),
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
    public function destroy(RencanaAnggaran $rencanaAnggaran, $id)
    {
        try {
            $deleted = $rencanaAnggaran::findOrFail($id);
            $deleted->delete();

            return response()->json(['status' => true, 'message' => 'Data berhasil dihapus'], 200);
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'message' => 'Gagal menghapus data'], 500);
        }
    }
}