<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::with('category');

        // Search
        if ($request->search) {
            $query->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('description', 'like', '%' . $request->search . '%');
        }

        // Filter by category
        if ($request->category) {
            $query->where('category_id', $request->category);
        }

        // Filter by status
        if ($request->status !== null) {
            $query->where('is_active', $request->status);
        }

        $products = $query->latest()->paginate(15);
        $categories = Category::all();

        return view('admin.products.index', compact('products', 'categories'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'description' => 'required|string',
            'brand' => 'nullable|string|max:100',
            'price' => 'required|numeric|min:0',
            'old_price' => 'nullable|numeric|min:0',
            'stock_quantity' => 'required|integer|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'badge' => 'nullable|string|max:50',
            'rating' => 'nullable|integer|min:1|max:5',
            'reviews_count' => 'nullable|integer|min:0',
            'is_featured' => 'boolean',
            'is_active' => 'boolean',
            'specifications' => 'nullable|array',
        ]);

        $validated['slug'] = Str::slug($validated['name']);

        // Handle main image upload
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('products', 'public');
        }

        // Handle additional images upload
        if ($request->hasFile('images')) {
            $images = [];
            foreach ($request->file('images') as $image) {
                $images[] = $image->store('products', 'public');
            }
            $validated['images'] = array_values($images);
        }

        // Process specifications
        if (isset($validated['specifications'])) {
            $specifications = [];
            foreach ($validated['specifications'] as $spec) {
                if (!empty($spec['key']) && !empty($spec['value'])) {
                    $specifications[$spec['key']] = $spec['value'];
                }
            }
            $validated['specifications'] = $specifications;
        }

        Product::create($validated);

        return redirect()->route('admin.products.index')->with('success', 'Product created successfully.');
    }

    public function show(Product $product)
    {
        return view('admin.products.show', compact('product'));
    }

    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('admin.products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product)
    {
        
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'description' => 'required|string',
            'brand' => 'nullable|string|max:100',
            'price' => 'required|numeric|min:0',
            'old_price' => 'nullable|numeric|min:0',
            'stock_quantity' => 'required|integer|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'delete_images' => 'nullable|array',
            'delete_images.*' => 'nullable|string',
            'badge' => 'nullable|string|max:50',
            'rating' => 'nullable|integer|min:1|max:5',
            'reviews_count' => 'nullable|integer|min:0',
            'is_featured' => 'boolean',
            'is_active' => 'boolean',
            'specifications' => 'nullable|array',
        ]);

        $validated['slug'] = Str::slug($validated['name']);

        // Handle main image upload
        if ($request->hasFile('image')) {
            // Delete old main image if exists (only if it's a storage file)
            if ($product->image && !str_starts_with($product->image, '/assets/')) {
                Storage::disk('public')->delete($product->image);
            }
            $validated['image'] = $request->file('image')->store('products', 'public');
        }

        // Start with existing images
        $currentImages = $product->images ?? [];
        
        // Clean up current images array to remove invalid entries
        $currentImages = array_filter($currentImages, function($image) {
            return is_string($image) && !empty(trim($image));
        });

        // Handle image deletions
        $imagesToDelete = [];
        
        // Check for array format
        if ($request->has('delete_images')) {
            $imagesToDelete = $request->delete_images;
        }
        
        // Remove duplicates and filter out empty values
        $imagesToDelete = array_unique(array_filter($imagesToDelete, function($image) {
            return is_string($image) && !empty(trim($image));
        }));
        
        if (!empty($imagesToDelete)) {
            // Delete main image if it's in the delete list
            if (in_array($product->image, $imagesToDelete)) {
                // Only delete from storage if it's a storage file (not a public asset)
                if (!str_starts_with($product->image, '/assets/')) {
                    Storage::disk('public')->delete($product->image);
                }
                $validated['image'] = null;
                \Log::info('Main image deleted:', ['image' => $product->image]);
            }
            
            // Remove deleted images from current images array
            $currentImages = array_filter($currentImages, function($image) use ($imagesToDelete) {
                if (in_array($image, $imagesToDelete)) {
                    // Only delete from storage if it's a storage file (not a public asset)
                    if (!str_starts_with($image, '/assets/')) {
                        Storage::disk('public')->delete($image);
                    }
                    \Log::info('Additional image deleted:', ['image' => $image]);
                    return false;
                }
                return true;
            });
        }

        // Handle additional images upload
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $currentImages[] = $image->store('products', 'public');
            }
        }
        
        // Set the final images array
        $validated['images'] = array_values($currentImages);

        // Process specifications
        if (isset($validated['specifications'])) {
            $specifications = [];
            foreach ($validated['specifications'] as $spec) {
                if (!empty($spec['key']) && !empty($spec['value'])) {
                    $specifications[$spec['key']] = $spec['value'];
                }
            }
            $validated['specifications'] = $specifications;
        }

        $product->update($validated);

        return redirect()->route('admin.products.index')->with('success', 'Product updated successfully.');
    }

    public function testUpdate(Request $request)
    {
        // Log all request data for debugging
        \Log::info('Test Update - All request data:', $request->all());
        
        // Check for delete_images specifically
        if ($request->has('delete_images')) {
            \Log::info('Test Update - delete_images found:', $request->delete_images);
        } else {
            \Log::info('Test Update - No delete_images in request');
        }
        
        // Check all hidden inputs
        $allInputs = $request->all();
        $deleteImagesFromInputs = [];
        foreach ($allInputs as $key => $value) {
            if (strpos($key, 'delete_images') === 0) {
                $deleteImagesFromInputs[] = $value;
            }
        }
        \Log::info('Test Update - delete_images from inputs:', $deleteImagesFromInputs);
        
        return response()->json([
            'success' => true,
            'message' => 'Test update received',
            'delete_images' => $request->delete_images ?? [],
            'all_inputs' => $allInputs
        ]);
    }

    public function destroy(Product $product)
    {
        // Delete all product images
        if ($product->image) {
            // Only delete from storage if it's a storage file (not a public asset)
            if (!str_starts_with($product->image, '/assets/')) {
                Storage::disk('public')->delete($product->image);
            }
        }
        
        if ($product->images && is_array($product->images)) {
            foreach ($product->images as $image) {
                // Only delete from storage if it's a storage file (not a public asset)
                if (!str_starts_with($image, '/assets/')) {
                    Storage::disk('public')->delete($image);
                }
            }
        }
        
        $product->delete();
        return redirect()->route('admin.products.index')->with('success', 'Product deleted successfully.');
    }

    public function bulkAction(Request $request)
    {
        $action = $request->action;
        $productIds = $request->product_ids;

        if (!$productIds) {
            return back()->with('error', 'No products selected.');
        }

        switch ($action) {
            case 'activate':
                Product::whereIn('id', $productIds)->update(['is_active' => true]);
                $message = 'Products activated successfully.';
                break;
            case 'deactivate':
                Product::whereIn('id', $productIds)->update(['is_active' => false]);
                $message = 'Products deactivated successfully.';
                break;
            case 'delete':
                $products = Product::whereIn('id', $productIds)->get();
                foreach ($products as $product) {
                    // Delete all product images
                    if ($product->image) {
                        // Only delete from storage if it's a storage file (not a public asset)
                        if (!str_starts_with($product->image, '/assets/')) {
                            Storage::disk('public')->delete($product->image);
                        }
                    }
                    
                    if ($product->images && is_array($product->images)) {
                        foreach ($product->images as $image) {
                            // Only delete from storage if it's a storage file (not a public asset)
                            if (!str_starts_with($image, '/assets/')) {
                                Storage::disk('public')->delete($image);
                            }
                        }
                    }
                }
                Product::whereIn('id', $productIds)->delete();
                $message = 'Products deleted successfully.';
                break;
            default:
                return back()->with('error', 'Invalid action.');
        }

        return back()->with('success', $message);
    }

    public function uploadImage(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $path = $request->file('image')->store('products', 'public');
        
        return response()->json([
            'success' => true,
            'path' => $path,
            'url' => asset('storage/' . $path)
        ]);
    }
} 