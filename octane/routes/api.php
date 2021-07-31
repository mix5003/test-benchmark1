<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/hello', [MainController::class, 'hello']);
Route::get('/fibo1', [MainController::class, 'fibo1']);
Route::get('/fibo2', [MainController::class, 'fibo2']);
Route::get('/io', [MainController::class, 'io']);
