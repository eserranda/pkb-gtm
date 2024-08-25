<?php

use App\Models\Program;
use App\Models\DaftarKegiatan;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\JemaatController;
use App\Http\Controllers\KlasisController;
use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\AnggotaJemaatController;
use App\Http\Controllers\AnggotaPKBController;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\PengurusController;
use App\Http\Controllers\DaftarKegiatanController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\JadwalIbadahController;
use App\Http\Controllers\PengurusSinodeController;
use App\Http\Controllers\RencanaAnggaranController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\SuratMasukSinodeController;
use App\Http\Controllers\UserJemaatController;
use App\Http\Controllers\UserKlasisController;
use App\Models\AnggotaPKB;
use Illuminate\Auth\Notifications\ResetPassword;

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

Route::get('logout', [UserController::class, 'logout'])->name('logout');

Route::get('/forgot-password', [ResetPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('/forgot-password', [ResetPasswordController::class, 'resetPassword'])->name('password.email');
Route::get('/password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('/password/reset', [ResetPasswordController::class, 'updatePassword'])->name('password.update');

Route::prefix('login')->controller(UserController::class)->group(function () {
    Route::get('/',  'showLoginForm')->name('login')->middleware('guest');
    Route::post('/', 'login')->middleware('guest');
});


Route::get('/', [DashboardController::class, 'home']);
Route::get('/visi-misi', [DashboardController::class, 'visiMisi']);
Route::get('/sejarah', [DashboardController::class, 'sejarah']);
Route::get('/list-gereja', [DashboardController::class, 'listGereja']);
Route::get('/home-klasis', [DashboardController::class, 'klasis']);
Route::get('/detail-gereja/{id}', [DashboardController::class, 'detailGereja'])->name('home.detail-gereja');


Route::prefix('dashboard')->controller(DashboardController::class)->group(function () {
    Route::get('/', 'index')->name('dashboard.index')->middleware('auth');
});

Route::prefix('pengurus-sinode')->controller(PengurusSinodeController::class)->group(function () {
    Route::get('/', 'index')->name('pengurus-sinode.index')->middleware('auth');
    Route::post('/store', 'store');


    Route::get('/create', 'create');
    Route::get('/findById/{id}', 'findById');
    Route::post('/update', 'update');
    Route::delete('/destroy/{id}', 'destroy');
})->middleware('auth');

Route::prefix('surat-masuk-sinode')->controller(SuratMasukSinodeController::class)->group(function () {
    Route::get('/', 'index')->name('surat-masuk-sinode.index')->middleware('auth');
    Route::get('/create', 'create');
    Route::get('/findById/{id}', 'findById');
    Route::post('/store', 'store');
    Route::post('/import', 'import');
    Route::post('/update', 'update');
    Route::delete('/destroy/{id}', 'destroy');
})->middleware('auth');

Route::prefix('users-jemaat')->controller(UserJemaatController::class)->group(function () {
    Route::get('/', 'index')->name('users-jemaat.index')->middleware('auth');
    Route::post('/register', 'register');
    // Route::get('/findById/{id}', 'findById');
    // Route::post('/update', 'update');
    Route::delete('/destroy/{id}', 'destroy');
})->middleware('auth');

Route::prefix('users-klasis')->controller(UserKlasisController::class)->group(function () {
    Route::get('/', 'index')->name('users-klasis.index')->middleware('auth');
    Route::post('/register', 'register');
    // Route::get('/findById/{id}', 'findById');
    // Route::post('/update', 'update');
    Route::delete('/destroy/{id}', 'destroy');
})->middleware('auth');

Route::prefix('users')->controller(UserController::class)->group(function () {
    Route::get('/', 'index')->name('users.index')->middleware('auth');
    Route::post('/register', 'register');
    Route::get('/findById/{id}', 'findById');
    Route::post('/update', 'update');
    Route::delete('/destroy/{id}', 'destroy');
})->middleware('auth');

Route::prefix('roles')->controller(RoleController::class)->group(function () {
    Route::get('/', 'index')->name('roles.index')->middleware('role:super_admin');
    Route::post('/store', 'store');
    Route::get('/findById/{id}', 'findById');
    Route::post('/update', 'update');
    Route::delete('/destroy/{id}', 'destroy');
    Route::get('/getAllRoles', 'getAllRoles');
    Route::get('/getUserRoles/{id}', 'getUserRoles');
})->middleware('auth');

Route::prefix('jadwal-ibadah')->controller(JadwalIbadahController::class)->group(function () {
    Route::get('/', 'index')->name('jadwal-ibadah.index')->middleware('auth');
    Route::get('/findById/{id}', 'findById');
    Route::post('/store', 'store');
    Route::post('/update', 'update');
    Route::delete('/destroy/{id}', 'destroy');
})->middleware('auth');

Route::prefix('anggota-pkb')->controller(AnggotaPKBController::class)->group(function () {
    Route::get('/', 'index')->name('anggota-pkb.index')->middleware('auth');
    Route::get('/findById/{id}', 'findById');
    Route::post('/store', 'store');
    Route::post('/update', 'update');
    Route::delete('/destroy/{id}', 'destroy');
    Route::get('/getAllAnggota', 'getAllAnggota');
    Route::get('/findOne/{id}', 'findOne');
})->middleware('auth');

Route::prefix('anggota-jemaat')->controller(AnggotaJemaatController::class)->group(function () {
    Route::get('/', 'index')->name('anggota-jemaat.index')->middleware('auth');
    Route::get('/create', 'create');
    Route::get('/findById/{id}', 'findById');
    Route::post('/store', 'store');
    Route::post('/import', 'import');
    Route::post('/update', 'update');
    Route::delete('/destroy/{id}', 'destroy');
})->middleware('auth');

Route::prefix('jemaat')->controller(JemaatController::class)->group(function () {
    Route::get('/', 'index')->name('jemaat.index')->middleware('auth');
    Route::get('/create', 'create');
    Route::get('/findById/{id}', 'findById');
    Route::post('/store', 'store');
    Route::post('/update', 'update');
    Route::delete('/destroy/{id}', 'destroy');
    Route::get('/getIdAndNameAllKlasis', 'getIdAndNameAllKlasis');
    Route::get('/getAllJemaat', 'getAllJemaat');
    Route::get('/findOne/{id}', 'findOne');
})->middleware('auth');

Route::prefix('klasis')->controller(KlasisController::class)->group(function () {
    Route::get('/', 'index')->name('klasis.index')->middleware('auth');
    Route::get('/create', 'create');
    Route::get('/findById/{id}', 'findById');
    Route::post('/store', 'store');
    Route::post('/update', 'update');
    Route::delete('/destroy/{id}', 'destroy');
    Route::get('/getAllKlasis', 'getAllKlasis');
    Route::get('/getIdAndNameAllKlasis', 'getIdAndNameAllKlasis');
    Route::get('/findOne/{id}', 'findOne');
})->middleware('auth');

Route::prefix('rencana-anggaran')->controller(RencanaAnggaranController::class)->group(function () {
    Route::get('/', 'index')->name('rencana-anggaran.index')->middleware('auth');
    Route::get('/create', 'create');
    Route::get('/findById/{id}', 'findById');
    Route::post('/store', 'store');
    Route::post('/update', 'update');
    Route::delete('/destroy/{id}', 'destroy');
})->middleware('auth');

Route::prefix('program')->controller(ProgramController::class)->group(function () {
    Route::get('/', 'index')->name('program.index')->middleware('auth');
    Route::get('/create', 'create');
    Route::get('/findById/{id}', 'findById');
    Route::post('/store', 'store');
    Route::post('/update', 'update');
    Route::delete('/destroy/{id}', 'destroy');
})->middleware('auth');

Route::prefix('daftar-kegiatan')->controller(DaftarKegiatanController::class)->group(function () {
    Route::get('/create', 'create')->middleware('auth');
    Route::get('/', 'index');
    Route::post('/store', 'store');
    Route::delete('/destroy/{id}', 'destroy');
})->middleware('auth');

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