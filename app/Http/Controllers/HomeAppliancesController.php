<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class HomeAppliancesController extends Controller
{
    public function index(Request $request)
    {
        // Get all categories (no filtering by specific category)
        $allCategories = Category::active()->ordered()->get();
        
        $query = Product::with('category')
            ->active()
            ->inStock();
        
        // Category filter - allow filtering by ANY category
        if ($request->filled('category')) {
            $categorySlug = $request->category;
            $query->whereHas('category', function($q) use ($categorySlug) {
                $q->where('slug', $categorySlug);
            });
        }
        
        // Search filter
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                  ->orWhere('description', 'like', '%' . $search . '%')
                  ->orWhere('brand', 'like', '%' . $search . '%');
            });
        }
        
        // Brand filter
        if ($request->filled('brand')) {
            $query->where('brand', $request->brand);
        }
        
        // Sorting
        $sort = $request->sort ?? 'latest';
        switch($sort) {
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
        
        // Get available brands from all products
        $brands = Product::active()
            ->distinct()
            ->pluck('brand')
            ->filter()
            ->sort()
            ->values();
        
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
        $minPrice = Product::active()->min('price') ?? 0;
        $maxPrice = Product::active()->max('price') ?? 0;
        
        // Get selected category for display
        $selectedCategory = null;
        if ($request->filled('category')) {
            $selectedCategory = Category::where('slug', $request->category)->first();
        }
        
        return view('home-appliances.index', compact(
            'products',
            'allCategories',
            'selectedCategory',
            'brands',
            'featuredProducts',
            'totalProducts',
            'minPrice',
            'maxPrice'
        ));
    }
}
