<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SuratMasukSinode;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class SuratMasukSinodeController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $filterData = $request->input('filter');

            $query = SuratMasukSinode::query();
            if ($filterData) {
                $query->where('tanggal', $filterData);
            }

            $data = $query->latest('created_at')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('tanggal', function ($row) {
                    return date('d-m-Y', strtotime($row->tanggal));
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
        return view('pages.surat-masuk-sinode.index');
    }


    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'tanggal' => 'required',
            'nomor_surat' => 'required',
            'perihal' => 'required',
            'alamat_pengirim' => 'required',
            'tindak_lanjut' => 'required'
        ], [
            'required' => ':attribute harus diisi',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'messages' => $validator->errors()
            ],  422);
        }

        $save = SuratMasukSinode::create($request->all())->save();

        if ($save) {
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

    public function findById($id)
    {
        $data = SuratMasukSinode::find($id);
        return response()->json($data);
    }

    public function update(Request $request, SuratMasukSinode $suratMasukSinode)
    {
        $validator = Validator::make($request->all(), [
            'edit_tanggal' => 'required',
            'edit_nomor_surat' => 'required',
            'edit_perihal' => 'required',
            'edit_alamat_pengirim' => 'required',
            'edit_tindak_lanjut' => 'required'
        ], [
            'required' => ':attribute harus diisi',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'messages' => $validator->errors()
            ],  422);
        }

        $update = SuratMasukSinode::where('id', $request->input('id'))->update([
            'tanggal' => $request->input('edit_tanggal'),
            'nomor_surat' => $request->input('edit_nomor_surat'),
            'perihal' => $request->input('edit_perihal'),
            'alamat_pengirim' => $request->input('edit_alamat_pengirim'),
            'tindak_lanjut' => $request->input('edit_tindak_lanjut'),
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
    public function destroy(SuratMasukSinode $suratMasukSinode, $id)
    {
        try {
            $deleted = $suratMasukSinode::findOrFail($id);
            $deleted->delete();
            return response()->json(['status' => true, 'message' => 'Data berhasil dihapus'], 200);
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'message' => 'Gagal menghapus data'], 500);
        }
    }
}
