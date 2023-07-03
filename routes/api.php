<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployesController;
use App\Http\Controllers\SkillsController;

/*
 *
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::controller(EmployesController::class)->prefix('employees')->group(function () {
    Route::get('/', 'index');
    Route::post('/', 'store');
    Route::get('/{email}', 'show');
});

Route::controller(SkillsController::class)->prefix('skills')->group(function () {
    Route::get('/', 'index');
});

/*
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
*/