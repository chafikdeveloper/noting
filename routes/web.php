<?php

use App\Http\Controllers\authController;
use App\Http\Controllers\categroyController;
use App\Http\Controllers\profileController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function() {
    Route::get('/', function () {
        return inertia('home');
    })->name('home');

    Route::prefix('/categories')->controller(categroyController::class)->group(function() {
        Route::get('/', 'index')->name('category.index');
        Route::get('/create', 'create')->name('category.create');        
        Route::post('/create', 'post');
        Route::get('/update/${category}', 'edit')->name('category.update');
        Route::patch('/update/${category}', 'update');
        Route::delete('/category/${category}', 'delete')->name('category.delete');
    });
    
    Route::get('/create-note', function () {
        return inertia('create-note');
    })->name('create-note');

    Route::prefix('profile')->controller(profileController::class)->group(function() {
        Route::get('/', 'index')->name('profile');

        Route::post('/update-information', 'updateInfo')->name('update.information');
        Route::post('/update-password', 'updatePassword')->name('update.password');
    });

    Route::post('/logout', [authController::class, 'logout'])->name('logout');
    
});



Route::middleware('guest')->controller(authController::class)->group(function() {
    Route::get('/register', 'index')->name('register');
    Route::post('/register', 'register');

    Route::get('/login', 'render')->name('login');
    Route::post('/login', 'login');
});