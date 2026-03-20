<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\InteractionController;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\WorkSchedulesController;


Route::get('/pdf/download', [PdfController::class, 'download']);

Route::get('/', function () {
    return view('welcome');
});
Route::get('/interactions/client/{client_id}', [InteractionController::class, 'byClient'])->name('interactions.byClient');
Route::get('/interactions/create/{client_id}', [InteractionController::class, 'create']);
Route::resource('clients', ClientController::class);
Route::post('/clients/store', [ClientController::class, 'store']);
Route::resource('tickets', TicketController::class);
Route::resource('interactions', InteractionController::class);
Route::resource('schedules', WorkSchedulesController::class);

Route::resource('schedules', WorkSchedulesController::class);
Route::get('/api/schedules/', [WorkSchedulesController::class, 'getEvents']);Route::get('/api/schedules/', [WorkSchedulesController::class, 'getEvents']);
