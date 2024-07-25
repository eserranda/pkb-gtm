<?php

use App\Models\Program;
use App\Models\DaftarKegiatan;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\PengurusController;
use App\Http\Controllers\DaftarKegiatanController;
use App\Http\Controllers\RencanaAnggaranController;

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

Route::get('login', [UserController::class, 'showLoginForm'])->name('login')->middleware('guest');
Route::post('login', [UserController::class, 'login'])->middleware('guest');

Route::get('logout', [UserController::class, 'logout'])->name('logout');

Route::get('/', function () {
    return view('pages.dashboard.index');
})->name('dashboard')->middleware('auth');

Route::prefix('users')->controller(UserController::class)->group(function () {
    Route::get('/', 'index')->name('users.index')->middleware('role:super_admin');
    Route::post('/register', 'register');
    Route::get('/findById/{id}', 'findById');
    Route::post('/update', 'update');
    Route::delete('/destroy/{id}', 'destroy');
});

Route::prefix('roles')->controller(RoleController::class)->group(function () {
    Route::get('/', 'index')->name('roles.index')->middleware('role:super_admin');
    Route::post('/store', 'store');
    Route::get('/findById/{id}', 'findById');
    Route::post('/update', 'update');
    Route::delete('/destroy/{id}', 'destroy');
});

Route::prefix('rencana-anggaran')->controller(RencanaAnggaranController::class)->group(function () {
    Route::get('/', 'index')->name('rencana-anggaran.index')->middleware('auth');
    Route::get('/create', 'create');
    Route::get('/findById/{id}', 'findById');
    Route::post('/store', 'store');
    Route::post('/update', 'update');
    Route::delete('/destroy/{id}', 'destroy');
});

Route::prefix('program')->controller(ProgramController::class)->group(function () {
    Route::get('/', 'index')->name('program.index')->middleware('auth');
    Route::get('/create', 'create');
    Route::get('/findById/{id}', 'findById');
    Route::post('/store', 'store');
    Route::post('/update', 'update');
    Route::delete('/destroy/{id}', 'destroy');
});

Route::prefix('daftar-kegiatan')->controller(DaftarKegiatanController::class)->group(function () {
    Route::get('/create', 'create')->middleware('auth');
    Route::get('/', 'index');
    Route::post('/store', 'store');
    Route::delete('/destroy/{id}', 'destroy');
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