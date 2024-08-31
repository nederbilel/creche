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
    public function indexparent()
    {
        // Get the current date and time
        $now = \Carbon\Carbon::now();
    
        // Subtract 7 days to get the date a week ago
        $weekAgo = $now->subDays(7);
    
        // Retrieve activities created within the last week
        $activites = Activite::where('created_at', '>=', $weekAgo)->get();
    
        // Pass the filtered activities to the view
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
        $validatedData = $request->validate([
            'nom_activite' => 'required|string|max:255',
            'description_activite' => 'required|string',
            'video' => 'nullable|file|mimes:mp4,avi,mkv|max:20480',  // 20 MB max
            'photo' => 'nullable|file|mimes:jpg,jpeg,png|image|max:2048',  // 2 MB max
        ]);

        // Handle video upload
        if ($request->hasFile('video')) {
            // Delete the old video if exists
            if ($activite->video_url) {
                Storage::disk('public')->delete($activite->video_url);
            }
            $validatedData['video_url'] = $request->file('video')->store('videos', 'public');
        }

        // Handle photo upload
        if ($request->hasFile('photo')) {
            // Delete the old photo if exists
            if ($activite->photo_path) {
                Storage::disk('public')->delete($activite->photo_path);
            }
            $validatedData['photo_path'] = $request->file('photo')->store('photos', 'public');
        }

        $activite->update($validatedData);

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
