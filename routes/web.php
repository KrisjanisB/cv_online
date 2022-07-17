<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('frontpage');
});

Route::group(['middleware' => 'auth'], function () {

    Route::group(['prefix' => '/dashboard'], function () {
        Route::get('/', function () {
            return view('dashboard');
        })->name('dashboard');


    });

    Route::group(['prefix' => '/profile'], function () {
        Route::resource('/', \App\Http\Controllers\ProfileController::class);

        Route::post('/cv', [\App\Http\Controllers\CVController::class, 'store'])->name('cv.store');
        Route::get('/add-cv', [\App\Http\Controllers\CVController::class,'create'])->name('cv.create');
        Route::get('/cv/{cv}', [\App\Http\Controllers\CVController::class, 'show'])->name('cv.show');


    });




});


require __DIR__ . '/auth.php';
