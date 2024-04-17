<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Enfant;
use App\Models\Depense;
use App\Models\Presence;
use App\Models\PaiementAssurence;
use App\Models\PaiementMoi;

use Illuminate\Support\Facades\DB;

use Carbon\Carbon; 
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
            'picture' => 'nullable|max:2048', 
            'frais_inscription' => 'required|string|max:255', 

        ]);
    
        // Handle picture upload
        if ($request->hasFile('picture')) {
            // Store the uploaded picture in a public folder
            $path = $request->file('picture')->store('enfants', 'public');
    
            // Merge the picture path into the request data
            $request->merge(['picture_path' => $path]);
        }
    
        // Concatenate the selected authorizations into the description
        $description = '';
    
        if ($request->has('avec_gouter')) {
            $description .= 'Avec Goûter. ';

        } if ($request->has('sans_gouter')) {
            $description .= 'Sans Goûter. ';
        }
    
        if ($request->has('Demi-journée')) {
            $description .= 'Demi-journée ';
        }
    
        if ($request->has('toute_journee')) {
            $description .= 'Toute la journée ';
        }
    
        // Add the description to the request data
        $request->merge(['description' => $description]);
    
        // Create and save the Enfant model
        $enfant = new Enfant();
        $enfant->fill($request->all());
        $enfant->save();
    
        return redirect()->route('indexenfant')->with('success', 'Enfant ajouté avec succès');
    }
    
    

    public function indexx()
    {
        // Get the current month and year
        $currentMonth = Carbon::now()->format('m');
        $currentYear = Carbon::now()->format('Y');
        
        // Get all enfants
        $enfants = Enfant::all();
        
        // Get paiements for the current month and year
        $paiementmois = PaiementMoi::where('mois', $currentMonth)
                                    ->where('annee', $currentYear)
                                    ->get();
        
        // Initialize an array to store the IDs of enfants who have paid
        $paidEnfantsIds = [];
        
        // Loop through paiements to collect paid enfants IDs
        foreach ($paiementmois as $paiement) {
            $paidEnfantsIds[] = $paiement->enfant_id;
        }
        
        // Filter enfants who haven't paid for the current month and year
        $enfantsNotPaid = $enfants->reject(function ($enfant) use ($paidEnfantsIds) {
            return in_array($enfant->id, $paidEnfantsIds);
        });
        
        // Count the number of all enfants
        $countAllEnfants = $enfants->count();
        
        // Count the number of paid enfants for the current month and year
        $countPaidEnfants = $countAllEnfants - $enfantsNotPaid->count();
        
        // Calculate the percentage of paid enfants for the current month and year
        $percentagePaidEnfants = ($countAllEnfants > 0) ? round(($countPaidEnfants / $countAllEnfants) * 100) : 0;
        
        // Calculate the total fees for all enfants
        $totalFees = $enfants->sum('frais_inscription');
        
        // Get expenses for the recent month and year
        $recentMonthExpenses = Depense::whereMonth('date', $currentMonth)
                                      ->whereYear('date', $currentYear)
                                      ->sum('prix');
        
        // Return the counts along with the list of unpaid enfants, 
        // the percentage of paid enfants, the total fees, and recent month expenses
        return view('home', compact('enfantsNotPaid', 'countAllEnfants', 'percentagePaidEnfants', 'totalFees', 'recentMonthExpenses'));
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
            'picture' => 'nullable|image|max:2048', 
            'frais_inscription' => 'required|string|max:255', 

        ]);
    
        // Handle picture upload
        if ($request->hasFile('picture')) {
            // Store the uploaded picture in a public folder
            $path = $request->file('picture')->store('enfants', 'public');
    
            // Merge the picture path into the request data
            $request->merge(['picture_path' => $path]);
        }
    
        // Concatenate the selected authorizations into the description
        $description = '';
    
        if ($request->has('avec_gouter')) {
            $description .= 'Avec Goûter. ';
        }
    
        if ($request->has('Demi-journée')) {
            $description .= 'Demi-journée ';
        }
        if ($request->has('sans_gouter')) {
            $description .= 'Sans Goûter. ';
        }
    
        if ($request->has('toute_journee')) {
            $description .= 'Toute la journée ';
        }
        // Add the description to the request data
        $request->merge(['description' => $description]);
    
        // Update the Enfant model
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

//////////////////////

public function showPaiementmoisView(Enfant $enfant)
{
    $enfants = Enfant::all();

    return view('enfant.paiementmois', compact('enfants'));
}

/////////////////////////////////////////////////////////////////////
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
/////////////////////////////////


public function storepaiementmois(Request $request)
{
    // Validate the incoming request data
    $request->validate([
        'enfant_id' => 'required|exists:enfants,id',
        'date' => 'required|date',
        'valeur' => 'required|integer',
        'mois' => 'required|string',
        'annee' => 'required|string|min:4|max:4',


    ]);

    // Create a new instance of PaiementAssurence model
    $paiement = new PaiementMoi();
    $paiement->enfant_id = $request->enfant_id;
    $paiement->date = $request->date;
    $paiement->valeur = $request->valeur; 
    $paiement->mois = $request->mois;
    $paiement->annee = $request->annee;


    // Save the PaiementAssurence instance
    $paiement->save();

    // Redirect the user to a relevant page, such as the view for the created paiement
    return redirect()->route('enfant.paiementmois.list') ->with('success', 'Paiement créer avec succès.');
}

