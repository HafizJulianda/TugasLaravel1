<?php
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\ProfileController; // Make sure this is included
use Illuminate\Support\Facades\Route;

// Home route to show the login page
Route::get('/', function () {
    return view('login'); 
});

// Authentication routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'postLogin'])->name('postLogin');

// Route for listing and searching barang
Route::get('/daftarbarang', [BarangController::class, 'daftarbarang'])->name('daftarbarang');
Route::get('/barang/tambah', [BarangController::class, 'create'])->name('barang.tambah');
Route::post('/barang', [BarangController::class, 'store'])->name('barang.store');
Route::get('/profile', [ProfileController::class, 'show'])->name('profile');

// Untuk Delet
Route::get('/barang/{idBarang}/{id}', [BarangController::class, 'delete'])->name('barang.hapus');

// Change the route for editing a barang
// Rute
Route::get('/barang/ubah/{idBarang}/{id}', [BarangController::class, 'edit'])->name('barang.ubah');
Route::post('/barang/ubah/{idBarang}/{id}', [BarangController::class, 'update'])->name('barang.update');








    