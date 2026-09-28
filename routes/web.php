<?php

use App\Livewire\CitizenAccount;
use App\Livewire\CitizenAuth;
use App\Livewire\ComplaintForm;
use App\Livewire\Home;
use App\Livewire\InformationFaq;
use App\Livewire\ServiceCatalog;
use App\Livewire\ServiceDetail;
use App\Livewire\ServiceRequestForm;
use App\Livewire\TrackTicket;
use App\Livewire\VerifyCertificate;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes — Portal Publik SAPA SOSIAL
|--------------------------------------------------------------------------
*/

Route::get('/', Home::class)->name('home');
Route::get('/layanan', ServiceCatalog::class)->name('layanan.index');
Route::get('/layanan/{slug}', ServiceDetail::class)->name('layanan.detail');
Route::get('/pengajuan', ServiceRequestForm::class)->name('pengajuan');
Route::get('/pengaduan', ComplaintForm::class)->name('pengaduan');
Route::get('/cek-status/{ticket?}', TrackTicket::class)->name('cek-status');
Route::get('/verifikasi/{code?}', VerifyCertificate::class)->name('verifikasi');
Route::get('/informasi', InformationFaq::class)->name('informasi');
Route::get('/masuk', CitizenAuth::class)->name('login');
Route::get('/daftar', CitizenAuth::class)->name('register');
Route::get('/akun-saya', CitizenAccount::class)->name('akun-saya');
