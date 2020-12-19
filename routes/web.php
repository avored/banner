<?php
use Illuminate\Support\Facades\Route;

$baseAdminUrl = config('avored.admin_url');


Route::middleware(['web'])
    ->group(function () {
        Route::get('js/avored-banner-carousel.js', [\AvoRed\Banner\Http\Controllers\BannerController::class, 'frontJS'])
            ->name('avored.banner.js');
    });


Route::middleware(['web', 'auth:admin'])
    ->prefix($baseAdminUrl)
    ->name('admin.')
    ->group(function () {
        Route::resource('banner', \AvoRed\Banner\Http\Controllers\BannerController::class);

        Route::get('banner-js/banner.js', [\AvoRed\Banner\Http\Controllers\BannerController::class, 'adminJS'])
            ->name('banner.js');

        Route::post('banner/upload', [\AvoRed\Banner\Http\Controllers\BannerController::class, 'upload'])
            ->name('banner.upload');
    });
