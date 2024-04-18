<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EnfantController;
use App\Http\Controllers\DepenseController;
use App\Http\Controllers\PaiementMensuelController;
use App\Http\Controllers\PaiementAssurenceController;
use App\Http\Controllers\PresenceController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();


Route::middleware('user')->group(function () {
    // Define your dashboard routes here

    Route::get('/home', [EnfantController::class, 'indexx'])->name('home');
    Route::get('/enfants/count', [EnfantController::class, 'count'])->name('enfants.count');
    Route::get('/enfants/create', [EnfantController::class, 'create'])->name('enfants.create');
    Route::post('/enfants', [EnfantController::class, 'store'])->name('enfants.store');
    Route::get('/enfants/{enfant}', [EnfantController::class, 'show'])->name('enfants.show');
    Route::get('/enfants/{enfant}/edit', [EnfantController::class, 'edit'])->name('enfants.edit');
    Route::put('/enfants/{enfant}', [EnfantController::class, 'update'])->name('enfants.update');
    Route::delete('/enfants/{enfant}', [EnfantController::class, 'destroy'])->name('enfants.destroy');
    Route::get('/enfants', [EnfantController::class, 'index'])->name('indexenfant');
    
    
    Route::get('/presenceList', [PresenceController::class, 'presenceList'])->name('enfant.presence.list');
    Route::get('/presence', [PresenceController::class, 'showPresenceView'])->name('enfant.presence');
    Route::post('/presence', [PresenceController::class, 'storePresence'])->name('enfant.presence.submit');
    Route::get('/enfant/{enfant}/presence/pdf/{year}/{month}', [PresenceController::class, 'generatePdf'])->name('enfant.presence.pdf');
    
    
    
    Route::get('/paiement', [PaiementAssurenceController::class, 'showPaiementView'])->name('enfant.paiement'); // form paiement
    Route::get('/paiements/{paiement}/edit', [PaiementAssurenceController::class, 'editpaiement'])->name('enfant.editpaiement');
    Route::delete('/destroypaiement/{paiement}', [PaiementAssurenceController::class, 'destroypaiement'])->name('enfant.destroypaiement');
    Route::put('/paiements/{paiement}', [PaiementAssurenceController::class, 'updatepaiement'])->name('paiement.update');
    Route::get('/paiementList', [PaiementAssurenceController::class, 'paiementList'])->name('enfant.paiement.list');
    Route::post('/paiement', [PaiementAssurenceController::class, 'storePaiement'])->name('enfant.paiement.submit');
    
    
    
    
    Route::get('/paiementmois', [PaiementMensuelController::class, 'showPaiementmoisView'])->name('enfant.paiementmois');
    Route::get('/paiementmois/{paiement}/edit', [PaiementMensuelController::class, 'editpaiementmois'])->name('enfant.editpaiementmois');
    Route::delete('/destroypaiementmois/{paiement}', [PaiementMensuelController::class, 'destroypaiementmois'])->name('enfant.destroypaiementmois');
    Route::put('/paiementmois/{paiement}', [PaiementMensuelController::class, 'updatepaiementmois'])->name('paiementmois.update');
    Route::get('/paiementmoisList', [PaiementMensuelController::class, 'paiementmoisList'])->name('enfant.paiementmois.list');
    Route::post('/paiementmois', [PaiementMensuelController::class, 'storepaiementmois'])->name('enfant.paiementmois.submit');
    Route::get('/enfant/{enfant}/paiement/pdf/{year}/{month}', [PaiementMensuelController::class, 'generatePaiementPdf'])->name('enfant.paiement.pdf');
    



    Route::get('/depenses/create', [DepenseController::class, 'create'])->name('depenses.create');
    Route::post('/depenses', [DepenseController::class, 'store'])->name('depenses.store');
    Route::get('/depenses/{depense}', [DepenseController::class, 'show'])->name('depenses.show');
    Route::get('/depenses/{depense}/edit', [DepenseController::class, 'edit'])->name('depenses.edit');
    Route::put('/depenses/{depense}', [DepenseController::class, 'update'])->name('depenses.update');
    Route::delete('/depenses/{depense}', [DepenseController::class, 'destroy'])->name('depenses.destroy');
    Route::get('/depenses', [DepenseController::class, 'index'])->name('indexdepense');

});

