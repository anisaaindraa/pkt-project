<?php

use App\Http\Controllers\FormulirPatroliLaut;
use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FormulirPatroliLautController;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');
});

Route::get('/datatable', [DashboardController::class, 'dataTable'])->name('datatable');
Route::get('/patroli', [DashboardController::class, 'dataPatroli'])->name('datapatroli');

// User Controller
Route::get('/createusers', [UserController::class, 'create'])->name('create.users.page')->middleware(['auth']);
Route::post('/createusers', [UserController::class, 'store'])->name('users.store');
Route::get('users/{id}/edit', [UserController::class, 'edit'])->name('users.edit')->middleware(['auth']);
Route::put('users/{id}', [UserController::class, 'update'])->name('users.update')->middleware(['auth']);
// Route::delete('/users/{id}', 'UserController@destroy')->name('users.destroy');
Route::get('test', function () {
    $key = 'example_key';
    $payload = [
        'iss' => 'test@gmail.com',
        'exp' => time() + 3600
    ];
    $jwt = JWT::encode($payload, $key, 'HS256');
    $decoded = JWT::decode($jwt, new Key($key, 'HS256'));
    dd($decoded);
});


require __DIR__ . '/auth.php';
