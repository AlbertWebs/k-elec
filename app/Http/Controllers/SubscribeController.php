<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subscriber;

class SubscribeController extends Controller
{
    public function store(Request $request)
    {
        try {
            // Validate input
            $validated = $request->validate([
                'email' => 'required|email|unique:subscribers,email',
                'phone' => 'nullable|string|max:20',
            ]);

            // Save subscriber
            Subscriber::create($validated);

            // Return success response
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Thank you for subscribing! We will notify you when new products arrive.'
                ], 200);
            }

            return back()->with('success', 'Thank you for subscribing!');

        } catch (\Illuminate\Validation\ValidationException $e) {
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validation failed: ' . implode(', ', array_map(fn($msgs) => implode(', ', $msgs), $e->errors()))
                ], 422);
            }
            throw $e;
        }
    }
}
