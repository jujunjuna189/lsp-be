<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

// Customer
Route::group(['prefix' => 'v1'], function ($router) {
    // Auth
    Route::post('login', [App\Http\Controllers\Api\v1\Auth\AuthController::class, 'login']);
    Route::post('register', [App\Http\Controllers\Api\v1\Auth\AuthController::class, 'register']);

    Route::group(['prefix' => 'schema'], function ($router) {
        Route::get('/', [App\Http\Controllers\Api\v1\Schema\SchemaController::class, 'show']);
        Route::get('/detail', [App\Http\Controllers\Api\v1\Schema\SchemaController::class, 'detail']);
        Route::post('/create', [App\Http\Controllers\Api\v1\Schema\SchemaController::class, 'create']);

        Route::group(['prefix' => 'unit'], function ($router) {
            Route::get('/', [App\Http\Controllers\Api\v1\Schema\SchemaUnitController::class, 'show']);
            Route::post('/create', [App\Http\Controllers\Api\v1\Schema\SchemaUnitController::class, 'create']);
        });

        Route::group(['prefix' => 'assesment'], function ($router) {
            Route::get('/', [App\Http\Controllers\Api\v1\Schema\SchemaAssesmentController::class, 'show']);
        });

        Route::group(['prefix' => 'registrant'], function ($router) {
            Route::get('/', [App\Http\Controllers\Api\v1\Schema\SchemaRegistrantController::class, 'show']);
            Route::get('/detail', [App\Http\Controllers\Api\v1\Schema\SchemaRegistrantController::class, 'detail']);
            Route::post('/create', [App\Http\Controllers\Api\v1\Schema\SchemaRegistrantController::class, 'create']);
        });
    });
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
