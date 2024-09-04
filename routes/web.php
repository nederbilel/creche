<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EnfantController;
use App\Http\Controllers\DepenseController;
use App\Http\Controllers\PaiementMensuelController;
use App\Http\Controllers\PaiementAssurenceController;
use App\Http\Controllers\PresenceController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\ParentController;
use App\Http\Controllers\VisitorController;
use App\Http\Controllers\ActiviteController;

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
});Route::get('/about', function () {
    return view('about');
});Route::get('/services', function () {
    return view('services');

});Route::get('/contact', function () {
    return view('contact');
});Route::get('/blog', function () {
    return view('blog');
});
Route::post('/message', [MessageController::class, 'store'])->name('store.message');
Route::get('/message/liste', [MessageController::class, 'index'])->name('message.index');
Route::get('/messages/{id}', [MessageController::class, 'show'])->name('messages.show');


Auth::routes();

Route::middleware('parent')->group(function () {

    Route::get('/homeparent', [VisitorController::class, 'homeparent'])->name('parent.home');
    Route::get('/activiteparent', [ActiviteController::class, 'indexparent'])->name('activitesparent.index');
    Route::get('/activitesparent/{activite}', [ActiviteController::class, 'showparent'])->name('activitesparent.show');

});



Route::middleware('user')->group(function () {
    // Define your dashboard routes here


    Route::get('/registermember', function () {
        return view('enfant.register');
    });
    Route::post('/registermember', [EnfantController::class, 'registermember'])->name('registermember');
// Display profile page
Route::get('/profile', [EnfantController::class, 'editmember'])->name('editmember');

// Update profile information
Route::post('/profile', [EnfantController::class, 'updatemember'])->name('updatemember');


    Route::get('/home', [EnfantController::class, 'indexx'])->name('home');
    Route::get('/enfants/count', [EnfantController::class, 'count'])->name('enfants.count');
    Route::get('/enfants/create', [EnfantController::class, 'create'])->name('enfants.create');
    Route::post('/enfants', [EnfantController::class, 'store'])->name('enfants.store');
    Route::get('/enfants/{enfant}', [EnfantController::class, 'show'])->name('enfants.show');
    Route::get('/enfants/{enfant}/edit', [EnfantController::class, 'edit'])->name('enfants.edit');
    Route::put('/enfants/{enfant}', [EnfantController::class, 'update'])->name('enfants.update');
    Route::delete('/enfants/{enfant}', [EnfantController::class, 'destroy'])->name('enfants.destroy');
    // Route::get('/enfants', [EnfantController::class, 'index'])->name('indexenfant');
    
    Route::get('/enfants', [EnfantController::class, 'index'])->name('enfants.index');
    Route::get('/enfants/pdf', [EnfantController::class, 'generatePDF'])->name('enfants.pdf');



    Route::get('/parents/create', [ParentController::class, 'createparent'])->name('parents.create');
    Route::post('/parents', [ParentController::class, 'storeparent'])->name('parents.store');
    Route::get('/parents', [ParentController::class, 'indexparent'])->name('parents.index');
    Route::get('/parents/{id}/edit', [ParentController::class, 'edit'])->name('parents.edit');
    Route::put('/parents/{id}', [ParentController::class, 'update'])->name('parents.update');
    Route::delete('/parents/{id}', [ParentController::class, 'destroy'])->name('parents.destroy');



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

    Route::get('/activites/create', [ActiviteController::class, 'create'])->name('activites.create');
    Route::post('/activites', [ActiviteController::class, 'store'])->name('activites.store');
    Route::get('/activites/{activite}/edit', [ActiviteController::class, 'edit'])->name('activites.edit');
    Route::put('/activites/{activite}', [ActiviteController::class, 'update'])->name('activites.update');
    Route::delete('/activites/{activite}', [ActiviteController::class, 'destroy'])->name('activites.destroy');
    Route::get('/activites', [ActiviteController::class, 'index'])->name('activites.index');
    Route::get('/activites/{activite}', [ActiviteController::class, 'show'])->name('activites.show');

});

