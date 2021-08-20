<?php
use App\Http\Controllers\Dashboard;
use App\Http\Controllers\Agenda;
use App\Http\Controllers\Batas_umur;
use App\Http\Controllers\Infaq;
use App\Http\Controllers\Jabatan;
use App\Http\Controllers\Korcab;
use App\Http\Controllers\Korcam;
use App\Http\Controllers\Materi;
use App\Http\Controllers\Menu;
use App\Http\Controllers\Level;
use App\Http\Controllers\User;
use App\Http\Controllers\Registrasi_periode;
use App\Http\Controllers\Panitia;
use App\Http\Controllers\Penguji;
use App\Http\Controllers\Peserta;
use App\Http\Controllers\Tpq;

Route::get('/dashboard', [Dashboard::class, 'index'])->name('dashboard');

    /**
     * MASTER AGENDA
     */
    Route::group([
	    'prefix' => 'agenda',
	    'as' => 'agenda.',
	    'namespace' => 'Agenda',
	], function () {
	    Route::get('/', [Agenda::class, 'index'])->name('index');
	    Route::get('/add', [Agenda::class, 'add'])->name('add');
	    Route::post('/add', [Agenda::class, 'save'])->name('save');
	    Route::get('/edit', [Agenda::class, 'edit'])->name('edit');
	    Route::post('/edit', [Agenda::class, 'update'])->name('update');
	    Route::post('/delete', [Agenda::class, 'delete'])->name('delete');
	    Route::post('/datatable', [Agenda::class, 'datatable'])->name('datatable');
	});

	/**
     * MASTER Batas umur
     */
    Route::group([
	    'prefix' => 'batas_umur',
	    'as' => 'batas_umur.',
	    'namespace' => 'Batas_umur',
	], function () {
	    Route::get('/', [Batas_umur::class, 'index'])->name('index');
	    Route::get('/add', [Batas_umur::class, 'add'])->name('add');
	    Route::post('/add', [Batas_umur::class, 'save'])->name('save');
	    Route::get('/edit', [Batas_umur::class, 'edit'])->name('edit');
	    Route::post('/edit', [Batas_umur::class, 'update'])->name('update');
	    Route::post('/delete', [Batas_umur::class, 'delete'])->name('delete');
	    Route::post('/datatable', [Batas_umur::class, 'datatable'])->name('datatable');
	});

	/**
     * MASTER infaq
     */
    Route::group([
	    'prefix' => 'infaq',
	    'as' => 'infaq.',
	    'namespace' => 'Infaq',
	], function () {
	    Route::get('/', [Infaq::class, 'index'])->name('index');
	    Route::get('/add', [Infaq::class, 'add'])->name('add');
	    Route::post('/add', [Infaq::class, 'save'])->name('save');
	    Route::get('/edit', [Infaq::class, 'edit'])->name('edit');
	    Route::post('/edit', [Infaq::class, 'update'])->name('update');
	    Route::post('/delete', [Infaq::class, 'delete'])->name('delete');
	    Route::post('/datatable', [Infaq::class, 'datatable'])->name('datatable');
	});

	/**
     * MASTER jabatan
     */
    Route::group([
	    'prefix' => 'jabatan',
	    'as' => 'jabatan.',
	    'namespace' => 'Jabatan',
	], function () {
	    Route::get('/', [Jabatan::class, 'index'])->name('index');
	    Route::get('/add', [Jabatan::class, 'add'])->name('add');
	    Route::post('/add', [Jabatan::class, 'save'])->name('save');
	    Route::get('/edit', [Jabatan::class, 'edit'])->name('edit');
	    Route::post('/edit', [Jabatan::class, 'update'])->name('update');
	    Route::post('/delete', [Jabatan::class, 'delete'])->name('delete');
	    Route::post('/datatable', [Jabatan::class, 'datatable'])->name('datatable');
	});


	/**
     * MASTER korcab
     */
    Route::group([
	    'prefix' => 'korcab',
	    'as' => 'korcab.',
	    'namespace' => 'Korcab',
	], function () {
	    Route::get('/', [Korcab::class, 'index'])->name('index');
	    Route::get('/add', [Korcab::class, 'add'])->name('add');
	    Route::post('/add', [Korcab::class, 'save'])->name('save');
	    Route::get('/edit', [Korcab::class, 'edit'])->name('edit');
	    Route::post('/edit', [Korcab::class, 'update'])->name('update');
	    Route::post('/delete', [Korcab::class, 'delete'])->name('delete');
	    Route::post('/datatable', [Korcab::class, 'datatable'])->name('datatable');
	});

	/**
     * MASTER korcam
     */
    Route::group([
	    'prefix' => 'korcam',
	    'as' => 'korcam.',
	    'namespace' => 'Korcam',
	], function () {
	    Route::get('/', [Korcam::class, 'index'])->name('index');
	    Route::get('/add', [Korcam::class, 'add'])->name('add');
	    Route::post('/add', [Korcam::class, 'save'])->name('save');
	    Route::get('/edit', [Korcam::class, 'edit'])->name('edit');
	    Route::post('/edit', [Korcam::class, 'update'])->name('update');
	    Route::post('/delete', [Korcam::class, 'delete'])->name('delete');
	    Route::post('/datatable', [Korcam::class, 'datatable'])->name('datatable');
	});


	/**
     * MASTER materi
     */
    Route::group([
	    'prefix' => 'materi',
	    'as' => 'materi.',
	    'namespace' => 'Materi',
	], function () {
	    Route::get('/', [Materi::class, 'index'])->name('index');
	    Route::get('/add', [Materi::class, 'add'])->name('add');
	    Route::post('/add', [Materi::class, 'save'])->name('save');
	    Route::get('/edit', [Materi::class, 'edit'])->name('edit');
	    Route::post('/edit', [Materi::class, 'update'])->name('update');
	    Route::post('/delete', [Materi::class, 'delete'])->name('delete');
	    Route::post('/datatable', [Materi::class, 'datatable'])->name('datatable');
	});


	/**
     * MASTER menu
     */
    Route::group([
	    'prefix' => 'menu',
	    'as' => 'menu.',
	    'namespace' => 'Menu',
	], function () {
	    Route::get('/', [Menu::class, 'index'])->name('index');
	    Route::get('/add', [Menu::class, 'add'])->name('add');
	    Route::post('/add', [Menu::class, 'save'])->name('save');
	    Route::get('/edit', [Menu::class, 'edit'])->name('edit');
	    Route::post('/edit', [Menu::class, 'update'])->name('update');
	    Route::post('/delete', [Menu::class, 'delete'])->name('delete');
	    Route::post('/datatable', [Menu::class, 'datatable'])->name('datatable');
	});

	/**
     * MASTER level
     */
    Route::group([
	    'prefix' => 'level',
	    'as' => 'level.',
	    'namespace' => 'Level',
	], function () {
	    Route::get('/', [Level::class, 'index'])->name('index');
	    Route::get('/add', [Level::class, 'add'])->name('add');
	    Route::post('/add', [Level::class, 'save'])->name('save');
	    Route::get('/edit', [Level::class, 'edit'])->name('edit');
	    Route::post('/edit', [Level::class, 'update'])->name('update');
	    Route::post('/delete', [Level::class, 'delete'])->name('delete');
	    Route::post('/datatable', [Level::class, 'datatable'])->name('datatable');
	});

	/**
     * master user
     */
    Route::group([
	    'prefix' => 'user',
	    'as' => 'user.',
	    'namespace' => 'User',
	], function () {
	    Route::get('/', [User::class, 'index'])->name('index');
	    Route::get('/add', [User::class, 'add'])->name('add');
	    Route::post('/add', [User::class, 'save'])->name('save');
	    Route::get('/edit', [User::class, 'edit'])->name('edit');
	    Route::post('/edit', [User::class, 'update'])->name('update');
	    Route::post('/delete', [User::class, 'delete'])->name('delete');
	    Route::post('/datatable', [User::class, 'datatable'])->name('datatable');
	});

	/**
     * t registrasi periode
     */
    Route::group([
	    'prefix' => 'registrasi_periode',
	    'as' => 'registrasi_periode.',
	    'namespace' => 'Registrasi_periode',
	], function () {
	    Route::get('/', [Registrasi_periode::class, 'index'])->name('index');
	    Route::get('/add', [Registrasi_periode::class, 'add'])->name('add');
	    Route::post('/add', [Registrasi_periode::class, 'save'])->name('save');
	    Route::get('/edit', [Registrasi_periode::class, 'edit'])->name('edit');
	    Route::post('/edit', [Registrasi_periode::class, 'update'])->name('update');
	    Route::post('/delete', [Registrasi_periode::class, 'delete'])->name('delete');
	    Route::post('/datatable', [Registrasi_periode::class, 'datatable'])->name('datatable');
	});

	/**
     *  MASTER PANITIA
     */
    Route::group([
	    'prefix' => 'panitia',
	    'as' => 'panitia.',
	    'namespace' => 'Panitia',
	], function () {
	    Route::get('/', [Panitia::class, 'index'])->name('index');
	    Route::get('/add', [Panitia::class, 'add'])->name('add');
	    Route::post('/add', [Panitia::class, 'save'])->name('save');
	    Route::get('/edit', [Panitia::class, 'edit'])->name('edit');
	    Route::post('/edit', [Panitia::class, 'update'])->name('update');
	    Route::post('/delete', [Panitia::class, 'delete'])->name('delete');
	    Route::post('/datatable', [Panitia::class, 'datatable'])->name('datatable');
	});

	/**
     *  MASTER PENGUJI
     */
    Route::group([
	    'prefix' => 'penguji',
	    'as' => 'penguji.',
	    'namespace' => 'Penguji',
	], function () {
	    Route::get('/', [Penguji::class, 'index'])->name('index');
	    Route::get('/add', [Penguji::class, 'add'])->name('add');
	    Route::post('/add', [Penguji::class, 'save'])->name('save');
	    Route::get('/edit', [Penguji::class, 'edit'])->name('edit');
	    Route::post('/edit', [Penguji::class, 'update'])->name('update');
	    Route::post('/delete', [Penguji::class, 'delete'])->name('delete');
	    Route::post('/datatable', [Penguji::class, 'datatable'])->name('datatable');
	});

	/**
     *  MASTER PESERTA
     */
    Route::group([
	    'prefix' => 'peserta',
	    'as' => 'peserta.',
	    'namespace' => 'Peserta',
	], function () {
	    Route::get('/', [Peserta::class, 'index'])->name('index');
	    Route::get('/add', [Peserta::class, 'add'])->name('add');
	    Route::post('/add', [Peserta::class, 'save'])->name('save');
	    Route::get('/edit', [Peserta::class, 'edit'])->name('edit');
	    Route::post('/edit', [Peserta::class, 'update'])->name('update');
	    Route::post('/delete', [Peserta::class, 'delete'])->name('delete');
	    Route::post('/datatable', [Peserta::class, 'datatable'])->name('datatable');
	});

	/**
     *  MASTER TPQ
     */
    Route::group([
	    'prefix' => 'tpq',
	    'as' => 'tpq.',
	    'namespace' => 'Tpq',
	], function () {
	    Route::get('/', [Tpq::class, 'index'])->name('index');
	    Route::get('/add', [Tpq::class, 'add'])->name('add');
	    Route::post('/add', [Tpq::class, 'save'])->name('save');
	    Route::get('/edit', [Tpq::class, 'edit'])->name('edit');
	    Route::post('/edit', [Tpq::class, 'update'])->name('update');
	    Route::post('/delete', [Tpq::class, 'delete'])->name('delete');
	    Route::post('/datatable', [Tpq::class, 'datatable'])->name('datatable');
	});

	/**
     *  HAK AKSES
     */
    Route::group([
	    'prefix' => 'hak_akses',
	    'as' => 'hak_akses.',
	    'namespace' => 'Hak_akses',
	], function () {
	    Route::get('/', [Hak_akses::class, 'index'])->name('index');
	    Route::get('/add', [Hak_akses::class, 'add'])->name('add');
	    Route::post('/add', [Hak_akses::class, 'save'])->name('save');
	    Route::get('/edit', [Hak_akses::class, 'edit'])->name('edit');
	    Route::post('/edit', [Hak_akses::class, 'update'])->name('update');
	    Route::post('/delete', [Hak_akses::class, 'delete'])->name('delete');
	    Route::post('/datatable', [Hak_akses::class, 'datatable'])->name('datatable');
	});