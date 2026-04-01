<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\InteractionController;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\WorkSchedulesController;
use App\Http\Controllers\DemandeClientController;
use App\Http\Controllers\QuotesController;
use App\Http\Controllers\ContractsController;
use App\Http\Controllers\InvoicesController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OpportunityController;
use App\Http\Controllers\InternalCollaborationController;
use App\Http\Controllers\SalesStatisticsController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\SaveFileController;
use App\Http\Controllers\UserManagementController;
use App\Http\Controllers\RoleManagementController;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/dashboard', function () {
    return view('home');
})->name('dashboard');


// Logout
Route::get('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout.get');
Route::middleware('auth')->group(function () {

    /*
    |--------------------------------------------------------------------------
    | Tickets
    |--------------------------------------------------------------------------
    */
    Route::get('/tickets/historique', [TicketController::class, 'historique'])->name('tickets.historique');
    Route::get('/mes-tickets', [TicketController::class, 'mesTickets'])->name('tickets.mine');
    Route::post('/tickets/{ticket}/take', [TicketController::class, 'take'])->name('tickets.take');
    Route::post('/tickets/{ticket}/resolve', [TicketController::class, 'resolve'])->name('tickets.resolve');
    Route::post('/tickets/{ticket}/transfer', [TicketController::class, 'transfer'])->name('tickets.transfer');

    /*
    |--------------------------------------------------------------------------
    | Admin
    |--------------------------------------------------------------------------
    */
    Route::middleware('role:admin')->group(function () {
        Route::resource('clients', ClientController::class);
        Route::resource('tickets', TicketController::class);
        Route::resource('quotes', QuotesController::class);
        Route::resource('contracts', ContractsController::class);
        Route::resource('invoices', InvoicesController::class);
        Route::resource('schedules', WorkSchedulesController::class);
        Route::resource('demandes', DemandeClientController::class);
        Route::resource('products', ProductController::class);
        Route::resource('team', TeamController::class);
    });

    /*
    |--------------------------------------------------------------------------
    | Manager
    |--------------------------------------------------------------------------
    */
    Route::middleware('role:manager')->group(function () {
        Route::get('/team/manage/{id}', [TeamController::class, 'manage'])->name('team.manage');
        Route::post('/team/add-user/', [TeamController::class, 'addUser'])->name('team.add-user');
        Route::post('/team/update-role/{id}', [TeamController::class, 'updateRole'])->name('team.update-role');
        Route::delete('/team/remove-user/{id}', [TeamController::class, 'removeUser'])->name('team.remove-user');
    });

    /*
    |--------------------------------------------------------------------------
    | Commercial
    |--------------------------------------------------------------------------
    */
    Route::middleware('role:commercial')->group(function () {
        Route::resource('opportunity', OpportunityController::class);
        Route::patch('/opportunity/stage/{id}', [OpportunityController::class, 'updateStage'])->name('opportunity.updateStage');
        Route::get('/clients/edit/{id}', [ClientController::class, 'edit'])->name('clients.edit');

        Route::resource('interactions', InteractionController::class);
        Route::get('/interactions/client/{client_id}', [InteractionController::class, 'byClient'])->name('interactions.byClient');
        Route::get('/interactions/create/{client_id}', [InteractionController::class, 'create']);
        Route::resource('orders', OrdersController::class);
        Route::resource('demandes', DemandeClientController::class);
        Route::resource('products', ProductController::class);
        Route::get('/interactions/create/{client_id}', [InteractionController::class, 'create'])->name('interactions.create.byClient');

        Route::resource('demandes', DemandeClientController::class)->except(['show', 'edit']);
        Route::resource('products', ProductController::class)->except(['show', 'edit']);
    });

    /*
    |--------------------------------------------------------------------------
    | Commun
    |--------------------------------------------------------------------------
    */
    Route::resource('internal-collaboration', InternalCollaborationController::class)
        ->names('internal-collaboration');

    Route::resource('sales_statistics', SalesStatisticsController::class)->only(['index']);

    /*
    |--------------------------------------------------------------------------
    | Documents partagés
    |--------------------------------------------------------------------------
    */
    Route::get('/documents', [SaveFileController::class, 'index'])->name('save-files.index');
    Route::get('/documents/create', [SaveFileController::class, 'form'])->name('save-files.create');
    Route::post('/documents', [SaveFileController::class, 'store'])->name('save-files.store');
    Route::get('/documents/{id}', [SaveFileController::class, 'show'])->name('save-files.show');
    Route::get('/documents/{id}/edit', [SaveFileController::class, 'edit'])->name('save-files.edit');
    Route::put('/documents/{id}', [SaveFileController::class, 'update'])->name('save-files.update');
    Route::delete('/documents/{id}', [SaveFileController::class, 'destroy'])->name('save-files.destroy');
    Route::get('/documents/{id}/download', [SaveFileController::class, 'download'])->name('save-files.download');
    Route::post('/documents/{id}/toggle-share', [SaveFileController::class, 'toggleShare'])->name('save-files.toggle-share');
    Route::get('/shared/{token}', [SaveFileController::class, 'shared'])
        ->name('save-files.shared');

    Route::get('/shared/{token}/download', [SaveFileController::class, 'sharedDownload'])
        ->name('save-files.shared.download');

    /*
    |--------------------------------------------------------------------------
    | PDF
    |--------------------------------------------------------------------------
    */
    Route::get('/pdf/download', [PdfController::class, 'download'])->name('pdf.download');
    Route::get('/quotes/{id}/pdf', [PdfController::class, 'quote'])->name('quotes.pdf');
    Route::get('/contracts/{id}/pdf', [PdfController::class, 'contract'])->name('contracts.pdf');
    Route::get('/invoices/{id}/pdf', [PdfController::class, 'invoice'])->name('invoices.pdf');

    /*
    |--------------------------------------------------------------------------
    | Demandes
    |--------------------------------------------------------------------------
    */
    Route::get('/demandes/assignation/{id}', [DemandeClientController::class, 'assignation'])->name('demandes.assignation');
    Route::patch('/demandes/assignation/{id}', [DemandeClientController::class, 'storeAssignation'])->name('demandes.storeAssignation');

    /*
    |--------------------------------------------------------------------------
    | Schedules
    |--------------------------------------------------------------------------
    */
    Route::get('/api/schedules', [WorkSchedulesController::class, 'getEvents'])->name('schedules.events');
    Route::post('/schedules/store', [WorkSchedulesController::class, 'store'])->name('schedules.store');

    /*
    |--------------------------------------------------------------------------
    | Profile
    |--------------------------------------------------------------------------
    */
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    /*
       |--------------------------------------------------------------------------
       | Utilisateur gestion
       |--------------------------------------------------------------------------
       */
    Route::middleware('role:admin')->group(function () {
        Route::resource('clients', ClientController::class);
        Route::resource('tickets', TicketController::class);
        Route::resource('quotes', QuotesController::class);
        Route::resource('contracts', ContractsController::class);
        Route::resource('invoices', InvoicesController::class);
        Route::resource('schedules', WorkSchedulesController::class);
        Route::resource('demandes', DemandeClientController::class);
        Route::resource('products', ProductController::class);
        Route::resource('team', TeamController::class);

        Route::get('/admin/users', [UserManagementController::class, 'index'])->name('admin.users.index');
        Route::get('/admin/users/create', [UserManagementController::class, 'create'])->name('admin.users.create');
        Route::post('/admin/users', [UserManagementController::class, 'store'])->name('admin.users.store');
        Route::get('/admin/users/{id}/edit', [UserManagementController::class, 'edit'])->name('admin.users.edit');
        Route::put('/admin/users/{id}', [UserManagementController::class, 'update'])->name('admin.users.update');
        Route::delete('/admin/users/{id}', [UserManagementController::class, 'destroy'])->name('admin.users.destroy');

        Route::get('/admin/roles', [RoleManagementController::class, 'index'])->name('admin.roles.index');
        Route::get('/admin/roles/create', [RoleManagementController::class, 'create'])->name('admin.roles.create');
        Route::post('/admin/roles', [RoleManagementController::class, 'store'])->name('admin.roles.store');
        Route::get('/admin/roles/{id}/edit', [RoleManagementController::class, 'edit'])->name('admin.roles.edit');
        Route::put('/admin/roles/{id}', [RoleManagementController::class, 'update'])->name('admin.roles.update');
        Route::delete('/admin/roles/{id}', [RoleManagementController::class, 'destroy'])->name('admin.roles.destroy');
    });


});

/*
|--------------------------------------------------------------------------
| Partage public de documents
|--------------------------------------------------------------------------
*/
Route::get('/shared/document/{token}', [SaveFileController::class, 'shared'])->name('save-files.shared');
Route::get('/shared/document/{token}/download', [SaveFileController::class, 'sharedDownload'])->name('save-files.shared-download');

require __DIR__ . '/auth.php';
