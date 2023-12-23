<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AppController;
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

Route::get('/list-cars',  [AppController::class, 'listCars']);
Route::get('/get-list-of-motos-in-laravel-project-one',  [AppController::class, 'getListOfMotosFromLaravelProjectOne']);