/////////////////////

    public function destroypaiement(PaiementAssurence $paiement)
    {
        // Delete the paiement
        $paiement->delete();

        // Redirect the user to a relevant page, such as the index page for paiements
        return redirect()->route('enfant.paiement.list')
            ->with('success', 'Paiement supprimée avec succès.');
    }

    public function destroypaiementmois(PaiementMoi $paiement)
    {
        // Delete the paiement
        $paiement->delete();

        // Redirect the user to a relevant page, such as the index page for paiements
        return redirect()->route('enfant.paiementmois.list')
            ->with('success', 'Paiement supprimée avec succès.');
    }
    

    //liste des paiement
   

    // public function paiementList(Request $request)
    // {
    //     $selectedYear = $request->input('year', null);
    
    //     $paiementsQuery = PaiementAssurance::with('enfant');
    
    //     if ($selectedYear) {
    //         $paiementsQuery->where('annee', $selectedYear);
    //     }
    
    //     $paiements = $paiementsQuery->get();
    
    //     $enfants = Enfant::all();
    
    //     return view('enfant.listpaiement', [
    //         'paiements' => $paiements,
    //         'enfants' => $enfants,
    //         'selectedYear' => $selectedYear,
    //     ]);
    // }
   

    public function paiementList(Request $request)
{
    $selectedYear = $request->input('year', null);

    $paiementsQuery = PaiementAssurence::with('enfant');

    if ($selectedYear) {
        $paiementsQuery->where('annee', $selectedYear);
    }

    $paiements = $paiementsQuery->get();

    $enfants = Enfant::all();

    $years = PaiementAssurence::distinct()->pluck('annee')->toArray();

    return view('enfant.listpaiement', [
        'paiements' => $paiements,
        'enfants' => $enfants,
        'years' => $years,
        'selectedYear' => $selectedYear,
    ]);
}

    ///////////////////
    public function paiementmoisList(Request $request)
    {
        // Fetch all paiements with associated enfant details
        $paiementsQuery = PaiementMoi::with('enfant')
            ->orderBy('annee', 'desc')
            ->orderByRaw("CAST(mois AS UNSIGNED) DESC");
    
        // Check if a year filter is applied
        if ($request->filled('year')) {
            $paiementsQuery->where('annee', $request->year);
        }
    
        // Check if a month filter is applied
        if ($request->filled('month')) {
            $paiementsQuery->where('mois', $request->month);
        }
    
        // Execute the query
        $paiements = $paiementsQuery->get()->groupBy(['annee', 'mois']);
    
        // Get unique years
        $years = PaiementMoi::distinct()->pluck('annee')->toArray();
        $enfants = Enfant::all();
    
        // Pass the paiements data, years, and the selected year to the view
        return view('enfant.listpaiementmois', [
            'paiements' => $paiements,
            'years' => $years,
            'enfants' => $enfants,
        ]);
    }
    
    
    
  
    public function editpaiement(PaiementAssurence $paiement)
    {
        // Fetch all enfants to populate the select dropdown in the edit form
        $enfants = Enfant::all();
    
        // Return the edit view with the paiement data and enfants data
        return view('enfant.editpaiement', compact('paiement', 'enfants'));
    }
    

    public function editpaiementmois(PaiementMoi $paiement)
    {
        // Fetch all enfants to populate the select dropdown in the edit form
        $enfants = Enfant::all();
    
        // Return the edit view with the paiement data and enfants data
        return view('enfant.editpaiementmois', compact('paiement', 'enfants'));
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

    //////////////////////////////////////



    public function updatepaiementmois(Request $request, PaiementMoi $paiement)
    {
        // Validate the incoming request data
        $request->validate([
            'enfant_id' => 'required|exists:enfants,id',
            'date' => 'required|date',
            'valeur' => 'required|integer',
            'annee' => 'required|string|max:4|min:4',
            'mois' => 'required|string',

        ]);

        // Update the paiement with the validated data
        $paiement->update($request->all());

        // Redirect the user to a relevant page, such as the index page for paiements
        return redirect()->route('enfant.paiementmois.list')
            ->with('success', 'Paiement updated successfully.');
    }


    ///////////////////
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
        // dd($request->all());

    
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
    


public function generatePaiementPdf(Enfant $enfant, $year, $month)
{
    // Fetch paiement data for the specified month, year, and child
    $paiements = PaiementMoi::where('enfant_id', $enfant->id)
                            ->where('annee', $year)
                            ->where('mois', $month)
                            ->get();

    // Generate HTML view for PDF
    $html = view('enfant.facture_pdf', compact('paiements', 'enfant', 'year', 'month'))->render();

    // Create a new Dompdf instance
    $dompdf = new Dompdf();

    // Load HTML content into Dompdf
    $dompdf->loadHtml($html);

    // Set paper size and orientation (optional)
    $dompdf->setPaper('A5', 'landscape');

    // Render PDF (optional: save to file)
    $dompdf->render();

    // Output PDF to browser
    return $dompdf->stream('paiement_' . $enfant->nom . '_' . $month . '_' . $year . '.pdf');
}


    
    
    
}