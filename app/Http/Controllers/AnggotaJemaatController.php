<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AnggotaJemaat;
use App\Imports\AnggotaJemaatImport;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class AnggotaJemaatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {

            $bidangFilter = $request->input('filter');

            $query = AnggotaJemaat::query();
            if ($bidangFilter) {
                $query->where('id_klasis', $bidangFilter);
            }

            if (auth()->user()->role == 'jemaat') {
                $id_jemaat = Auth::user()->id_jemaat;
                $data = $query->where('id_jemaat', $id_jemaat)->latest('created_at')->get();
            } else {
                $data = $query->latest('created_at')->get();
            }

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('id_jemaat', function ($row) {
                    if ($row->id_jemaat) {
                        return $row->jemaat->nama_jemaat;
                    } else {
                        return '-';
                    }
                })
                ->editColumn('mulai_berjemaat', function ($row) {
                    return date('d-m-Y', strtotime($row->mulai_berjemaat));
                })
                ->editColumn('tgl_lahir', function ($row) {
                    if ($row->tgl_lahir) {
                        return date('d-m-Y', strtotime($row->tgl_lahir));
                    } else {
                        return '-';
                    }
                })
                ->editColumn('tgl_pernikahan', function ($row) {
                    if ($row->tgl_pernikahan) {
                        return date('d-m-Y', strtotime($row->tgl_pernikahan));
                    } else {
                        return '-';
                    }
                })
                ->editColumn('baptis', function ($row) {
                    if ($row->baptis == 1) {
                        return 'Ya';
                    } else {
                        return 'Tidak';
                    }
                })
                ->editColumn('sidi', function ($row) {
                    if ($row->sidi == 1) {
                        return 'Ya';
                    } else {
                        return 'Tidak';
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
        return view('pages.anggota-jemaat.index');
    }


    public function import(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'file' => 'required|mimes:xls,xlsx'
        ], [
            'file.required' => 'file is required',
            'file.mimes' => 'File must be excel file'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'messages' => $validator->errors()
            ], 422);
        }

        Excel::import(new AnggotaJemaatImport(), $request->file('file'));

        return response()->json([
            'success' => true,
        ]);
    }

    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_klasis' => 'required',
            'id_jemaat' => 'required',
            'nama_anggota' => 'required',
            'gender' => 'required',
            'alamat' => 'required',
            'status_tempat_tinggal' => 'required',
            'mulai_berjemaat' => 'required',
            'status_pernikahan' => 'required',
            'tempat_lahir' => 'required',
            'tgl_lahir' => 'required',
            'pendidikan' => 'required',
            'pekerjaan' => 'required',
            'baptis' => 'required',
            'sidi' => 'required',
            'nama_ayah' => 'required',
            'nama_ibu' => 'required',
            'keterangan' => 'required',
        ], [
            'required' => ':attribute harus diisi'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'messages' => $validator->errors()
            ], 422);
        }

        $save = AnggotaJemaat::create($request->all());

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
    public function show(AnggotaJemaat $anggotaJemaat)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AnggotaJemaat $anggotaJemaat)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, AnggotaJemaat $anggotaJemaat)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AnggotaJemaat $anggotaJemaat, $id)
    {
        try {
            $deleted = $anggotaJemaat::findOrFail($id);
            $deleted->delete();

            return response()->json(['status' => true, 'message' => 'Data berhasil dihapus'], 200);
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'message' => 'Gagal menghapus data'], 500);
        }
    }
}
