<?php

use Illuminate\Support\Facades\Route;
use UserNotification\Controllers\NotificationController;

Route::middleware(['web', 'auth'])->group(function () {
    Route::get('notifications', [NotificationController::class, 'index'])->name('notifications.index');
    Route::get('notifications/{notification}', [NotificationController::class, 'show'])->name('notifications.show');
    Route::prefix('api/notifications')->name('api.notifications.')->group(function () {
        Route::post('/', [NotificationController::class, 'store'])->name('store');
        Route::get('/count', [NotificationController::class, 'count'])->name('count');
        Route::get('/mine', [NotificationController::class, 'mine'])->name('mine');
        Route::get('/all', [NotificationController::class, 'all'])->name('all');
        Route::get('/{notification}', [NotificationController::class, 'details'])->name('details');
        Route::post('/{notification}/seen', [NotificationController::class, 'seen'])->name('seen');
        Route::post('/{notification}/archive', [NotificationController::class, 'archive'])->name('archive');
    });
});
