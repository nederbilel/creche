<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Enfant;
use App\Models\Presence;
use App\Models\PaiementAssurence;

use Carbon\Carbon; // Import Carbon for date manipulation
use Dompdf\Dompdf;
use Dompdf\Options;

class EnfantController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'date_de_naissance' => 'required|date',
            'nom_mere' => 'required|string|max:255',
            'nom_pere' => 'required|string|max:255',
            'telephone1' => 'required|string|max:8|min:8',
            'telephone2' => 'required|string|max:8|min:8',
            'travail_pere' => 'required|string|max:255',
            'travail_mere' => 'required|string|max:255',
            'vaccin' => 'required|string|max:255',
            'adresse' => 'required|string|max:255',
            'maladie' => 'required|string|max:255',
            'description' => 'required|string',
        ]);
    
        $enfant = new Enfant();
        $enfant->fill($request->all());
        $enfant->save();
    
        return redirect()->route('indexenfant')->with('success', 'Enfant ajouté avec succès');
    }
    
    


    

    public function index()
    {
        $enfants = Enfant::all();
        return view('enfant.index', compact('enfants'));
    }


    // Function to display the form for creating a new Enfant
    public function create()
    {
        return view('enfant.create');
    }

    // Function to display the specified Enfant
    public function show(Enfant $enfant)
    {
        return view('enfant.show', compact('enfant'));
    }

    // Function to display the form for editing the specified Enfant
    public function edit(Enfant $enfant)
    {
        return view('enfant.edit', compact('enfant'));
    }

    // Function to update the specified Enfant
    public function update(Request $request, Enfant $enfant)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'date_de_naissance' => 'required|date',
            'nom_mere' => 'required|string|max:255',
            'nom_pere' => 'required|string|max:255',
            'telephone1' => 'required|string|max:8|min:8',
            'telephone2' => 'required|string|max:8|min:8',
            'travail_pere' => 'required|string|max:255',
            'travail_mere' => 'required|string|max:255',
            'vaccin' => 'required|string|max:255',
            'adresse' => 'required|string|max:255',
            'maladie' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        $enfant->update($request->all());

        return redirect()->route('indexenfant')->with('success', 'Enfant modifié avec succès');
    }

    // Function to remove the specified Enfant
    public function destroy(Enfant $enfant)
    {
        $enfant->delete();

        return redirect()->route('indexenfant')->with('success', 'Enfant supprimé avec succès');
    }
    

    ////////////////////////////////////////////////////////////////////
    //paiement/////

    

    public function showPaiementView(Enfant $enfant)
    {
        $enfants = Enfant::all();

        return view('enfant.paiement', compact('enfants'));
    }


    public function storePaiement(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'enfant_id' => 'required|exists:enfants,id',
            'date' => 'required|date',
            'valeur' => 'required|integer',
            'annee' => 'required|string|max:4|min:4',
        ]);
    
        // Create a new instance of PaiementAssurence model
        $paiement = new PaiementAssurence();
        $paiement->enfant_id = $request->enfant_id;
        $paiement->date = $request->date;
        $paiement->valeur = $request->valeur; 
        $paiement->annee = $request->annee;
    
        // Save the PaiementAssurence instance
        $paiement->save();
    
        // Redirect the user to a relevant page, such as the view for the created paiement
        return redirect()->route('enfant.paiement.list') ->with('success', 'Paiement créer avec succès.');
    }


    public function destroypaiement(PaiementAssurence $paiement)
    {
        // Delete the paiement
        $paiement->delete();

        // Redirect the user to a relevant page, such as the index page for paiements
        return redirect()->route('enfant.paiement.list')
            ->with('success', 'Paiement supprimée avec succès.');
    }
    

    //liste des paiement
   

    public function paiementList()
    {
        // Fetch all paiements with associated enfant details
        $paiements = PaiementAssurence::with('enfant')->get();
    
        // Group paiements by 'annee'
        $groupedPaiements = $paiements->groupBy('annee');
    
        $enfants = Enfant::all();
    
        // Pass the grouped paiements data to the view
        return view('enfant.listpaiement', ['groupedPaiements' => $groupedPaiements, 'enfants' => $enfants]);
    }
    

  
    public function editpaiement(PaiementAssurence $paiement)
    {
        // Fetch all enfants to populate the select dropdown in the edit form
        $enfants = Enfant::all();
    
        // Return the edit view with the paiement data and enfants data
        return view('enfant.editpaiement', compact('paiement', 'enfants'));
    }
    


    public function updatepaiement(Request $request, PaiementAssurence $paiement)
    {
        // Validate the incoming request data
        $request->validate([
            'enfant_id' => 'required|exists:enfants,id',
            'date' => 'required|date',
            'valeur' => 'required|integer',
            'annee' => 'required|string|max:4|min:4',
        ]);

        // Update the paiement with the validated data
        $paiement->update($request->all());

        // Redirect the user to a relevant page, such as the index page for paiements
        return redirect()->route('enfant.paiement.list')
            ->with('success', 'Paiement updated successfully.');
    }
