<?php

use App\Http\Controllers\api\v1\EventController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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


Route::group(['prefix' => 'v1'], function (){
    Route::group(['namespace' => 'events'], function (){
        Route::get('events', [EventController::class, 'getAllEvents']);
        Route::get('events/active-events', [EventController::class, 'getActiveEvents']);
        Route::get('events/{id}', [EventController::class, 'getEvent']);
        Route::post('events', [EventController::class, 'createEvent']);
        Route::put('events/{id}', [EventController::class, 'updateOrCreateEvent']);
        Route::patch('events/{id}', [EventController::class, 'updateEvent']);
        Route::delete('events/{id}', [EventController::class, 'deleteEvent']);
    });
});
