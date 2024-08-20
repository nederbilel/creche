<?php

namespace App\Http\Controllers;
use App\Models\User;

use Illuminate\Http\Request;

class ParentController extends Controller
{
    
    public function createparent()
    {
        return view('enfant.createparent');
    }


    public function storeparent(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email', // Ensures email is unique
            'password' => 'required|string|min:8|confirmed', // Ensures the password is confirmed
        ]);
    
        // Create a new instance of the User model
        $user = new User();
    
        // Fill the model with the validated data
        $user->name = $validatedData['name'];
        $user->email = $validatedData['email'];
        $user->password = bcrypt($validatedData['password']); // Hash the password before saving
    
        // Assign the user type as 'parent'
        $user->usertype = 'parent';
    
        // Save the user to the database
        $user->save();
    
        // Redirect the user to the desired route with a success message
        return redirect()->route('parents.index')->with('success', 'Parent ajouté avec succès');
    }
    

    public function indexparent()
{
    $parents = User::where('usertype', 'parent')->get();

    return view('enfant.indexparent', compact('parents'));
}
public function edit($id)
{
    $parent = User::where('id', $id)->where('usertype', 'parent')->firstOrFail();

    return view('enfant.editparent', compact('parent'));
}
public function update(Request $request, $id)
{
    // Validate the incoming request data
    $validatedData = $request->validate([
        'name' => 'required|string',
        'email' => 'required|email',
        'password' => 'nullable|string|min:6', // Password is optional, but must be at least 6 characters if provided
    ]);

    // Find the parent user by ID
    $parent = User::where('id', $id)->where('usertype', 'parent')->firstOrFail();

    // Update the user's details
    $parent->name = $validatedData['name'];
    $parent->email = $validatedData['email'];

    // Only update the password if it was provided
    if (!empty($validatedData['password'])) {
        $parent->password = bcrypt($validatedData['password']);
    }

    // Save the updated parent details to the database
    $parent->save();

    // Redirect to the parents index with a success message
    return redirect()->route('parents.index')->with('success', 'Parent mis à jour avec succès');
}
public function destroy($id)
{
    // Find the parent by ID and ensure they are of type 'parent'
    $parent = User::where('id', $id)->where('usertype', 'parent')->firstOrFail();

    // Delete the parent from the database
    $parent->delete();

    // Redirect to the parents index with a success message
    return redirect()->route('parents.index')->with('success', 'Parent supprimé avec succès');
}


}