//blade presence create

public function showPresenceView()
{
    // Assuming $month is set to the current month by default
    $month = Carbon::now()->month;
    $enfants = Enfant::all();

    // Fetch other necessary data, like $enfants

    return view('enfant.presence', [
        'month' => $month,
        'enfants' => $enfants, // Make sure to replace $enfants with your actual data
    ]);
}
    //show list presence 
    public function PresenceList(Request $request)
    {
        // Get the selected month, year, and child ID from the request
        $month = $request->input('month', Carbon::now()->month);
        $year = $request->input('year', Carbon::now()->year);
        $enfantId = $request->input('enfant');
    
        // Fetch all enfants for the select options
        $enfants = Enfant::all();
    
        // If no child is selected, default to the first child in the list
        if (!$enfantId && count($enfants) > 0) {
            $enfantId = $enfants->first()->id;
        }
    
        // Fetch presence data for the specified month, year, and child
        $presences = Presence::whereYear('date', $year)
                              ->whereMonth('date', $month)
                              ->where('enfant_id', $enfantId)
                              ->get();
    
        return view('enfant.listpresence', compact('presences', 'month', 'year', 'enfants', 'enfantId'));
    }


    //frompresence
    public function storePresence(Request $request)
    {
        // Validate the form data
        $request->validate([
            'date' => 'required|date',
            'enfants' => 'required|array',
            'presence_status' => 'required|array',
        ]);
    
        $date = $request->input('date');
        $enfants = $request->input('enfants');
        $presenceStatus = $request->input('presence_status');
    
        // Check if the presence for any enfant on the given date already exists
        foreach ($enfants as $enfantId) {
            $existingPresence = Presence::where('enfant_id', $enfantId)
                                        ->where('date', $date)
                                        ->first();
            if ($existingPresence) {
                return redirect()->back()->withInput()->withErrors(['error' => 'La présence pour un ou plusieurs enfants est déjà enregistrée pour cette date.']);
            }
        }
    
        // Check if at least one checkbox is checked for each enfant
        foreach ($enfants as $enfantId) {
            if (!isset($presenceStatus[$enfantId])) {
                return redirect()->back()->withInput()->withErrors(['error' => 'Veuillez sélectionner le statut de présence pour tous les enfants.']);
            }
        }
    
        // Iterate over each enfant and their presence status
        foreach ($enfants as $enfantId) {
            // Create a new presence record for each enfant
            Presence::create([
                'enfant_id' => $enfantId,
                'date' => $date,
                'presence' => $presenceStatus[$enfantId], // Use enfant ID as key to retrieve presence status
            ]);
        }
    
        // Redirect back or return a response as needed
        return redirect()->route('enfant.presence.list')->with('success', 'Présence mise à jour avec succès');
    }
    

    
    public function generatePdf(Enfant $enfant, $year, $month)
{
    // Fetch presence data for the specified month, year, and child
    $presences = Presence::whereYear('date', $year)
                        ->whereMonth('date', $month)
                        ->where('enfant_id', $enfant->id)
                        ->get();

    // Get month name in French
    $monthName = \Carbon\Carbon::createFromDate($year, $month, 1)->locale('fr_FR')->isoFormat('MMMM');

    // Generate HTML view for PDF
    $html = view('enfant.presence_pdf', compact('presences', 'monthName', 'enfant'))->render();

    // Create a new Dompdf instance
    $dompdf = new Dompdf();

    // Load HTML content into Dompdf
    $dompdf->loadHtml($html);

    // Set paper size and orientation (optional)
    $dompdf->setPaper('A4', 'portrait');

    // Render PDF (optional: save to file)
    $dompdf->render();

    // Output PDF to browser
    return $dompdf->stream('liste_presence_' . $monthName . '.pdf');
}
    
    
    
    
}