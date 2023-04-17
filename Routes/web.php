<?php

use Illuminate\Support\Facades\Route;

Route::post('smsreader/incoming', 'IncomingController@incoming')->name('smsreader_incoming')->withoutMiddleware([\App\Http\Middleware\VerifyCsrfToken::class]);
Route::post('smsreader/payment/verification', 'IncomingController@paymentVerification')->name('smsreader_payment_verification');