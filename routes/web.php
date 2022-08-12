<?php

use App\Http\Controllers\web\EventController;
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

Route::group(['namespace' => 'events'], function () {
    Route::get('events', [EventController::class, 'getPaginatedEvents']);
    Route::get('events/{id}', [EventController::class, 'getEvent']);
    Route::get('event/create', [EventController::class, 'getEventCreatePage']);
    Route::post('events/create', [EventController::class, 'createEvent'])->name('events.create');
    Route::get('events/{id}/edit', [EventController::class, 'getEventEditPage']);
    Route::patch('events-edit/{id}', [EventController::class, 'editEvent'])->name('events.edit');
    Route::delete('events-delete/{id}', [EventController::class, 'deleteEvent'])->name('events.delete');
});
