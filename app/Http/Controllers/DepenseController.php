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
        // Validate the incoming request data
        $validatedData = $request->validate([
            'prix' => 'required|numeric',
            'date' => 'required|date',
            'type' => 'required|string',
            'description' => 'nullable|string', // Added validation for description
        ]);
    
        // Create a new instance of the Depense model
        $depense = new Depense();
    
        // Fill the model with the validated data
        $depense->fill($validatedData);
    
        // Save the dépense to the database
        $depense->save();
    
        // Redirect the user to the desired route with a success message
        return redirect()->route('indexdepense')->with('success', 'Dépense ajoutée avec succès');
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
