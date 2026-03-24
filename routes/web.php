<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\InteractionController;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\WorkSchedulesController;

use App\Http\Controllers\QuotesController;
use App\Http\Controllers\ContractsController;
use App\Http\Controllers\InvoicesController;

Route::resource('quotes', QuotesController::class);
Route::resource('contracts', ContractsController::class);
Route::resource('invoices', InvoicesController::class);

Route::get('/pdf/download', [PdfController::class, 'download']);

Route::get('/', function () {
    return view('home');
});
Route::get('/interactions/client/{client_id}', [InteractionController::class, 'byClient'])->name('interactions.byClient');
Route::get('/interactions/create/{client_id}', [InteractionController::class, 'create']);
Route::resource('clients', ClientController::class);
Route::post('/clients/store', [ClientController::class, 'store']);
Route::resource('tickets', TicketController::class);
Route::resource('interactions', InteractionController::class);
Route::get('/quotes/{id}/pdf', [PdfController::class, 'quote'])->name('quotes.pdf');
Route::get('/contracts/{id}/pdf', [PdfController::class, 'contract'])->name('contracts.pdf');
Route::get('/invoices/{id}/pdf', [PdfController::class, 'invoice'])->name('invoices.pdf');
Route::resource('schedules', WorkSchedulesController::class);

Route::resource('schedules', WorkSchedulesController::class);
Route::get('/api/schedules/', [WorkSchedulesController::class, 'getEvents']);Route::get('/api/schedules/', [WorkSchedulesController::class, 'getEvents']);
