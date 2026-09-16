<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BrandShop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BrandShopController extends Controller
{
    public function index()
    {
        $shops = BrandShop::ordered()->paginate(15);
        return view('admin.brand-shops.index', compact('shops'));
    }

    public function create()
    {
        return view('admin.brand-shops.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'area' => 'required|string|max:100',
            'city' => 'required|string|max:100',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'phone' => 'nullable|string|max:20',
            'timings.*' => 'nullable|string|max:100',
            'directions_url' => 'nullable|url',
            'is_active' => 'nullable|boolean',
        ]);

        // Combine area and city for location
        $validated['location'] = $validated['area'] . ', ' . $validated['city'];

        // Handle image upload
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('brand-shops', 'public');
        }

        // Format timings
        $timings = [];
        $days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
        foreach ($days as $day) {
            if ($request->has("timing_$day")) {
                $timings[$day] = $request->input("timing_$day");
            }
        }
        $validated['timings'] = $timings;
        $validated['is_active'] = $request->has('is_active') ? 1 : 0;

        BrandShop::create($validated);

        return redirect()->route('admin.brand-shops.index')->with('success', 'Brand shop created successfully.');
    }

    public function show(BrandShop $brandShop)
    {
        return view('admin.brand-shops.show', compact('brandShop'));
    }

    public function edit(BrandShop $brandShop)
    {
        return view('admin.brand-shops.edit', compact('brandShop'));
    }

    public function update(Request $request, BrandShop $brandShop)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'area' => 'required|string|max:100',
            'city' => 'required|string|max:100',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'phone' => 'nullable|string|max:20',
            'timings.*' => 'nullable|string|max:100',
            'directions_url' => 'nullable|url',
            'is_active' => 'nullable|boolean',
        ]);

        $validated['location'] = $validated['area'] . ', ' . $validated['city'];

        if ($request->hasFile('image')) {
            if ($brandShop->image) {
                Storage::disk('public')->delete($brandShop->image);
            }
            $validated['image'] = $request->file('image')->store('brand-shops', 'public');
        }

        $timings = [];
        $days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
        foreach ($days as $day) {
            if ($request->has("timing_$day")) {
                $timings[$day] = $request->input("timing_$day");
            }
        }
        $validated['timings'] = $timings;
        $validated['is_active'] = $request->has('is_active') ? 1 : 0;

        $brandShop->update($validated);

        return redirect()->route('admin.brand-shops.index')->with('success', 'Brand shop updated successfully.');
    }

    public function destroy(BrandShop $brandShop)
    {
        if ($brandShop->image) {
            Storage::disk('public')->delete($brandShop->image);
        }
        $brandShop->delete();

        return back()->with('success', 'Brand shop deleted successfully.');
    }

    public function toggleStatus(BrandShop $brandShop)
    {
        $brandShop->update(['is_active' => !$brandShop->is_active]);
        return back()->with('success', 'Status updated successfully.');
    }

    public function updateOrder(Request $request)
    {
        $shops = $request->input('shops', []);
        foreach ($shops as $index => $shopId) {
            BrandShop::find($shopId)->update(['order' => $index]);
        }

        return response()->json(['success' => true]);
    }
}
