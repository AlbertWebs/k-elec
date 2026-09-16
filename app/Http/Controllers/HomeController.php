<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\CarouselSlide;
use Illuminate\Http\Request;
use App\Models\Banner;
use App\Models\Showroom;
use App\Models\HomepageVideo;
use App\Models\BrandShop;

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
            ->limit(4)
            ->get();

        $showrooms = Showroom::where('featured', 1)->where('is_active', 1)->limit('4')->get();

        // Get featured brand shops (limit to 3 for the home page)
        $shops = BrandShop::where('is_active', 1)->ordered()->limit(3)->get();

        //get banner position 1
        $bannerPosition1 = Banner::where('position', 1)->first();
        $bannerPosition2 = Banner::where('position', 2)->first();

        $homepageVideo = \Illuminate\Support\Facades\Schema::hasTable('homepage_videos')
            ? HomepageVideo::query()->first()
            : null;

        $featuredProducts = Product::with('category')
            ->active()
            ->featured()
            ->inStock()
            ->limit(4)
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
            'recentProducts',
            'bannerPosition1',
            'bannerPosition2',
            'showrooms',
            'homepageVideo',
            'shops'
        ));
    }
}
