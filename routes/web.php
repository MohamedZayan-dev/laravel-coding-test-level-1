<?php

use App\Http\Controllers\web\EventController;
use App\Http\Controllers\web\LoginController;
use App\Http\Controllers\web\LogoutController;
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
Route::get('/', [EventController::class, 'getPaginatedEvents']);

Route::get('login', function () {
    return view('login');
})->name('login');

Route::post('login', [LoginController::class, 'authenticate'])->name('web.login');
Route::get('logout', [LogoutController::class, 'logout'])->middleware('auth')->name('web.logout');

Route::group(['namespace' => 'events'], function () {
    Route::get('events', [EventController::class, 'getPaginatedEvents']);
    Route::get('events/{id}', [EventController::class, 'getEvent']);

    Route::group(['middleware' => 'auth'], function () {
        Route::get('event/create', [EventController::class, 'getEventCreatePage']);
        Route::post('events/create', [EventController::class, 'createEvent'])->name('events.create');
        Route::get('events/{id}/edit', [EventController::class, 'getEventEditPage']);
        Route::patch('events-edit/{id}', [EventController::class, 'editEvent'])->name('events.edit');
        Route::delete('events-delete/{id}', [EventController::class, 'deleteEvent'])->name('events.delete');
    });
});
