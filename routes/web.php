<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\InteractionController;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\WorkSchedulesController;
use App\Http\Controllers\DemandeClientController;
use App\Http\Controllers\EventController;
// On groupe toutes les routes de demandes sous le middleware 'auth'
Route::middleware('auth')->group(function () {
Route::get('/pdf/download', [PdfController::class, 'download']);

Route::get('/', function () {
    return view('welcome');
});
Route::get('/interactions/client/{client_id}', [InteractionController::class, 'byClient'])->name('interactions.byClient');
Route::get('/interactions/create/{client_id}', [InteractionController::class, 'create']);
Route::resource('clients', ClientController::class);
Route::resource('tickets', TicketController::class);
Route::resource('interactions', InteractionController::class);
Route::resource('schedules', WorkSchedulesController::class);
Route::resource('demandes', DemandeClientController::class);
Route::get('/demandes/show/{id}', [DemandeClientController::class, 'show'])->name('demandes.show');
Route::get('/demandes/assignation/{id}', [DemandeClientController::class, 'assignation'])->name('demandes.assignation');
Route::patch('/demandes/assignation/{id}', [DemandeClientController::class, 'storeAssignation'])->name('demandes.storeAssignation');
Route::get('/schedules', [WorkSchedulesController::class, 'index'])->name('schedules.index');
Route::get('/api/schedules/', [WorkSchedulesController::class, 'getEvents']);
Route::post('/schedules/store', [WorkSchedulesController::class, 'store']);
Route::get('/demandes/edit/{id}', [DemandeClientController::class, 'edit'])->name('demandes.edit');

        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
// Les routes de Breeze (login/register) sont ajoutées automatiquement ici :
require __DIR__.'/auth.php';
