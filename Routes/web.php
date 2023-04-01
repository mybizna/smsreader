<?php

use Illuminate\Support\Facades\Route;

Route::post('smsreader/incoming', 'IncomingController@incoming')->name('smsreader_incoming')->withoutMiddleware([\App\Http\Middleware\VerifyCsrfToken::class]);