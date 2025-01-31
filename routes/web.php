<?php

use Illuminate\Support\Facades\Route;
use Modules\Smsreader\Http\Controllers\IncomingController;

Route::match(['get', 'post'], 'smsreader/incoming', [IncomingController::class, 'incoming'])->name('smsreader_incoming')->withoutMiddleware([\App\Http\Middleware\VerifyCsrfToken::class]);
Route::get('smsreader/incoming/processor', [IncomingController::class, 'incomingProcessor'])->name('smsreader_incoming_processor');
Route::post('smsreader/payment/verification', [IncomingController::class, 'paymentVerification'])->name('smsreader_payment_verification');
