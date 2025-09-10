<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Setting;
use Illuminate\Support\Facades\Log;

class ProductsController extends Controller
{
   public function index(Request $request)
    {
        $query = Product::with('category')->active()->inStock();
        
        // Category filter
        if ($request->filled('category')) {
            $categorySlug = $request->category;
            $query->whereHas('category', function($q) use ($categorySlug) {
                $q->where('slug', $categorySlug);
            });

            // Get category name for page title
            $category = Category::where('slug', $categorySlug)->first();
            $pageTitle = $category ? $category->name : 'Products'; // Default title if category not found
        } else {
            $category = Category::where('slug', "washing-machines")->first();
            $pageTitle = 'All Products'; // Default title for all products
        }
        
        // Search filter
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                ->orWhere('description', 'like', "%{$search}%")
                ->orWhereHas('category', function($catQuery) use ($search) {
                    $catQuery->where('name', 'like', "%{$search}%");
                });
            });
        }
        
        // Price filter
        if ($request->filled('min_price')) {
            $query->where('price', '>=', $request->min_price);
        }
        if ($request->filled('max_price')) {
            $query->where('price', '<=', $request->max_price);
        }

        $show_product_filters = Setting::get('show_product_filters');
        

        // Rating filter
        if ($request->filled('rating')) {
            $query->where('rating', '>=', $request->rating);
        }
        
        // Sort products
        $sortBy = $request->get('sort', 'latest');
        switch ($sortBy) {
            case 'price_low':
                $query->orderBy('price', 'asc');
                break;
            case 'price_high':
                $query->orderBy('price', 'desc');
                break;
            case 'rating':
                $query->orderBy('rating', 'desc')->orderBy('reviews_count', 'desc');
                break;
            case 'popular':
                $query->orderBy('reviews_count', 'desc');
                break;
            case 'name':
                $query->orderBy('name', 'asc');
                break;
            default:
                $query->latest();
                break;
        }
        
        // Get all categories for filter sidebar
        $categories = Category::active()->ordered()->get();
        
        // Get featured products for sidebar
        $featuredProducts = Product::with('category')
            ->active()
            ->featured()
            ->inStock()
            ->limit(4)
            ->get();
        
        // Paginate products
        $products = $query->paginate(12)->withQueryString();
        
        // Get filter stats
        $totalProducts = $query->count();
        $minPrice = Product::active()->min('price');
        $maxPrice = Product::active()->max('price');
        
        return view('products.index', compact(
            'products',
            'show_product_filters',
            'categories',
            'featuredProducts',
            'totalProducts',
            'minPrice',
            'category',
            'maxPrice',
            'pageTitle' // Pass the page title to the view
        ));
    }

    
    public function show($slug)
    {
        $product = Product::with('category')
            ->active()
            ->where('slug', $slug)
            ->firstOrFail();
            
        // Get related products
        $relatedProducts = Product::with('category')
            ->active()
            ->inStock()
            ->where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->limit(4)
            ->get();
        
        // Pass category name as page title
        // $pageTitle = $product->category->name; // Assuming 'name' is the column holding the category name

        return view('products.show', compact('product', 'relatedProducts'));
    }

    public function getSpecifications(Product $product)
    {
        return response()->json([
            'specifications' => $product->specifications,
        ]);
    }

   public function uploadImage(Request $request)
    {
        // Log the incoming request data for debugging
        Log::info('Upload Image Request:', $request->all());

        // Validate the uploaded file (ensure it's an image and matches the allowed formats)
        $validated = $request->validate([
            'upload' => 'required|image|mimes:jpg,jpeg,png,gif|max:2048'
        ]);

        // Check if a file was uploaded
        if ($request->hasFile('upload')) {
            $file = $request->file('upload');

            // Store the image in 'public/uploads/products' directory under the 'public' disk
            $path = $file->store('uploads/products', 'public');  // This stores the file in public/storage/uploads/products

            // Return the file URL, making sure it points to the public storage
            return response()->json([
                'uploaded' => true,
                'fileName' => $file->getClientOriginalName(),
                'url' => asset('storage/' . $path)  // Return URL accessible publicly
            ]);
        }

        // If no file was uploaded, return an error response
        return response()->json(['uploaded' => false], 400);
    }



} 