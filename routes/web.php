<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EnfantController;

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

Route::get('/home', [EnfantController::class, 'indexx'])->name('home');
Route::get('/enfants/count', [EnfantController::class, 'count'])->name('enfants.count');

// Route for displaying the form to create a new Enfant
Route::get('/enfants/create', [EnfantController::class, 'create'])->name('enfants.create');

// Route for storing a newly created Enfant
Route::post('/enfants', [EnfantController::class, 'store'])->name('enfants.store');

// Route for displaying the details of a specific Enfant
Route::get('/enfants/{enfant}', [EnfantController::class, 'show'])->name('enfants.show');

// Route for displaying the form to edit a specific Enfant
Route::get('/enfants/{enfant}/edit', [EnfantController::class, 'edit'])->name('enfants.edit');

// Route for updating a specific Enfant
Route::put('/enfants/{enfant}', [EnfantController::class, 'update'])->name('enfants.update');

// Route for deleting a specific Enfant
Route::delete('/enfants/{enfant}', [EnfantController::class, 'destroy'])->name('enfants.destroy');
Route::get('/enfants', [EnfantController::class, 'index'])->name('indexenfant');


Route::get('/presenceList', [EnfantController::class, 'presenceList'])->name('enfant.presence.list');
Route::get('/presence', [EnfantController::class, 'showPresenceView'])->name('enfant.presence');
Route::post('/presence', [EnfantController::class, 'storePresence'])->name('enfant.presence.submit');
Route::get('/enfant/{enfant}/presence/pdf/{year}/{month}', [EnfantController::class, 'generatePdf'])->name('enfant.presence.pdf');



Route::get('/paiement', [EnfantController::class, 'showPaiementView'])->name('enfant.paiement'); // form paiement
Route::get('/paiements/{paiement}/edit', [EnfantController::class, 'editpaiement'])->name('enfant.editpaiement');
Route::delete('/destroypaiement/{paiement}', [EnfantController::class, 'destroypaiement'])->name('enfant.destroypaiement');
Route::put('/paiements/{paiement}', [EnfantController::class, 'updatepaiement'])->name('paiement.update');

Route::get('/paiementList', [EnfantController::class, 'paiementList'])->name('enfant.paiement.list');
Route::post('/paiement', [EnfantController::class, 'storePaiement'])->name('enfant.paiement.submit');
Route::get('/enfant/{enfant}/paiement/pdf/{year}', [EnfantController::class, 'generatePdf'])->name('enfant.paiement.pdf');




Route::get('/paiementmois', [EnfantController::class, 'showPaiementmoisView'])->name('enfant.paiementmois');
Route::get('/paiementmois/{paiement}/edit', [EnfantController::class, 'editpaiementmois'])->name('enfant.editpaiementmois');
Route::delete('/destroypaiementmois/{paiement}', [EnfantController::class, 'destroypaiementmois'])->name('enfant.destroypaiementmois');
Route::put('/paiementmois/{paiement}', [EnfantController::class, 'updatepaiementmois'])->name('paiementmois.update');

Route::get('/paiementmoisList', [EnfantController::class, 'paiementmoisList'])->name('enfant.paiementmois.list');
Route::post('/paiementmois', [EnfantController::class, 'storepaiementmois'])->name('enfant.paiementmois.submit');
Route::get('/enfant/{enfant}/paiementmois/pdf/{year}', [EnfantController::class, 'generatePdfpaiementmois'])->name('enfant.paiementmois.pdf');