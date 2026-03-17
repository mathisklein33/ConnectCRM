<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\TicketController;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('clients', ClientController::class);
Route::resource('tickets', TicketController::class);
