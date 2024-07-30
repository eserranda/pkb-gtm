<?php

namespace App\Http\Controllers;

use App\Models\Jemaat;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class JemaatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $bidangFilter = $request->input('filter');

            $query = Jemaat::query();
            if ($bidangFilter) {
                $query->where('id_klasis', $bidangFilter);
            }

            $data = $query->latest('created_at')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('id_klasis', function ($row) {
                    if ($row->id_klasis) {
                        return $row->klasis->nama_klasis;
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
        return view('pages.jemaat.index');
    }

    public function getAllJemaat(Request $request)
    {
        $search = $request->input('term'); // Dapatkan parameter pencarian dari Select2

        // Ambil data dari database berdasarkan parameter pencarian
        $klasis = Jemaat::where('nama_jemaat', 'LIKE', '%' . $search . '%')
            ->select('id', 'nama_jemaat as text')
            ->get();

        return response()->json($klasis);
    }

    public function findOne($id)
    {
        $data = Jemaat::find($id);
        return response()->json($data);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_klasis' => 'required',
            'nama_jemaat' => 'required',
            'pelayan' => 'required',
            'alamat' => 'required',
        ], [
            'id_klasis.required' => 'Klasis wajib diisi',
            'nama_jemaat.required' => 'Nama Jemaat wajib diisi',
            'pelayan.required' => 'Nama Pelayan wajib diisi',
            'alamat.required' => 'Alamat wajib diisi',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'messages' => $validator->errors()
            ], 422);
        }

        $save = Jemaat::create([
            'id_klasis' => $request->id_klasis,
            'nama_jemaat' => $request->nama_jemaat,
            'pelayan' => $request->pelayan,
            'alamat' => $request->alamat,
        ]);

        if ($save) {
            return response()->json([
                'success' => true,
                'messages' => 'Data jemaat berhasil ditambahkan'
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'messages' => 'Data jemaat gagal ditambahkan'
            ], 500);
        }
    }

    public function getIdAndNameAllKlasis()
    {
        $jemaats = Jemaat::with('klasis:id,nama_klasis') // Eager load klasis
            ->select('id_klasis')
            ->distinct()
            ->get();


        $result = $jemaats->map(function ($jemaat) {
            return [
                'id_klasis' => $jemaat->id_klasis,
                'nama_klasis' => $jemaat->klasis->nama_klasis,
            ];
        });

        return response()->json($result);
    }

    /**
     * Display the specified resource.
     */
    public function show(Jemaat $jemaat)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Jemaat $jemaat)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Jemaat $jemaat)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Jemaat $jemaat, $id)
    {
        try {
            $deleted = $jemaat::findOrFail($id);
            $deleted->delete();

            return response()->json(['status' => true, 'message' => 'Data berhasil dihapus'], 200);
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'message' => 'Gagal menghapus data'], 500);
        }
    }
}