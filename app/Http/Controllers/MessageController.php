<?php

namespace App\Http\Controllers;
use App\Models\Message;

use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function store(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string',
        ]);
    
        // Create a new instance of the Message model and fill it with the validated data
        $message = new Message();
        $message->nom = $validatedData['nom'];
        $message->prenom = $validatedData['prenom'];
        $message->email = $validatedData['email'];
        $message->message = $validatedData['message'];
    
        // Save the message to the database
        $message->save();
    
        // Redirect the user to the homepage or a different desired route with a success message
        return redirect()->back()->with('success', 'Votre message a été envoyé avec succès !');
    }


    public function index(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
    
        // Build the query
        $query = Message::query();
    
        // Apply date range filter if provided
        if ($startDate && $endDate) {
            $query->whereBetween('created_at', [$startDate, $endDate]);
        }
    
        // Sort by the most recent messages
        $messages = $query->orderBy('created_at', 'desc')->get();
    

    return view('message.listmessage', compact('messages'));
}


    public function show($id)
    {
        // Fetch a single message by its ID
        $message = Message::findOrFail($id);

        // Pass the message to the view
        return view('message.showmessage', compact('message'));
    }
}
