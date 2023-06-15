<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\PagesContentController;
use App\Http\Controllers\SiteSettingsController;
use App\Http\Controllers\TaxonomyController;
use App\Http\Controllers\VehicleController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::get('/global/{handle}', [SiteSettingsController::class, 'show']);
Route::get('/taxonomy/{handle}', [TaxonomyController::class, 'index']);

Route::prefix('/vehicles')->group(function () {
    Route::get('/', [VehicleController::class, 'index']);
    Route::get('/recent', [VehicleController::class, 'getRecentVehicles']);
});

Route::post('/contact-form', [ContactController::class, 'store']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
