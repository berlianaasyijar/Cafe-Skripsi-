<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\PointController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\TransactionController;
Route::get('/', function () {
    return view('login.pages-login');
});

// // Auth routes
// Auth::routes();


    // Halaman login
    Route::get('loginAdmin', [AuthController::class, 'showLoginForm'])->name('login');
    Route::get('loginUser', [AuthController::class, 'showLoginUserForm'])->name('login-user');

    // Proses login
    Route::post('loginAdmin', [AuthController::class, 'login'])->name('login.submit');
    Route::post('loginUser', [AuthController::class, 'loginUser'])->name('login.submit-user');

    // Logout
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');


    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register']);

    // Rute yang memerlukan autentikasi
    // Home route
    // Route::middleware('checkLogin')->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('dashboard');

    Route::get('/profil', [HomeController::class, 'profil'])->name('profil');
    // Produk routes
    Route::get('/produk', [ProdukController::class, 'index'])->name('produk.index');
    Route::get('/produk/create', [ProdukController::class, 'create'])->name('produk.create');
    Route::post('/produk', [ProdukController::class, 'store'])->name('produk.store');
    Route::get('/produk/{id}/edit', [ProdukController::class, 'edit'])->name('produk.edit');
    Route::put('/produk/{id}', [ProdukController::class, 'update'])->name('produk.update');
    Route::delete('/produk/{id}', [ProdukController::class, 'destroy'])->name('produk.destroy');

    // Member routes (resource)
    Route::resource('member', MemberController::class);

    // Karyawan routes (resource)
    Route::resource('karyawans', KaryawanController::class);
    Route::get('/menu/{kategori?}', [MenuController::class, 'index'])->name('menu');
    
    Route::get('/transaction', [MenuController::class, 'transaction']);
    Route::get('/payment', [PaymentController::class, 'index']);
    Route::post('/submit-payment', [PaymentController::class, 'submitPayment'])->name('submitPayment');
    Route::get('/thank-you', [PaymentController::class, 'thankYou'])->name('thank-you');

    Route::post('/points', [PointController::class, 'store'])->name('points.store');
    Route::get('/points', [PointController::class, 'index'])->name('points.index');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


Route::get('/transactions', [TransactionController::class, 'index'])->name('transactions.index');
Route::get('/transactions/{id}', [TransactionController::class, 'show'])->name('transactions.show');
Route::post('/transactions/{id}/approve', [TransactionController::class, 'approve'])->name('transactions.approve');

    // });