<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Showroom;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ShowroomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $showrooms = Showroom::all();
        return view('admin.showrooms.index', compact('showrooms'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.showrooms.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_active' => 'boolean',
            'featured' => 'boolean',
            'location_url' => 'nullable|url'
        ]);

        $data = $request->all();
        
        // Handle image upload
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('showrooms', 'public');
            $data['image'] = $imagePath;
        }

        $data['is_active'] = $request->has('is_active');
        $data['featured'] = $request->has('featured');
     
        Showroom::create($data);

        return redirect()->route('admin.showrooms.index')
            ->with('success', 'Showroom created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Showroom $showroom)
    {
        return view('admin.showrooms.show', compact('showroom'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Showroom $showroom)
    {
        return view('admin.showrooms.edit', compact('showroom'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Showroom $showroom)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'featured' =>  'boolean',
            'location_url' => 'nullable|url',
            'is_active' => 'boolean'
        ]);

        $data = $request->all();
        
        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image
            if ($showroom->image) {
                Storage::disk('public')->delete($showroom->image);
            }
            
            $imagePath = $request->file('image')->store('showrooms', 'public');
            $data['image'] = $imagePath;
        }

        $data['is_active'] = $request->has('is_active');
        $data['featured'] = $request->has('featured');

        $showroom->update($data);

        return redirect()->route('admin.showrooms.index')
            ->with('success', 'Showroom updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Showroom $showroom)
    {
        // Delete image file
        if ($showroom->image) {
            Storage::disk('public')->delete($showroom->image);
        }

        $showroom->delete();

        return redirect()->route('admin.showrooms.index')
            ->with('success', 'Showroom deleted successfully.');
    }

    /**
     * Toggle the active status of a showroom.
     */
    public function toggleStatus(Showroom $showroom)
    {
        $showroom->update(['is_active' => !$showroom->is_active]);

        return redirect()->route('admin.showrooms.index')
            ->with('success', 'Showroom status updated successfully.');
    }

    /**
     * Update the order of showrooms.
     */
    public function updateOrder(Request $request)
    {
        $request->validate([
            'showrooms' => 'required|array',
            'showrooms.*' => 'required|integer|exists:showrooms,id'
        ]);

        foreach ($request->showrooms as $index => $showroomId) {
            Showroom::where('id', $showroomId)->update(['order' => $index]);
        }

        return response()->json(['success' => true]);
    }
}
