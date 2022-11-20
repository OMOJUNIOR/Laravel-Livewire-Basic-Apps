<?php

use App\Http\Controllers\ConvertXmlController;
use App\Http\Controllers\RsaController;
use Illuminate\Support\Facades\Route;

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


/*
|--------------------------------------------------------------------------
| Public Routes 
|--------------------------------------------------------------------------
*/


Route::get('/', function () {
    return view('send');
})->name('send');

Route::get('/upload', function () {
    return view('upload');
})->name('upload');
