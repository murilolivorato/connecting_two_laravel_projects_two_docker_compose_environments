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

Route::get('/list-motos',  [AppController::class, 'listMotos']);
Route::get('/get-list-of-cars-in-laravel-project-two',  [AppController::class, 'getListOfCarsFromLaravelProjectTwo']);
