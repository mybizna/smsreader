<?php

use Illuminate\Support\Facades\Route;

Route::match (['get', 'post'], 'smsreader/incoming', 'IncomingController@incoming')->name('smsreader_incoming')->withoutMiddleware([\App\Http\Middleware\VerifyCsrfToken::class]);
Route::get('smsreader/incoming/processor', 'IncomingController@incomingProcessor')->name('smsreader_incoming_processor');
Route::post('smsreader/payment/verification', 'IncomingController@paymentVerification')->name('smsreader_payment_verification');
