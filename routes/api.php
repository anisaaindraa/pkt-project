<?php

use App\Http\Controllers\APIController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\FormulirPelaksanaanTugasController;
use App\Http\Controllers\FormulirPelaporanKejadianController;
use App\Models\FormulirPelaksanaanTugas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FormulirPatroliLautController;
use App\Http\Controllers\DashboardController;
use App\Http\Middleware\AuthAPI;

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
Route::post('/login', [APIController::class, 'login']);

Route::middleware(['auth.api'])->group(function () {
    Route::get('example', function () {
        return 'Hello, login passed!';
    });
<<<<<<< HEAD
    Route::post('formpatrolilaut', [APIController::class, 'createFormulirPatroliLaut']);
    Route::post('formpelaporankejadian', [APIController::class, 'createFormulirPelaporanKejadian']);
=======
    Route::get('getuserid', [APIController::class, 'getUserId']);
>>>>>>> fixing-bug
});
Route::post('formpatrolilaut', [APIController::class, 'createFormulirPatroliLaut']);
Route::post('formpelaporankejadian', [APIController::class, 'createFormulirPelaporanKejadian']);
Route::get('getformpelaporankejadian/{id}', [APIController::class, 'getFormulirPelaporanKejadianById']);
Route::get('getformpatrolilaut/{id}', [APIController::class, 'getFormulirPatroliLautById']);

