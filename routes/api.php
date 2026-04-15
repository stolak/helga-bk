<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\SubsidiaryApiController;
use App\Http\Controllers\Api\MediaPhotoApiController;
use App\Http\Controllers\Api\MediaVideoApiController;
use App\Http\Controllers\Api\ContactUsApiController;
use App\Http\Controllers\Api\BusinessQuoteApiController;
use App\Http\Controllers\Api\ServicesApiController;
use App\Http\Controllers\Api\AmenitiesApiController;
use App\Http\Controllers\Api\PageBannerApiController;
use App\Http\Controllers\Api\PricingApiController;
use App\Http\Controllers\Api\LandingBannerApiController;

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

// Public read-only services API
Route::get('/services', [ServicesApiController::class, 'index']);

// Public read-only amenities API
Route::get('/amenities', [AmenitiesApiController::class, 'index']);

// Public read-only page banners API
Route::get('/page-banners', [PageBannerApiController::class, 'index']);
Route::get('/page-banners/{id}', [PageBannerApiController::class, 'showById'])->whereNumber('id');

// Public read-only landing banners API (returns all)
Route::get('/landing-banners', [LandingBannerApiController::class, 'index']);

// Public read-only pricing grouped by card position (joins pricing_category + pricing)
Route::get('/pricing-by-cards', [PricingApiController::class, 'groupedByCard']);

// Public contact-us endpoint (stores and queues emails)
Route::post('/contact-us', [ContactUsApiController::class, 'store']);

// Public business quote endpoint (stores quote request)
Route::post('/business-quotes', [BusinessQuoteApiController::class, 'store']);
