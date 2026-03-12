<?php

namespace App\Http\Controllers;

use App\Models\Subscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class SubscriptionController extends Controller
{
    public function store(Request $request)
    {
        try {
            // Validate input
            $validated = $request->validate([
                'email' => 'required|email|unique:subscriptions,email',
                'phone' => 'nullable|string|min:10',
            ], [
                'email.unique' => 'This email is already subscribed.',
                'email.required' => 'Email is required.',
                'email.email' => 'Please provide a valid email.',
                'phone.min' => 'Phone number must be at least 10 digits.',
            ]);

            // Create subscription
            $subscription = Subscription::create([
                'email' => $validated['email'],
                'phone' => $validated['phone'],
            ]);

            Log::info('Subscription created', ['id' => $subscription->id, 'email' => $subscription->email]);

            // Check if this is an AJAX request
            $isJson = $request->expectsJson() || 
                      $request->wantsJson() || 
                      $request->isJson() ||
                      $request->header('Accept') === 'application/json' ||
                      str_contains($request->header('Accept', ''), 'application/json');

            if ($isJson) {
                return response()->json([
                    'success' => true,
                    'message' => 'Thank you for subscribing! You will receive VIP offers and exclusive deals via SMS.'
                ], 201);
            }

            // Return redirect for form submissions
            return back()->with('success', 'Thank you for subscribing!');

        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::warning('Subscription validation error', $e->errors());
            
            $isJson = $request->expectsJson() || 
                      $request->wantsJson() || 
                      $request->isJson() ||
                      $request->header('Accept') === 'application/json' ||
                      str_contains($request->header('Accept', ''), 'application/json');
            
            if ($isJson) {
                return response()->json([
                    'success' => false,
                    'message' => $e->validator->errors()->first()
                ], 422);
            }
            return back()->withErrors($e->validator)->withInput();

        } catch (\Exception $e) {
            Log::error('Subscription error', [
                'error' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
            ]);
            
            $isJson = $request->expectsJson() || 
                      $request->wantsJson() || 
                      $request->isJson() ||
                      $request->header('Accept') === 'application/json' ||
                      str_contains($request->header('Accept', ''), 'application/json');
            
            if ($isJson) {
                return response()->json([
                    'success' => false,
                    'message' => 'An error occurred. Please try again.'
                ], 500);
            }
            return back()->with('error', 'An error occurred. Please try again.');
        }
    }
}
