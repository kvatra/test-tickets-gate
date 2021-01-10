<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'ShowController@getList');

Route::prefix('/shows')
    ->group(function () {
        Route::get('/', 'ShowController@getList');
        Route::get('/{showId}', 'ShowController@getShow');
    });

Route::prefix('/events')
    ->group(function () {
        Route::get('/{eventId}', 'EventController@getPlaces');
        Route::post('/{eventId}', 'EventController@reservePlaces');
    });
