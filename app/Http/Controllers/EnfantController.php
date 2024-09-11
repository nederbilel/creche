<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use Illuminate\Http\Request;
use App\Models\Enfant;
use App\Models\Depense;
use App\Models\Presence;
use App\Models\PaiementMoi;
use App\Models\User;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon; 
use Dompdf\Dompdf;
use Dompdf\Options;
use PDF;


class EnfantController extends Controller
{

    public function generatePDF()
    { dd($enfants);
        $enfants = Enfant::all(); 
       
        $pdf = PDF::loadView('enfants.pdf', compact('enfants'));
       
        return $pdf->download('liste_enfants.pdf');
    }



    public function index(Request $request)
    {
        $search = $request->input('search');
        
        // Retrieve enfants based on search query or get all if no search query
        $enfants = Enfant::when($search, function($query, $search) {
            return $query->where('nom', 'LIKE', "%{$search}%");
        })->get();
    
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
            'picture' => 'nullable|image|max:2048',
            'frais_inscription' => 'required|string|max:255',
            'caret_enfant' => 'nullable|file',
            'cin_parent' => 'nullable|file',
            'certif_enfant' => 'nullable|file',
            'extrait_de_naissance' => 'nullable|file',
        ]);
    
        // Initialize file paths array
        $filePaths = [];
    
        // Télécharger et stocker les fichiers s'ils sont présents
        if ($request->hasFile('picture')) {
            $filePaths['picture_path'] = $request->file('picture')->store('enfants', 'public');
        }
        if ($request->hasFile('caret_enfant')) {
            $filePaths['caret_enfant'] = $request->file('caret_enfant')->store('enfants', 'public');
        }
        if ($request->hasFile('cin_parent')) {
            $filePaths['cin_parent'] = $request->file('cin_parent')->store('enfants', 'public');
        }
        if ($request->hasFile('certif_enfant')) {
            $filePaths['certif_enfant'] = $request->file('certif_enfant')->store('enfants', 'public');
        }
        if ($request->hasFile('extrait_de_naissance')) {
            $filePaths['extrait_de_naissance'] = $request->file('extrait_de_naissance')->store('enfants', 'public');
        }
    
        // Gérer la description
        $description = '';
    
        if ($request->has('avec_gouter')) {
            $description .= 'Avec Goûter ';
        }
    
        if ($request->has('sans_gouter')) {
            $description .= 'Sans Goûter ';
        }
    
        if ($request->has('Demi-journée')) {
            $description .= 'Demi-journée ';
        }
    
        if ($request->has('toute_journee')) {
            $description .= 'Toute la journée ';
        }
    
        $request->merge(['description' => $description]);
    
        // Créer et sauvegarder l'enfant
        $enfant = new Enfant();
        $enfant->fill($request->except(['picture', 'caret_enfant', 'cin_parent', 'certif_enfant', 'extrait_de_naissance']));
        
        // Set the file paths on the enfant object
        foreach ($filePaths as $key => $path) {
            $enfant->{$key} = $path;
        }
    
        $enfant->save();
    
        return redirect()->route('enfants.index')->with('success', 'Enfant ajouté avec succès');
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
    
        return redirect()->route('enfants.index')->with('success', 'Enfant modifié avec succès');
    }
    
    

    public function destroy(Enfant $enfant)
    {
        $enfant->delete();

        return redirect()->route('enfants.index')->with('success', 'Enfant supprimé avec succès');
    }
   
    public function registermember(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    
        $user = new User();
        $user->name = $validatedData['name'];
        $user->email = $validatedData['email'];
        $user->password = bcrypt($validatedData['password']); 
        $user->usertype = 'admin'; 

        $user->save();
    
        return redirect()->route('home')->with('success', 'Utilisateur a été enregistré avec succès !');
    }
    

    public function editmember()
    {
        $user = Auth::user();
        return view('profile.editmember', compact('user'));
    }

    // Update the user's profile information
    public function updatemember(Request $request)
    {
        $user = Auth::user();

        // Validate the incoming request data
        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $user->id],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
        ]);

        // Update user information
        $user->name = $validatedData['name'];
        $user->email = $validatedData['email'];

        // Update password if provided
        if ($request->filled('password')) {
            $user->password = Hash::make($validatedData['password']);
        }

        $user->save();

        // Redirect with success message
        return redirect()->route('home')->with('success', 'Profile updated successfully!');
    }

    
}