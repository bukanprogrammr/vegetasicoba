<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KecController;
use App\Http\Controllers\LevController;
use App\Http\Controllers\WebController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VegeController;
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

Route::get('/', [WebController::class, 'index']);

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

// kecamatan
Route::get('/kecamatan', [KecController::class, 'index'])->name('kecamatan');
Route::get('/kecamatan/create', [KecController::class, 'create']);
Route::post('/kecamatan/input', [KecController::class, 'input']);
Route::get('/kecamatan/edit/{id_kec}', [KecController::class, 'edit']);
Route::post('/kecamatan/update/{id_kec}', [KecController::class, 'update']);
Route::get('/kecamatan/delete/{id_kec}', [KecController::class, 'delete']);

// level
Route::get('/level', [LevController::class, 'index'])->name('level');
Route::get('/level/create', [LevController::class, 'create']);
Route::post('/level/input', [LevController::class, 'input']);
Route::get('/level/edit/{id_level}', [LevController::class, 'edit']);
Route::post('/level/update/{id_level}', [LevController::class, 'update']);
Route::get('/level/delete/{id_level}', [LevController::class, 'delete']);

// sawah
Route::get('/sawah', [VegeController::class, 'index'])->name('sawah');
Route::get('/sawah/create', [VegeController::class, 'create']);
Route::post('/sawah/input', [VegeController::class, 'input']);
Route::get('/sawah/edit/{id_level}', [VegeController::class, 'edit']);
Route::post('/sawah/update/{id_level}', [VegeController::class, 'update']);
Route::get('/sawah/delete/{id_level}', [VegeController::class, 'delete']);

// user
Route::get('/user', [UserController::class, 'index'])->name('user');
Route::get('/user/create', [UserController::class, 'create']);
Route::post('/user/input', [UserController::class, 'input']);
Route::get('/user/edit/{id_level}', [UserController::class, 'edit']);
Route::post('/user/update/{id_level}', [UserController::class, 'update']);
Route::get('/user/delete/{id_level}', [UserController::class, 'delete']);


//frontend
Route::get('/kecamatan/{id_kec}', [WebController::class, 'main2']);
Route::get('/level/{id_level}', [WebController::class, 'main3']);
Route::get('/detail/{id_vegetasi}', [WebController::class, 'detail']);
