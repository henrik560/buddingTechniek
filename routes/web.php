<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OccasionsController;
use App\Http\Controllers\SolatubeController;
use App\Http\Controllers\ZonnepanelenController;
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

Route::middleware(['shareStatamicPageContent'])->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('/occasions', [OccasionsController::class, 'index'])->name('occasions');
    Route::get('/occasions/vehicle/{slug}', [OccasionsController::class, 'show'])->name('vehicle-detail');
    Route::get('/solatube', [SolatubeController::class, 'index'])->name('solatube');
    Route::get('/automatisch-ruwvoer', [SolatubeController::class, 'index'])->name('automatisch-ruwvoer');
    Route::get('/zonnepanelen', [ZonnepanelenController::class, 'index'])->name('zonnepanelen');
    Route::get('/contact', [ContactController::class, 'index'])->name('contact');
});
