<?php

use App\Http\Controllers\PageController;
use App\Http\Controllers\PdfController;
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

// Route for exercise 3.
Route::get("/zad1/dodajlosowe/{amount}", [PageController::class, "insertRandom"]);
Route::get("/zad1/lista/{phrase}", [PageController::class, "indexByName"]);

// Route for exercise six.
Route::get("/zad6", [PdfController::class, "generate"]);
Route::get("/test", [PageController::class, "test"]);
