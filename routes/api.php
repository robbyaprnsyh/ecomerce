<?php

use App\Http\Controllers\Api\Auth\LoginController;
use App\Http\Controllers\Api\Auth\LogoutController;
use App\Http\Controllers\Api\Auth\RegisterController;
use App\Http\Controllers\API\KategoriApiController;
use App\Http\Controllers\Api\KeranjangController;
use App\Http\Controllers\Api\ProdukApiController;
use App\Http\Controllers\api\ProdukController;
use App\Http\Controllers\Api\SubKategoriApiController;
use App\Http\Controllers\Api\UserApiController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/register', RegisterController::class)->name('register');
Route::post('/login', LoginController::class)->name('login');

Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('/logout', LogoutController::class)->name('logout');
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
});

Route::prefix('profile')->group(function () {
    Route::get('/', [UserApiController::class, 'index']);
    Route::post('/', [UserApiController::class, 'store']); 
    Route::get('/{id}', [UserApiController::class, 'show']); 
    Route::put('/{id}', [UserApiController::class, 'update']); 
    Route::delete('/{id}', [UserApiController::class, 'destroy']);
});
Route::prefix('subKategori')->group(function () {
    Route::get('/', [SubKategoriApiController::class, 'index']);
    Route::post('/', [SubKategoriApiController::class, 'store']); 
    Route::get('/{id}', [SubKategoriApiController::class, 'show']); 
    Route::put('/{id}', [SubKategoriApiController::class, 'update']); 
    Route::delete('/{id}', [SubKategoriApiController::class, 'destroy']);
});
Route::prefix('kategori')->group(function () {
    Route::get('/', [KategoriApiController::class, 'index']);
    Route::post('/', [KategoriApiController::class, 'store']); 
    Route::get('/{id}', [KategoriApiController::class, 'show']); 
    Route::put('/{id}', [KategoriApiController::class, 'update']); 
    Route::delete('/{id}', [KategoriApiController::class, 'destroy']);
});
Route::prefix('produk')->group(function () {
    Route::get('/', [ProdukApiController::class, 'index']);
    Route::post('/', [ProdukApiController::class, 'store']); 
    Route::get('/{id}', [ProdukApiController::class, 'show']); 
    Route::put('/{id}', [ProdukApiController::class, 'update']); 
    Route::delete('/{id}', [ProdukApiController::class, 'destroy']);
});