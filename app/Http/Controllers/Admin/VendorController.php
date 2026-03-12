<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Vendor;
use Illuminate\Http\Request;

class VendorController extends Controller
{
    public function index(Request $request)
    {
        $query = Vendor::query();

        // Filter by status
        if ($request->has('status') && $request->status !== '') {
            $query->where('status', $request->status);
        }

        // Search
        if ($request->has('search') && $request->search !== '') {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('contact_person_name', 'like', "%{$search}%")
                  ->orWhere('business_name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('phone', 'like', "%{$search}%");
            });
        }

        $vendors = $query->latest()->paginate(15);

        // Get status counts
        $statusCounts = [
            'new' => Vendor::where('status', 'new')->count(),
            'contacted' => Vendor::where('status', 'contacted')->count(),
            'in_progress' => Vendor::where('status', 'in_progress')->count(),
            'approved' => Vendor::where('status', 'approved')->count(),
            'rejected' => Vendor::where('status', 'rejected')->count(),
        ];

        return view('admin.vendors.index', compact('vendors', 'statusCounts'));
    }

    public function show(Vendor $vendor)
    {
        return view('admin.vendors.show', compact('vendor'));
    }

    public function approved(Request $request)
    {
        $query = Vendor::where('status', 'approved');

        // Search
        if ($request->has('search') && $request->search !== '') {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('contact_person_name', 'like', "%{$search}%")
                  ->orWhere('business_name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('phone', 'like', "%{$search}%");
            });
        }

        $vendors = $query->latest()->paginate(15);

        // Get status counts
        $statusCounts = [
            'new' => Vendor::where('status', 'new')->count(),
            'contacted' => Vendor::where('status', 'contacted')->count(),
            'in_progress' => Vendor::where('status', 'in_progress')->count(),
            'approved' => Vendor::where('status', 'approved')->count(),
            'rejected' => Vendor::where('status', 'rejected')->count(),
        ];

        return view('admin.vendors.approved', compact('vendors', 'statusCounts'));
    }

    public function update(Request $request, Vendor $vendor)
    {
        $validated = $request->validate([
            'status' => 'required|in:new,contacted,in_progress,approved,rejected',
            'admin_notes' => 'nullable|string|max:1000',
        ]);

        $vendor->update($validated);

        return back()->with('success', 'Vendor status updated successfully!');
    }

    public function destroy(Vendor $vendor)
    {
        $vendor->delete();
        return back()->with('success', 'Vendor inquiry deleted successfully!');
    }
}
