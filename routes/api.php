<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\TacheController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::controller(AuthController::class)->group(function () {
    Route::post('/register', 'register');
    Route::post('/login', 'login')->name('login');
    Route::post('/deconnexion', 'deconnexion');
});

Route::prefix('v1')->middleware('auth:sanctum')->group(function () {
    Route::controller(TacheController::class)->group(function () {
        Route::get('/tache', 'index')->name('tache.index');
        Route::get('/tache/{tache}', 'show')->name('tache.show');
        Route::post('/tache/store', 'store')->name('tache.store');
        Route::put('/tache/{tache}', 'update')->name('tache.update');
        Route::delete('/tache/{tache}', 'delete')->name('tache.delete');
    });
});
