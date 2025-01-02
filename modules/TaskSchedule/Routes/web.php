<?php

use Illuminate\Support\Facades\Route;
use Modules\TaskSchedule\Controllers\TaskController;

Route::group(
    [
        'prefix' => 'task-schedule',
        'middleware' => ['web', 'auth', 'add-csp-headers', 'logger'],
    ],
    function () {
        Route::get('todo', [TaskController::class, 'index'])->name('todo.index');
        Route::get('todo/create', [TaskController::class, 'create'])->name('todo.create');
        Route::post('todo', [TaskController::class, 'store'])->name('todo.store');
        Route::get('todo/{id}/show', [TaskController::class, 'show'])->name('todo.show');
        Route::get('todo/{id}/edit', [TaskController::class, 'edit'])->name('todo.edit');
        Route::put('todo/{id}/update', [TaskController::class, 'update'])->name('todo.update');
        Route::delete('todo', [TaskController::class, 'destroy'])->name('todo.destroy');
    }
);
