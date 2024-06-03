<?php

namespace App\Http\Controllers;
use App\Models\Enfant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon; 
use Dompdf\Dompdf;
use Dompdf\Options;
use App\Models\PaiementAssurence;


class PaiementAssurenceController extends Controller
{

    public function showPaiementView(Enfant $enfant)
    {
        $enfants = Enfant::all();

        return view('enfant.paiement', compact('enfants'));
    }

    public function storePaiement(Request $request)
    {
        $request->validate([
            'enfant_id' => 'required|exists:enfants,id',
            'date' => 'required|date',
            'valeur' => 'required|integer',
            'annee' => 'required|string|max:4|min:4',
            'enfant_id' => [
                'required',
                'exists:enfants,id',
                function ($attribute, $value, $fail) use ($request) {
                    if (PaiementAssurence::where('enfant_id', $value)->where('annee', $request->annee)->exists()) {
                        $fail('Cet enfant a déjà effectué un paiement pour cette année.');
                    }
                },
            ],
        ]);
    
        $paiement = new PaiementAssurence();
        $paiement->enfant_id = $request->enfant_id;
        $paiement->date = $request->date;
        $paiement->valeur = $request->valeur; 
        $paiement->annee = $request->annee;
    
        $paiement->save();
    
        return redirect()->route('enfant.paiement.list')->with('success', 'Paiement créé avec succès.');
    }
    

    public function destroypaiement(PaiementAssurence $paiement)
    {
        $paiement->delete();

        return redirect()->route('enfant.paiement.list')
            ->with('success', 'Paiement supprimée avec succès.');
    }

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

    public function editpaiement(PaiementAssurence $paiement)
    {
        $enfants = Enfant::all();
    
        return view('enfant.editpaiement', compact('paiement', 'enfants'));
    }
    

  


    public function updatepaiement(Request $request, PaiementAssurence $paiement)
    {
        $request->validate([
            'enfant_id' => 'required|exists:enfants,id',
            'date' => 'required|date',
            'valeur' => 'required|integer',
            'annee' => 'required|string|max:4|min:4',
        ]);

        $paiement->update($request->all());

        return redirect()->route('enfant.paiement.list')
            ->with('success', 'Paiement updated successfully.');
    }

  
    
    
}
