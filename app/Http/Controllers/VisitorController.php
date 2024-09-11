<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Enfant;
use App\Models\PaiementMoi;


use Illuminate\Http\Request;

class VisitorController extends Controller
{
    public function homeparent(Request $request)
{
    // Assuming the parent is authenticated
    $parent = auth()->user();

    // Access the enfant_id directly from the authenticated user's record
    $enfantId = $parent->enfant_id;

    // Retrieve the related enfant record from the Enfant model
    $enfant = Enfant::find($enfantId);

    // Retrieve the payment records associated with this enfant
    $paiements = PaiementMoi::where('enfant_id', $enfantId)->get();

    // Get the current month and year
    $currentMonth = now()->month;
    $currentYear = now()->year;

    // Check if the current month has been paid
    $currentMonthPaid = $paiements->contains(function ($paiement) use ($currentMonth, $currentYear) {
        return $paiement->mois == $currentMonth && $paiement->annee == $currentYear;
    });

    // Return the view with the enfant, paiements, and currentMonthPaid flag
    return view('dashboardParent.home', compact('enfantId', 'enfant', 'paiements', 'currentMonthPaid'));
}





}
