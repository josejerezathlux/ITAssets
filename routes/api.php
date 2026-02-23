<?php

use App\Http\Controllers\Api\V1\AssetApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('v1')->middleware('auth:sanctum')->group(function () {
    Route::get('assets', [AssetApiController::class, 'index']);
    Route::post('assets', [AssetApiController::class, 'store']);
    Route::get('assets/{asset}', [AssetApiController::class, 'show']);
    Route::put('assets/{asset}', [AssetApiController::class, 'update']);
    Route::patch('assets/{asset}', [AssetApiController::class, 'update']);
    Route::delete('assets/{asset}', [AssetApiController::class, 'destroy']);
    Route::post('assets/{asset}/assign', [AssetApiController::class, 'assign']);
    Route::post('assets/{asset}/unassign', [AssetApiController::class, 'unassign']);
});
