<?php

use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum'])->group(callback: function () {


    Route::get('/drivers',[UserController::class,'index'])->name('admin.drivers');
    Route::delete('/drivers/{id}',[UserController::class,'destroy'])->name('admin.driver.destroy');
    Route::post('/drivers/search',[UserController::class,'search'])->name('admin.driver.destroy');









});

