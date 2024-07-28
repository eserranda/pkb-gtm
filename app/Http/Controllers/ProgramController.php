<?php

namespace App\Http\Controllers;

use App\Models\Program;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class ProgramController extends Controller
{

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $bidangFilter = $request->input('bidang');

            $query = Program::query();
            if ($bidangFilter) {
                $query->where('bidang', $bidangFilter);
            }

            $data = $query->latest('created_at')->get();

            // $data = Program::latest('created_at')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                // ->addColumn('biaya', function ($row) {
                //     if ($row->biaya) {
                //         return 'Rp' . number_format($row->biaya, 0, ',', '.');
                //     } else {
                //         return '-';
                //     }
                // })
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
        return view('pages.program.index');
    }


    public function findById($id)
    {
        $data = Program::find($id);
        return response()->json($data);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_program' => 'required',
            'bidang' => 'required',
            'tujuan' => 'required',
            'bentuk' => 'required',
            'sumber_anggaran' => 'required',
            'penanggung_jawab' => 'required',
            'waktu' => 'required',
        ], [
            'required' => ':attribute harus diisi',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'messages' => $validator->errors()
            ], 422);
        }

        $save = Program::create([
            'nama_program' => $request->nama_program,
            'bidang' => $request->bidang,
            'tujuan' => $request->tujuan,
            'bentuk' => $request->bentuk,
            'sumber_anggaran' => $request->sumber_anggaran,
            'penanggung_jawab' => $request->penanggung_jawab,
            'biaya' => $request->biaya,
            'waktu' => $request->waktu,
            'tempat' => $request->tempat,
        ]);

        if ($save) {
            return response()->json([
                'success' => true,
                'messages' => 'Program baru ditambahkan'
            ], 201);
        } else {
            return response()->json([
                'success' => false,
                'messages' => 'Program gagal ditambahkan'
            ], 409);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Program $program)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Program $program)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Program $program)
    {
        $validator = Validator::make($request->all(), [
            'edit_nama_program' => 'required',
            'edit_bidang' => 'required',
            'edit_tujuan' => 'required',
            'edit_bentuk' => 'required',
            'edit_sumber_anggaran' => 'required',
            'edit_penanggung_jawab' => 'required',
            // 'edit_biaya' => 'required',
            'edit_waktu' => 'required',
            // 'edit_tempat' => 'required',
        ], [
            'required' => ':attribute harus diisi',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'messages' => $validator->errors()
            ], 422);
        }

        $update = Program::where('id', $request->id)->update([
            'nama_program' => $request->edit_nama_program,
            'bidang' => $request->edit_bidang,
            'tujuan' => $request->edit_tujuan,
            'bentuk' => $request->edit_bentuk,
            'sumber_anggaran' => $request->edit_sumber_anggaran,
            'penanggung_jawab' => $request->edit_penanggung_jawab,
            'biaya' => $request->edit_biaya,
            'waktu' => $request->edit_waktu,
            'tempat' => $request->edit_tempat,
        ]);

        if ($update) {
            return response()->json([
                'success' => true,
                'messages' => 'Program berhasil diubah'
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'messages' => 'Program gagal diubah'
            ], 409);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Program $program, $id)
    {
        try {
            $deleted = $program::findOrFail($id);
            $deleted->delete();

            return response()->json(['status' => true, 'message' => 'Data berhasil dihapus'], 200);
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'message' => 'Gagal menghapus data'], 500);
        }
    }
}