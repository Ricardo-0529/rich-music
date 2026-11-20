<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Public\HomeController;
use App\Http\Controllers\Public\AlbumController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\AlbumController as AdminAlbumController;
use App\Http\Controllers\Admin\TrackController;
use App\Http\Controllers\Admin\MediaLinkController;



Route::get('/', [HomeController::class, 'index'])
    ->name('home');

Route::get('/album/{slug}', [AlbumController::class, 'show'])
    ->name('albums.show');


Route::prefix('admin')
    ->name('admin.')
    ->group(function () {

        // ACCESO

        Route::middleware('guest')->group(function () {

            Route::get('/login', [AuthController::class, 'showLogin'])
                ->name('login');

            Route::post('/login', [AuthController::class, 'login'])
                ->name('login.submit');

        });

        Route::middleware('auth')->group(function () {

            Route::get('/dashboard', function () {
                return view('admin.dashboard');
            })->name('dashboard');

            Route::resource('tracks', TrackController::class)->except(['show']);

            Route::resource('albums', AdminAlbumController::class)
                ->except(['show']);

                Route::resource('media', MediaLinkController::class)
    ->parameters(['media' => 'media'])
    ->except(['show']);

            Route::post('/logout', [AuthController::class, 'logout'])
                ->name('logout');

        });

    });