<?php

use App\Http\Controllers\QRCodeController;
use Illuminate\Support\Facades\Route;

Route::controller(QRCodeController::class)->group(function () {
    Route::get('/', 'index')->name('qrcode.index');
    Route::post('/generate', 'generate')->name('qrcode.generate');
    Route::get('/download/{filename}', 'download')->name('qrcode.download');
});
