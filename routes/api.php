<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FormulirPatroliLautController;
use App\Http\Controllers\DashboardController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::get('/datatable', [DashboardController::class, 'dataTable'])->name('datatable');
// User
Route::get('/users', [UserController::class, 'index']);
// Mendapatkan satu pengguna berdasarkan ID
Route::get('/users/{id}', [UserController::class, 'show']);
// Membuat pengguna baru
Route::post('/users', [UserController::class, 'store']);
// Mengupdate pengguna berdasarkan ID
Route::put('/users/{id}', [UserController::class, 'update']);
// Menghapus pengguna berdasarkan ID
Route::delete('/users/{id}', [UserController::class, 'destroy']);

//Formulir Patroli Laut
// Formulir Patroli Laut
Route::get('/formulir-patroli-laut', [FormulirPatroliLautController::class, 'index']);
// Mendapatkan satu formulir patroli laut berdasarkan ID
Route::get('/formulir-patroli-laut/{id}', [FormulirPatroliLautController::class, 'show']);
// Membuat formulir patroli laut baru
Route::post('/formulir-patroli-laut', [FormulirPatroliLautController::class, 'store']);
// Mengupdate formulir patroli laut berdasarkan ID
Route::put('/formulir-patroli-laut/{id}', [FormulirPatroliLautController::class, 'update']);
// Menghapus formulir patroli laut berdasarkan ID
Route::delete('/formulir-patroli-laut/{id}', [FormulirPatroliLautController::class, 'destroy']);
