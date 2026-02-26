<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\SubsidiaryApiController;
use App\Http\Controllers\Api\MediaPhotoApiController;
use App\Http\Controllers\Api\MediaVideoApiController;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// Public read-only subsidiary API (includes activities)
Route::get('/subsidiaries', [SubsidiaryApiController::class, 'index']);
Route::get('/subsidiaries/{id}', [SubsidiaryApiController::class, 'showById'])->whereNumber('id');
Route::get('/subsidiaries/slug/{slug}', [SubsidiaryApiController::class, 'showBySlug']);

// Public read-only media photos API
Route::get('/media-photos', [MediaPhotoApiController::class, 'index']);
Route::get('/media-photos/{id}', [MediaPhotoApiController::class, 'showById'])->whereNumber('id');
Route::get('/media-photos/category/{categoryId}', [MediaPhotoApiController::class, 'byCategory'])->whereNumber('categoryId');
Route::get('/media-photos/grouped-by-category', [MediaPhotoApiController::class, 'groupedByCategory']);

// Public read-only media videos API
Route::get('/media-videos', [MediaVideoApiController::class, 'index']);
Route::get('/media-videos/{id}', [MediaVideoApiController::class, 'showById'])->whereNumber('id');
