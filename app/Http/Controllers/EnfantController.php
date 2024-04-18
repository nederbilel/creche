<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Enfant;
use App\Models\Depense;
use App\Models\Presence;
use App\Models\PaiementMoi;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon; 
use Dompdf\Dompdf;
use Dompdf\Options;

class EnfantController extends Controller
{

    public function index()
    {
        $enfants = Enfant::all();
        return view('enfant.index', compact('enfants'));
    }

    public function create()
    {
        return view('enfant.create');
    }

    public function show(Enfant $enfant)
    {
        return view('enfant.show', compact('enfant'));
    }

    public function edit(Enfant $enfant)
    {
        return view('enfant.edit', compact('enfant'));
    }


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
            'sexe' => 'required|string',
            'vaccin' => 'required|string|max:255',
            'adresse' => 'required|string|max:255',
            'maladie' => 'required|string|max:255',
            'picture' => 'nullable|max:2048', 
            'frais_inscription' => 'required|string|max:255', 

        ]);
    
        if ($request->hasFile('picture')) {
            $path = $request->file('picture')->store('enfants', 'public');
    
            $request->merge(['picture_path' => $path]);
        }
    
        $description = '';
    
        if ($request->has('avec_gouter')) {
            $description .= 'Avec Goûter ';

        } if ($request->has('sans_gouter')) {
            $description .= 'Sans Goûter ';
        }
    
        if ($request->has('Demi-journée')) {
            $description .= 'Demi-journée ';
        }
    
        if ($request->has('toute_journee')) {
            $description .= 'Toute la journée ';
        }
    
        $request->merge(['description' => $description]);
    
        $enfant = new Enfant();
        $enfant->fill($request->all());
        $enfant->save();
    
        return redirect()->route('indexenfant')->with('success', 'Enfant ajouté avec succès');
    }
    
    

    public function indexx()
    {
        $currentMonth = Carbon::now()->format('m');
        $currentYear = Carbon::now()->format('Y');
        
        $enfants = Enfant::all();
        
        $paiementmois = PaiementMoi::where('mois', $currentMonth)
                                    ->where('annee', $currentYear)
                                    ->get();
        
        $paidEnfantsIds = [];
        
        foreach ($paiementmois as $paiement) {
            $paidEnfantsIds[] = $paiement->enfant_id;
        }
        
        $enfantsNotPaid = $enfants->reject(function ($enfant) use ($paidEnfantsIds) {
            return in_array($enfant->id, $paidEnfantsIds);
        });
        
        $countAllEnfants = $enfants->count();


        $countboys = $enfants->where('sexe', 'Garçon')->count();

        $countgirls = $enfants->where('sexe', 'Fille')->count();


        $countPaidEnfants = $countAllEnfants - $enfantsNotPaid->count();
        
        $percentagePaidEnfants = ($countAllEnfants > 0) ? round(($countPaidEnfants / $countAllEnfants) * 100) : 0;
        
        $totalFees = $enfants->sum('frais_inscription');
        
        $recentMonthExpenses = Depense::whereMonth('date', $currentMonth)
                                      ->whereYear('date', $currentYear)
                                      ->sum('prix');
        
        return view('home', compact('countboys','countgirls','enfantsNotPaid', 'countAllEnfants', 'percentagePaidEnfants', 'totalFees', 'recentMonthExpenses'));
    }
    

   
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
    
        if ($request->hasFile('picture')) {
            $path = $request->file('picture')->store('enfants', 'public');
    
            $request->merge(['picture_path' => $path]);
        }
    
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
        $request->merge(['description' => $description]);
    
        $enfant->update($request->all());
    
        return redirect()->route('indexenfant')->with('success', 'Enfant modifié avec succès');
    }
    
    

    public function destroy(Enfant $enfant)
    {
        $enfant->delete();

        return redirect()->route('indexenfant')->with('success', 'Enfant supprimé avec succès');
    }
   
    
    
}