<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\OPDController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BesettingJFController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\UsulanController;
use App\Http\Controllers\VerifikasiController;
use App\Http\Controllers\BahanRapatController;
use App\Http\Controllers\SKController;
use App\Http\Controllers\LaporanController;

// ==================== ROUTE AUTH ====================
Route::get('/', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
//Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
//Route::post('/register', [AuthController::class, 'register'])->name('register.post');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

// ==================== ROUTE DASHBOARD ====================
Route::get('/dashboard/admin_sistem', [AuthController::class, 'dashboardAdminSistem'])->name('dashboard.admin_sistem');
Route::get('/dashboard/admin_opd', [AuthController::class, 'dashboardAdminOPD'])->name('dashboard.admin_opd');
Route::get('/dashboard/verifikator', [AuthController::class, 'dashboardVerifikator'])->name('dashboard.verifikator');
Route::get('/dashboard/admin_administrasi', [AuthController::class, 'dashboardAdminAdministrasi'])->name('dashboard.admin_administrasi');

// ==================== ROUTE RESOURCE ====================
Route::resource('opd', OPDController::class);                    // Kelola OPD (Admin Sistem)
Route::resource('user', UserController::class);                  // Kelola User (Admin Sistem)
Route::resource('besetting-jf', BesettingJFController::class);   // Kelola Besetting JF (Admin Sistem)
Route::resource('pegawai', PegawaiController::class);            // Data Induk Pegawai (Admin OPD)
Route::post('/pegawai/{nip}/nonaktifkan', [PegawaiController::class, 'nonaktifkan'])->name('pegawai.nonaktifkan');
Route::resource('usulan', UsulanController::class);              // Data Usulan (Admin OPD)

// ==================== ROUTE VERIFIKASI USULAN ====================
Route::get('/verifikasi', [VerifikasiController::class, 'index'])->name('verifikasi.index');
Route::get('/verifikasi/{id}', [VerifikasiController::class, 'show'])->name('verifikasi.show');
Route::post('/verifikasi/{id}/berkas', [VerifikasiController::class, 'verifikasiBerkas'])->name('verifikasi.berkas');
Route::post('/verifikasi/{id}/substansi', [VerifikasiController::class, 'verifikasiSubstansi'])->name('verifikasi.substansi');

// ==================== ROUTE BAHAN RAPAT ====================
// Verifikator
Route::get('/bahan-rapat/verifikator', [BahanRapatController::class, 'indexVerifikator'])->name('bahan_rapat.verifikator.index');
Route::get('/bahan-rapat/verifikator/{id}', [BahanRapatController::class, 'showVerifikator'])->name('bahan_rapat.verifikator.show');

// Admin Administrasi
Route::get('/bahan-rapat/admin', [BahanRapatController::class, 'indexAdmin'])->name('bahan_rapat.admin.index');
Route::get('/bahan-rapat/admin/{id}', [BahanRapatController::class, 'showAdmin'])->name('bahan_rapat.admin.show');
Route::post('/bahan-rapat/admin/{id}/approve', [BahanRapatController::class, 'approve'])->name('bahan_rapat.admin.approve');
Route::post('/bahan-rapat/admin/{id}/reject', [BahanRapatController::class, 'reject'])->name('bahan_rapat.admin.reject');

// Download & Update Bahan Rapat
Route::get('/bahan-rapat/{id}/download-draft', [BahanRapatController::class, 'downloadDraft'])->name('bahan_rapat.download_draft');
Route::get('/bahan-rapat/{id}/download-final', [BahanRapatController::class, 'downloadFinal'])->name('bahan_rapat.download_final');
Route::put('/bahan-rapat/{id}/update-kajian', [BahanRapatController::class, 'updateKajian'])->name('bahan_rapat.update_kajian');

// ==================== ROUTE KELOLA SK, RIWAYAT, LOG INTEGRASI ====================
Route::prefix('admin_administrasi')->group(function () {
    // SK (Surat Keputusan)
    Route::get('/sk', [SKController::class, 'index'])->name('sk.index');
    Route::get('/sk/create', [SKController::class, 'create'])->name('sk.create');
    Route::post('/sk', [SKController::class, 'store'])->name('sk.store');
    Route::get('/sk/{id}/edit', [SKController::class, 'edit'])->name('sk.edit');
    Route::put('/sk/{id}', [SKController::class, 'update'])->name('sk.update');
    Route::delete('/sk/{id}', [SKController::class, 'destroy'])->name('sk.destroy');
    Route::post('/sk/{id}/arsipkan', [SKController::class, 'arsipkan'])->name('sk.arsipkan');
    Route::get('/sk/arsip', [SKController::class, 'arsip'])->name('sk.arsip');
    Route::post('/sk/{id}/aktifkan', [SKController::class, 'aktifkan'])->name('sk.aktifkan');
    Route::get('/sk/{id}/download', [SKController::class, 'download'])->name('sk.download');

    // Kirim ke I-MUTASI
    Route::post('/sk/{id}/kirim-imutasi', [SKController::class, 'kirimKeImutasi'])->name('sk.kirim_imutasi');

    // Kirim ke BKN
    Route::post('/sk/{id}/kirim-bkn', [SKController::class, 'kirimKeBkn'])->name('sk.kirim_bkn');

    // Riwayat Usulan & Log Integrasi
    Route::get('/riwayat-usulan', [SKController::class, 'riwayatUsulan'])->name('riwayat.index');
    Route::get('/log-integrasi', [SKController::class, 'logIntegrasi'])->name('log_integrasi.index');
    
    // Laporan Rekapitulasi Usulan
    Route::get('/laporan/rekap-usulan', [LaporanController::class, 'rekapUsulan'])->name('laporan.rekap_usulan');
    Route::get('/laporan/export-csv', [LaporanController::class, 'exportCsv'])->name('laporan.export_csv');
});