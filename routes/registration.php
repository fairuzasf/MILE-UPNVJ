<?php

use App\Http\Controllers\EventController;
use App\Http\Controllers\RegistrationController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::get('/kegiatan', [EventController::class, 'index'])->name('events.index');
    Route::post('/kegiatan/{event}/daftar', [RegistrationController::class, 'store'])->name('registrations.store');
    Route::get('/kegiatan-saya', [RegistrationController::class, 'mine'])->name('registrations.mine');
    Route::delete('/kegiatan-saya/{registration}', [RegistrationController::class, 'destroy'])->name('registrations.destroy');
});