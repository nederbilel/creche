<?php

namespace App\Http\Controllers;

use App\Models\Activite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ActiviteController extends Controller
{
    // Display a listing of the resource.
    public function index()
    {
        $activites = Activite::all();
        return view('activites.index', compact('activites'));
    }
    public function indexparent(Request $request)
    {
        $startOfWeek = \Carbon\Carbon::now()->startOfWeek();
        $endOfWeek = \Carbon\Carbon::now()->endOfWeek();
    
        $activites = Activite::whereBetween('created_at', [$startOfWeek, $endOfWeek])
                             ->with(['photos', 'videos'])
                             ->orderBy('created_at', 'desc')
                             ->get();
    
        return view('parent.index', compact('activites'));
    }
    
    

    // Show the form for creating a new resource.
    public function create()
    {
        return view('activites.create');
    }

    // Store a newly created resource in storage.
    public function store(Request $request)
    {
        // Validation
        $validatedData = $request->validate([
            'nom_activite' => 'required|string|max:255',
            'description_activite' => 'required|string',
            'photos.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'videos.*' => 'mimetypes:video/avi,video/mpeg,video/quicktime,video/mp4|max:50000'
        ]);
    
        // Store the Activite
        $activite = Activite::create($validatedData);
    
        // Store the Photos
        if($request->hasFile('photos')) {
            foreach ($request->file('photos') as $photo) {
                $path = $photo->store('photos', 'public');
                $activite->photos()->create(['path' => $path]);
            }
        }
    
        // Store the Videos
        if($request->hasFile('videos')) {
            foreach ($request->file('videos') as $video) {
                $path = $video->store('videos', 'public');
                $activite->videos()->create(['path' => $path]);
            }
        }
    
        return redirect()->route('activites.index')->with('success', 'Activité créée avec succès.');
    }
    

    // Display the specified resource.
    public function show(Activite $activite)
    {
        return view('activites.show', compact('activite'));
    }
 public function showparent(Activite $activite)
    {
        return view('parent.show', compact('activite'));
    }

    // Show the form for editing the specified resource.
    public function edit(Activite $activite)
    {
        return view('activites.edit', compact('activite'));
    }

    // Update the specified resource in storage.
    public function update(Request $request, Activite $activite)
    {
        // Validation
        $validatedData = $request->validate([
            'nom_activite' => 'required|string|max:255',
            'description_activite' => 'required|string',
            'photos.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'videos.*' => 'mimetypes:video/avi,video/mpeg,video/quicktime,video/mp4|max:50000'
        ]);
    
        // Update the Activite data
        $activite->update($validatedData);
    
        // Handle Photos
        if($request->hasFile('photos')) {
            // Optionally delete old photos if needed
            foreach ($activite->photos as $photo) {
                Storage::disk('public')->delete($photo->path);
                $photo->delete();
            }
    
            // Save new photos
            foreach ($request->file('photos') as $photo) {
                $path = $photo->store('photos', 'public');
                $activite->photos()->create(['path' => $path]);
            }
        }
    
        // Handle Videos
        if($request->hasFile('videos')) {
            // Optionally delete old videos if needed
            foreach ($activite->videos as $video) {
                Storage::disk('public')->delete($video->path);
                $video->delete();
            }
    
            // Save new videos
            foreach ($request->file('videos') as $video) {
                $path = $video->store('videos', 'public');
                $activite->videos()->create(['path' => $path]);
            }
        }
    
        return redirect()->route('activites.index')->with('success', 'Activité mise à jour avec succès.');
    }
    

    // Remove the specified resource from storage.
    public function destroy(Activite $activite)
    {
        // Delete video and photo files
        if ($activite->video_url) {
            Storage::disk('public')->delete($activite->video_url);
        }
        if ($activite->photo_path) {
            Storage::disk('public')->delete($activite->photo_path);
        }

        $activite->delete();

        return redirect()->route('activites.index')->with('success', 'Activité supprimée avec succès.');
    }
}
