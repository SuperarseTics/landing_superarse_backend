<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Menu\MenuController;
use App\Http\Controllers\Submenu\SubmenuController;
use App\Http\Controllers\SubmenuOptions\SubmenuOptionsController;
use App\Http\Controllers\MenuHeader\MenuHeaderController;
use App\Http\Controllers\Page\PageController;
use App\Http\Controllers\Section\SectionController;
use App\Http\Controllers\Images\ImagesController;
use App\Http\Controllers\Config\ConfigController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| This routes avoid CSRF Token
|
*/

// Auth routes
Route::delete('logout', [AuthController::class, 'logout'])->middleware(['auth:sanctum','checktoken']);
Route::post('login', [AuthController::class, 'authenticate'])->middleware(['guest','throttle:5,1']);
Route::post('register', [AuthController::class, 'register'])->middleware(['guest', 'throttle:5,1']);

// Publics
Route::middleware(['guest','throttle:5,1'])->group(function () {
    Route::group(['prefix' => 'landing'], function () {
        Route::get('/menu', [MenuController::class, 'showAll']);
        Route::get('/menuHeader', [MenuHeaderController::class, 'showAll']);
        Route::get('/page/{code}', [PageController::class, 'showAll']);
    });
});

// Privates
// Route::middleware(['auth:sanctum','checktoken'])->group(function () {
Route::middleware(['guest','throttle:5,1'])->group(function () {

    // Menu Header routes
    Route::group(['prefix' => 'menuHeader'], function () {
        Route::get('/show', [MenuHeaderController::class, 'show']);
        Route::post('/add', [MenuHeaderController::class, 'add']);
        Route::post('/upd', [MenuHeaderController::class, 'update']);
        Route::delete('/{code}', [MenuHeaderController::class, 'destroy']);
    });
    
    // Menu routes
    Route::group(['prefix' => 'menu'], function () {
        Route::get('/show', [MenuController::class, 'show']);
        Route::post('/add', [MenuController::class, 'add']);
        Route::post('/upd', [MenuController::class, 'update']);
        Route::delete('/{code}', [MenuController::class, 'destroy']);
    });

    // Submenu routes
    Route::group(['prefix' => 'submenu'], function () {
        Route::get('/show', [SubmenuController::class, 'show']);
        Route::post('/add', [SubmenuController::class, 'add']);
        Route::post('/upd', [SubmenuController::class, 'update']);
        Route::delete('/{code}', [SubmenuController::class, 'destroy']);
    });

    // Submenu - Options routes
    Route::group(['prefix' => 'submenu-option'], function () {
        Route::get('/show', [SubmenuOptionsController::class, 'show']);
        Route::post('/add', [SubmenuOptionsController::class, 'add']);
        Route::post('/upd', [SubmenuOptionsController::class, 'update']);
        Route::delete('/{code}', [SubmenuOptionsController::class, 'destroy']);
    });

    // Page routes
    Route::group(['prefix' => 'page'], function () {
        Route::get('/show', [PageController::class, 'show']);
        Route::post('/add', [PageController::class, 'add']);
        Route::post('/upd', [PageController::class, 'update']);
        Route::delete('/{code}', [PageController::class, 'destroy']);
    });

    // Sections routes
    Route::group(['prefix' => 'section'], function () {
        Route::get('/show', [SectionController::class, 'show']);
        Route::post('/add', [SectionController::class, 'add']);
        Route::post('/upd', [SectionController::class, 'update']);
        Route::delete('/{code}', [SectionController::class, 'destroy']);
    });

    // Images routes
    Route::group(['prefix' => 'image'], function () {
        Route::get('/show', [ImagesController::class, 'show']);
        Route::post('/add', [ImagesController::class, 'add']);
        Route::delete('/{code}', [ImagesController::class, 'destroy']);
    });

    // Config routes
    Route::group(['prefix' => 'config'], function () {
        Route::get('/show', [ConfigController::class, 'show']);
        Route::post('/add', [ConfigController::class, 'add']);
        Route::post('/upd', [ConfigController::class, 'update']);
        Route::delete('/{code}', [ConfigController::class, 'destroy']);
    });

});

