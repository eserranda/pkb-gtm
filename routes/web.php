<?php

use App\Models\Program;
use App\Models\DaftarKegiatan;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\PengurusController;
use App\Http\Controllers\DaftarKegiatanController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('pages.dashboard.index');
});

Route::prefix('program')->controller(ProgramController::class)->group(function () {
    Route::get('/', 'index');
    Route::get('/create', 'create');
    Route::post('/store', 'store');
});

Route::prefix('daftar-kegiatan')->controller(DaftarKegiatanController::class)->group(function () {
    Route::get('/create', 'create');
    Route::get('/', 'index');
    Route::post('/store', 'store');
});

// Route::prefix('pengurus')->controller(PengurusController::class)->group(function () {
//     Route::get('/', 'index');
// });


// Route::prefix('anggota')->controller(AnggotaController::class)->group(function () {
//     Route::get('/', 'index');
//     // Route::get('/create', 'create');
//     // Route::post('/', 'store');
//     // Route::get('/{anggota}/edit', 'edit');
//     // Route::put('/{anggota}', 'update');
//     // Route::delete('/{anggota}', 'destroy');
// });