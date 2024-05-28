<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InegiController;
use App\Http\Controllers\DenueController;

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
    return view('welcome');
});

Route::get('/inegi/{idIndicador}', [InegiController::class, 'show']);

Route::post('/denue/search', [DenueController::class, 'search'])->name('denue.search');