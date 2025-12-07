<?php

use App\Http\Controllers\authController;
use App\Http\Controllers\categroyController;
use App\Http\Controllers\noteController;
use App\Http\Controllers\profileController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::prefix('/categories')->controller(categroyController::class)->group(function () {
        Route::get('/', 'index')->name('category.index');
        Route::get('/create', 'create')->name('category.create');
        Route::post('/create', 'post');
        Route::get('/edit/{category}', 'edit')->name('category.update');
        Route::patch('/edit/{category}', 'update');
        Route::delete('/category/{category}', 'delete')->name('category.delete');
    });

    Route::controller(noteController::class)->group(function () {
        Route::get('/', 'index')->name('home');

        Route::prefix('/notes')->group(function () {
            Route::get('/', function () {
                return redirect('/');
            });
            Route::get('/create', 'create')->name('note.create');
            Route::post('/create', 'post');
            Route::get('/{note}', 'show')->name('note.show');

            Route::get('/edit/{note}', 'edit')->name('note.edit');
            Route::patch('/edit/{note}', 'update');

            Route::delete('/delete/{note}', 'delete')->name('note.delete');
        });
    });

    Route::prefix('profile')->controller(profileController::class)->group(function () {
        Route::get('/', 'index')->name('profile');

        Route::post('/update-information', 'updateInfo')->name('update.information');
        Route::post('/update-password', 'updatePassword')->name('update.password');
    });

    Route::post('/logout', [authController::class, 'logout'])->name('logout');
});



Route::middleware('guest')->controller(authController::class)->group(function () {
    Route::get('/register', 'index')->name('register');
    Route::post('/register', 'register');

    Route::get('/login', 'render')->name('login');
    Route::post('/login', 'login');
});
