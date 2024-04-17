<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Depense;
use Carbon\Carbon;
class DepenseController extends Controller
{
    // Display a listing of the resource.
    public function index()
    {
        $depenses = Depense::orderBy('date', 'desc')->get()->groupBy(function($date) {
            return Carbon::parse($date->date)->format('m');
        });
        
    
        return view('depense.index', ['depenses' => $depenses]);
    }
    


    public function create()
    {
        return view('depense.create');
    }


    // Route for displaying the form to edit a specific Depense
public function edit($id)
{
    $depense = Depense::findOrFail($id);
    return response()->json(['data' => $depense]);
}



    // Store a newly created resource in storage.
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'prix' => 'required|numeric',
            'date' => 'required|date',
            'type' => 'required|string',
        ]);
    
            $depense = Depense::create($validatedData);
            return redirect()->route('indexdepense')->with('success', 'Dépense ajouté avec succès');

    }
    

  



    // Update the specified resource in storage.
    public function update(Request $request, Depense $depense)
    {

        $validatedData = $request->validate([
            'prix' => 'required|numeric',
            'date' => 'required|date',
            'type' => 'required|string',
        ]);

        $depense->update($request->all());
        return redirect()->route('indexdepense')->with('success', 'depense modifié avec succès');
    }

    
    // Remove the specified resource from storage.
    public function destroy(Depense $depense)
    {
        $depense->delete();

        return redirect()->route('indexdepense')->with('success', 'depnese supprimé avec succès');
    }
}
