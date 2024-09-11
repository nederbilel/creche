<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Enfant;
use App\Models\Presence;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon; 
use Dompdf\Dompdf;
use Dompdf\Options;


class PresenceController extends Controller
{




public function showPresenceView()
{
    $month = Carbon::now()->month;
    $enfants = Enfant::all();


    return view('presence.presence', [
        'month' => $month,
        'enfants' => $enfants, 
    ]);
}
    public function PresenceList(Request $request)
    {
        $month = $request->input('month', Carbon::now()->month);
        $year = $request->input('year', Carbon::now()->year);
        $enfantId = $request->input('enfant');
    
        $enfants = Enfant::all();
    
        if (!$enfantId && count($enfants) > 0) {
            $enfantId = $enfants->first()->id;
        }
    
        $presences = Presence::whereYear('date', $year)
                              ->whereMonth('date', $month)
                              ->where('enfant_id', $enfantId)
                              ->get();
    
        return view('presence.listpresence', compact('presences', 'month', 'year', 'enfants', 'enfantId'));
    }


    public function storePresence(Request $request)
    {
        $request->validate([
            'date' => 'required|date',
            'enfants' => 'required|array',
            'presence_status' => 'required|array',
        ]);
        // dd($request->all());

    
        $date = $request->input('date');
        $enfants = $request->input('enfants');
        $presenceStatus = $request->input('presence_status');
    
        foreach ($enfants as $enfantId) {
            $existingPresence = Presence::where('enfant_id', $enfantId)
                                        ->where('date', $date)
                                        ->first();
            if ($existingPresence) {
                return redirect()->back()->withInput()->withErrors(['error' => 'La présence pour un ou plusieurs enfants est déjà enregistrée pour cette date.']);
            }
        }
    
        foreach ($enfants as $enfantId) {
            if (!isset($presenceStatus[$enfantId])) {
                return redirect()->back()->withInput()->withErrors(['error' => 'Veuillez sélectionner le statut de présence pour tous les enfants.']);
            }
        }
    
        foreach ($enfants as $enfantId) {
            Presence::create([
                'enfant_id' => $enfantId,
                'date' => $date,
                'presence' => $presenceStatus[$enfantId], // Use enfant ID as key to retrieve presence status
            ]);
        }
        
        
    
        return redirect()->route('enfant.presence.list')->with('success', 'Présence mise à jour avec succès');
    }
    
    public function generatePdf(Enfant $enfant, $year, $month)
    {
        $presences = Presence::whereYear('date', $year)
                            ->whereMonth('date', $month)
                            ->where('enfant_id', $enfant->id)
                            ->get();
    
        $monthName = \Carbon\Carbon::createFromDate($year, $month, 1)->locale('fr_FR')->isoFormat('MMMM');
    
        $html = view('presence.presence_pdf', compact('presences', 'monthName', 'enfant'))->render();
    
        $dompdf = new Dompdf();
    
        $dompdf->loadHtml($html);
    
        $dompdf->setPaper('A4', 'portrait');
    
        $dompdf->render();
    
        return $dompdf->stream('liste_presence_' . $monthName . '.pdf');
    }

}
