<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\PaiementMoi;
use Illuminate\Support\Facades\DB;
use App\Models\Enfant;
use Carbon\Carbon; 
use Dompdf\Dompdf;
use Dompdf\Options;


class PaiementMensuelController extends Controller
{  

    public function updatepaiementmois(Request $request, PaiementMoi $paiement)
    {
        $request->validate([
            'enfant_id' => 'required|exists:enfants,id',
            'date' => 'required|date',
            'valeur' => 'required|integer',
            'annee' => 'required|string|max:4|min:4',
            'mois' => 'required|string',

        ]);

        $paiement->update($request->all());

        return redirect()->route('enfant.paiementmois.list')
            ->with('success', 'Paiement updated successfully.');
    }


    public function editpaiementmois(PaiementMoi $paiement)
    {
        $enfants = Enfant::all();
    
        return view('paiementMensuel.editpaiementmois', compact('paiement', 'enfants'));
    }
    
    public function paiementmoisList(Request $request)
    {
        $paiementsQuery = PaiementMoi::with('enfant')
            ->orderBy('annee', 'desc')
            ->orderByRaw("CAST(mois AS UNSIGNED) DESC");
    
        if ($request->filled('year')) {
            $paiementsQuery->where('annee', $request->year);
        }
    
        if ($request->filled('month')) {
            $paiementsQuery->where('mois', $request->month);
        }
    
        $paiements = $paiementsQuery->get()->groupBy(['annee', 'mois']);
    
        $years = PaiementMoi::distinct()->pluck('annee')->toArray();
        $enfants = Enfant::all();
    
        return view('paiementMensuel.listpaiementmois', [
            'paiements' => $paiements,
            'years' => $years,
            'enfants' => $enfants,
        ]);
    }
    
    public function destroypaiementmois(PaiementMoi $paiement)
    {
        $paiement->delete();

        return redirect()->route('enfant.paiementmois.list')
            ->with('success', 'Paiement supprimée avec succès.');
    }

    public function showPaiementmoisView(Enfant $enfant)
    {
        $enfants = Enfant::all();
    
        return view('paiementMensuel.paiementmois', compact('enfants'));
    }


    public function storepaiementmois(Request $request)
    {
        $request->validate([
            'enfant_id' => 'required|exists:enfants,id',
            'date' => 'required|date',
            'valeur' => 'required|integer',
            'mois' => 'required|string',
            'annee' => [
                'required',
                'string',
                'min:4',
                'max:4',
                function ($attribute, $value, $fail) use ($request) {
                    if (PaiementMoi::where('enfant_id', $request->enfant_id)
                        ->where('mois', $request->mois)
                        ->where('annee', $value)
                        ->exists()) {
                        $fail('Cet enfant a déjà effectué un paiement pour ce mois !');
                    }
                },
            ],
        ]);
    
        $paiement = new PaiementMoi();
        $paiement->enfant_id = $request->enfant_id;
        $paiement->date = $request->date;
        $paiement->valeur = $request->valeur; 
        $paiement->mois = $request->mois;
        $paiement->annee = $request->annee;
    
        $paiement->save();
    
        return redirect()->route('enfant.paiementmois.list')->with('success', 'Paiement créé avec succès');
    }
    
    

    public function generatePaiementPdf(Enfant $enfant, $year, $month)
    {
        $paiements = PaiementMoi::where('enfant_id', $enfant->id)
                                ->where('annee', $year)
                                ->where('mois', $month)
                                ->get();
    
        $html = view('paiementMensuel.facture_pdf', compact('paiements', 'enfant', 'year', 'month'))->render();
    
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
