<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\VillaController;
use App\Http\Controllers\api\SubCategoryController;

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

// Route::get('idealis/index', [VillaController::class, 'idealis']);
Route::get('detail/{id_villa}', [VillaController::class, 'idealisDetail']);
Route::get('rekomendasi', [VillaController::class, 'idealisRekomendasi']);
Route::get('idealis/blok/{id}', [VillaController::class, 'idealisDetailBlok']);
Route::get('blok', [SubCategoryController::class, 'index']);
