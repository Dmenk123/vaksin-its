<?php

use App\Http\Controllers\Home;
use App\Http\Controllers\Login;
use App\Http\Controllers\Logout;
use App\Http\Controllers\Vaksin;
use App\Http\Controllers\Riwayat;
// use App\Http\Controllers\Dashboard;
use Illuminate\Support\Facades\Route;


// Route::get('/', [Home::class, 'index'])->name('index')->middleware('user');
Route::get('/', [Home::class, 'index'])->name('index');
Route::get('/login', [Login::class, 'index'])->name('login');
Route::post('/login', [Login::class, 'cek'])->name('login.cek');
Route::get('/generate_hash/{param1}', [Login::class, 'generate_hash'])->name('generate_hash');

Route::group([
    'prefix' => 'app',
    'as' => 'app.',
    // 'middleware' => ['user'],
], function () {
    Route::get('/riwayat', [Riwayat::class, 'riwayat'])->name('riwayat');
    Route::get('/jadwal_vaksin', [Vaksin::class, 'jadwal_vaksin'])->name('jadwal_vaksin');
    // ###################### APBD #######################
    // Route::post('/datatable_apbd_sby', [Apbd::class, 'datatable_apbd_sby'])->name('datatable_apbd_sby');
    // Route::get('/get_list_api_adpem', [Apbd::class, 'get_list_api_adpem'])->name('get_list_api_adpem');
    // Route::get('/insert_db_api', [Apbd::class, 'insert_db_api'])->name('insert_db_api');
    // Route::post('/datatable_btt', [Apbd::class, 'datatable_btt'])->name('datatable_btt');

    // ###################### BANTUAN #######################
    // Route::post('/datatable_bantuan', [Bantuan::class, 'datatable_bantuan'])->name('datatable_bantuan');

    // ###################### CSR/BANTUAN MASYARAKAT #######################
    // Route::post('/datatable_csr', [Csr::class, 'datatable_csr'])->name('datatable_csr');
    // Route::post('/datatable_csr_uang', [Csr::class, 'datatable_csr_uang'])->name('datatable_csr_uang');
    // Route::post('/datatable_csr_default', [Csr::class, 'datatable_csr_default'])->name('datatable_csr_default');
    // Route::post('/datatable_subdetail_uang', [Csr::class, 'datatable_subdetail_uang'])->name('datatable_subdetail_uang');
    // Route::post('/load_tabel_subdetail', [Csr::class, 'load_tabel_subdetail'])->name('load_tabel_subdetail');
    // Route::get('/insert_db_api_csr', [Csr::class, 'insert_db_api_csr'])->name('insert_db_api_csr');

    // ###################### TARIK DATA #######################
    // Route::get('/proses_tarik/{tgl}/{metode}', [Tarikdata::class, 'proses_tarik'])->name('proses_tarik');
});




