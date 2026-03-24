<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\InteractionController;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\WorkSchedulesController;
use App\Http\Controllers\DemandeClientController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\QuotesController;
use App\Http\Controllers\ContractsController;
use App\Http\Controllers\InvoicesController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OpportunityController;

use App\Http\Controllers\InvoiceController;

// On groupe toutes les routes de demandes sous le middleware 'auth'
Route::middleware('auth')->group(function () {

    Route::get('/invoices/create', [InvoiceController::class, 'create'])->name('invoices.create');
    Route::post('/invoices', [InvoiceController::class, 'store'])->name('invoices.store');

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
  Route::resource('quotes', QuotesController::class);
Route::resource('contracts', ContractsController::class);
Route::resource('invoices', InvoicesController::class);
Route::resource('schedules', WorkSchedulesController::class);
Route::resource('demandes', DemandeClientController::class);
Route::resource('produits', ProductController::class);

Route::get('/demandes/show/{id}', [DemandeClientController::class, 'show'])->name('demandes.show');
Route::get('/demandes/assignation/{id}', [DemandeClientController::class, 'assignation'])->name('demandes.assignation');
Route::patch('/demandes/assignation/{id}', [DemandeClientController::class, 'storeAssignation'])->name('demandes.storeAssignation');
Route::get('/schedules', [WorkSchedulesController::class, 'index'])->name('schedules.index');
Route::get('/api/schedules/', [WorkSchedulesController::class, 'getEvents']);
Route::post('/schedules/store', [WorkSchedulesController::class, 'store']);
Route::get('/demandes/edit/{id}', [DemandeClientController::class, 'edit'])->name('demandes.edit');
        Route::resource('products', ProductController::class);
        Route::get('/products/show/{id}', [ProductController::class, 'show'])->name('product.show');
    Route::get('/products/edit/{id}', [ProductController::class, 'show'])->name('product.show');

        // Actions du Commercial
        Route::patch('/opportunity/stage/{id}', [OpportunityController::class, 'updateStage']); // Faire progresser le cycle
        Route::get('/opportunity/show/{id}', [OpportunityController::class, 'show'])->name('opportunity.show');

        // Actions spécifiques pour le Chef d'Équipe
        Route::get('/team-tracking', [OpportunityController::class, 'teamIndex']); // Suivre toute son équipe

        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/dashboard', function () {
        return view('home');
    })->name('dashboard');
});
// Les routes de Breeze (login/register) sont ajoutées automatiquement ici :
require __DIR__.'/auth.php';
