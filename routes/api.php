<?php
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\v1\UserController;
use App\Http\Controllers\Api\v1\RoleController;
use App\Http\Controllers\Api\v1\PermissionController;

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

Route::middleware('auth:sanctum')->group(function () {
    // do some logic...
});

Route::prefix('users')->group(function () {
    Route::get('/',         [UserController::class, 'index']);
    Route::get('/{id}',     [UserController::class, 'read']);
    Route::post('/create',  [UserController::class, 'create']);
    Route::patch('/{id}',   [UserController::class, 'update']);
    Route::delete('/{id}',  [UserController::class, 'delete']);
});

Route::prefix('roles')->group(function () {
    Route::get('/',         [RoleController::class, 'index']);
    Route::get('/{id}',     [RoleController::class, 'read']);
    Route::post('/create',  [RoleController::class, 'create']);
    Route::patch('/{id}',   [RoleController::class, 'update']);
    Route::delete('/{id}',  [RoleController::class, 'delete']);
});

Route::prefix('permissions')->group(function () {
    Route::get('/',         [PermissionController::class, 'index']);
    Route::get('/{id}',     [PermissionController::class, 'read']);
    Route::post('/create',  [PermissionController::class, 'create']);
    Route::patch('/{id}',   [PermissionController::class, 'update']);
    Route::delete('/{id}',  [PermissionController::class, 'delete']);
});
