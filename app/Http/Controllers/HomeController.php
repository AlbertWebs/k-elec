<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\CarouselSlide;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $categories = Category::active()->ordered()->get();
        
        $carouselSlides = CarouselSlide::active()->ordered()->get();
        
        $trendingProducts = Product::with('category')
            ->active()
            ->inStock()
            ->orderBy('rating', 'desc')
            ->orderBy('reviews_count', 'desc')
            ->limit(8)
            ->get();
            
        $featuredProducts = Product::with('category')
            ->active()
            ->featured()
            ->inStock()
            ->limit(3)
            ->get();
            
        $topSellers = Product::with('category')
            ->active()
            ->inStock()
            ->orderBy('reviews_count', 'desc')
            ->limit(3)
            ->get();
            
        $recentProducts = Product::with('category')
            ->active()
            ->inStock()
            ->latest()
            ->limit(3)
            ->get();

        return view('home', compact(
            'categories',
            'carouselSlides',
            'trendingProducts',
            'featuredProducts',
            'topSellers',
            'recentProducts'
        ));
    }
}
