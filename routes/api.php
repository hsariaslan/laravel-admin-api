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
    Route::get('/',             [UserController::class, 'index']);
    Route::get('/{user}',       [UserController::class, 'show']);
    Route::post('/create',      [UserController::class, 'store']);
    Route::patch('/{user}',     [UserController::class, 'update']);
    Route::delete('/{user}',    [UserController::class, 'delete']);
});

Route::prefix('roles')->group(function () {
    Route::get('/',             [RoleController::class, 'index']);
    Route::get('/{role}',       [RoleController::class, 'show']);
    Route::post('/create',      [RoleController::class, 'store']);
    Route::patch('/{role}',     [RoleController::class, 'update']);
    Route::delete('/{role}',    [RoleController::class, 'delete']);
});

Route::prefix('permissions')->group(function () {
    Route::get('/',                 [PermissionController::class, 'index']);
    Route::get('/{permission}',     [PermissionController::class, 'show']);
    Route::post('/create',          [PermissionController::class, 'store']);
    Route::patch('/{permission}',   [PermissionController::class, 'update']);
    Route::delete('/{permission}',  [PermissionController::class, 'delete']);
});
