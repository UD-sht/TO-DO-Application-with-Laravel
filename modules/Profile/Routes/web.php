<?php

namespace Modules\Profile\Routes;

use Illuminate\Support\Facades\Route;
use Modules\Profile\Controllers\ProfileController;

Route::group([
    'prefix' => 'profile',
    'middleware' => ['web', 'auth', 'add-csp-headers', 'logger'],
], function () {
    Route::get('/', [ProfileController::class,'index'])->name('profile.index');
    Route::put('/{user}/update', [ProfileController::class,'update'])->name('profile.update');
});
