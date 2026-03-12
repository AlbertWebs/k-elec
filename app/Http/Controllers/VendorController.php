<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vendor;

class VendorController extends Controller
{
    public function store(Request $request)
    {
        try {
            // Validate input
            $validated = $request->validate([
                'contact_person_name' => 'required|string|max:255',
                'business_name' => 'required|string|max:255',
                'location' => 'required|string|max:255',
                'partnership_type' => 'required|in:retail_shop,distributor,corporate_purchase,real_estate,other',
                'other_details' => 'nullable|string|max:1000',
                'email' => 'required|email|max:255',
                'phone' => 'nullable|string|max:20',
            ]);

            // If partnership_type is 'other', ensure other_details is provided
            if ($validated['partnership_type'] === 'other' && empty($validated['other_details'])) {
                return response()->json([
                    'success' => false,
                    'message' => 'Please provide details for "Other" partnership type.'
                ], 422);
            }

            // Create vendor
            Vendor::create($validated);

            // Return success response
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Thank you for your interest! Our team will contact you within 24 hours to guide you through the partnership process.'
                ], 200);
            }

            return back()->with('success', 'Thank you for your interest! Our team will contact you within 24 hours.');

        } catch (\Illuminate\Validation\ValidationException $e) {
            if ($request->expectsJson()) {
                $errors = array_map(fn($msgs) => implode(', ', $msgs), $e->errors());
                return response()->json([
                    'success' => false,
                    'message' => 'Validation failed: ' . implode(', ', $errors)
                ], 422);
            }
            throw $e;
        } catch (\Exception $e) {
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'An error occurred. Please try again.'
                ], 500);
            }
            throw $e;
        }
    }
}
