<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VisitorController extends Controller
{
    public function homeparent(Request $request)
    {
    
    
        return view('parent.home');
    }}
