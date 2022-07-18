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

Route::get('/', \App\Http\Controllers\FrontpageController::class)->name('frontpage');
Route::get('/cv/{cv}', [\App\Http\Controllers\CVController::class, 'show'])->name('public.cv.show');
Route::get('/cv/{cv}/print', [\App\Http\Controllers\CVController::class, 'print'])->name('print');

Route::group(['middleware' => 'auth'], function () {

    Route::group(['prefix' => '/dashboard'], function () {
        Route::get('/', \App\Http\Controllers\DashboardController::class)->name('dashboard');

    });

    Route::group(['prefix' => '/profile'], function () {
        Route::resource('/', \App\Http\Controllers\ProfileController::class);

        Route::post('/cv', [\App\Http\Controllers\CVController::class, 'store'])->name('cv.store');
        Route::delete('/cv/{cv}', [\App\Http\Controllers\CVController::class, 'destroy'])->name('cv.delete');
        Route::get('/add-cv', [\App\Http\Controllers\CVController::class,'create'])->name('cv.create');
        Route::get('/cv/{cv}/edit', [\App\Http\Controllers\CVController::class,'edit'])->name('cv.edit');
        Route::get('/cv/{cv}', [\App\Http\Controllers\CVController::class, 'show'])->name('cv.show');
        Route::put('/cv/{cv}', [\App\Http\Controllers\CVController::class, 'update'])->name('cv.update');
        Route::patch('/cv/{cv}', [\App\Http\Controllers\CVController::class, 'update'])->name('cv.update-published');


    });




});


require __DIR__ . '/auth.php';
