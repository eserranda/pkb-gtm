<?php

namespace App\Http\Controllers;

use App\Models\Jemaat;
use App\Models\Klasis;
use App\Models\Dashboard;
use App\Models\AnggotaPKB;
use App\Models\JadwalIbadah;
use Illuminate\Http\Request;
use App\Models\AnggotaJemaat;
use App\Models\KegiatanSinode;
use App\Models\PengurusSinode;

class DashboardController extends Controller
{

    public function index()
    {

        $data_klasis = Klasis::count();
        $data_jemaat = Jemaat::count();
        $anggota_jemaat = AnggotaJemaat::count();
        $anggota_pkb = AnggotaPKB::count();
        return view('pages.dashboard.index', compact('data_klasis', 'data_jemaat', 'anggota_jemaat', 'anggota_pkb'));
    }


    public function home()
    {
        $pengurus  = PengurusSinode::get();
        $kegiatan = KegiatanSinode::get();
        return view('pages.home.index', compact('pengurus', 'kegiatan'));
    }

    public function klasis()
    {
        $klasis = Klasis::get();
        return view('pages.home.klasis', compact('klasis'));
    }

    public function visiMisi()
    {
        return view('pages.home.visi-misi',);
    }

    public function sejarah()
    {
        return view('pages.home.sejarah',);
    }

    public function listGereja()
    {
        $gereja = Jemaat::all();
        return view('pages.home.list-gereja', compact('gereja'));
    }

    public function detailGereja($id)
    {
        $gereja =  Jemaat::find($id);
        $jadwal_ibadah =  JadwalIbadah::where('id_jemaat', $id)->get();
        return view('pages.home.gereja', compact('gereja', 'jadwal_ibadah'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Dashboard $dashboard)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Dashboard $dashboard)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Dashboard $dashboard)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Dashboard $dashboard)
    {
        //
    }
}
