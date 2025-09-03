<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subscriber; // we'll create this model

class SubscribeController extends Controller
{
    public function store(Request $request)
    {
        // Validate email input
        $request->validate([
            'email' => 'required|email|unique:subscribers,email',
        ]);

        // Save subscriber
        Subscriber::create([
            'email' => $request->email,
        ]);

        // Redirect back with success message
        return back()->with('success', 'Thank you for subscribing! We will notify you once this product is live.');
    }
}
