<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PengurusSinode;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class PengurusSinodeController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $filterData = $request->input('jabatan');

            $query = PengurusSinode::query();
            if ($filterData) {
                $query->where('jabatan',  $filterData);
            }

            $data = $query->latest('created_at')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('periode', function ($row) {
                    return $row->tahun_mulai . ' - ' . $row->tahun_selesai;
                })
                ->addColumn('action', function ($row) {
                    $btn = '<a class="btn btn-outline-secondary btn-sm" title="Edit" onclick="edit(' . $row->id . ')"> <i class="fas fa-pencil-alt"></i> </a>';
                    $btn .= '<a class="btn btn-outline-secondary btn-sm  text-danger mx-1" title="Hapus" onclick="hapus(' . $row->id . ')"> <i class="fas fa-trash-alt"></i> </a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('pages.pengurus-sinode.index');
    }


    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'jabatan' => 'required',
            'tahun_mulai' => 'required',
            'tahun_selesai' => 'required',
        ], [
            'required' => ':attribute harus diisi'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'messages' => $validator->errors()
            ], 422);
        }

        $save = PengurusSinode::create($request->all());
        if ($save) {
            return response()->json([
                'success' => true
            ], 201);
        }

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
    public function show(PengurusSinode $pengurusSinode)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PengurusSinode $pengurusSinode)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PengurusSinode $pengurusSinode)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PengurusSinode $pengurusSinode, $id)
    {
        try {
            $deleted = $pengurusSinode::findOrFail($id);
            $deleted->delete();

            return response()->json(['status' => true, 'message' => 'Data berhasil dihapus'], 200);
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'message' => 'Gagal menghapus data'], 500);
        }
    }
}
