<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Showroom;

class PageController extends Controller
{
    public function contact()
    {
        return view('pages.contact');
    }

    public function about()
    {
        $showrooms = Showroom::where('featured', 1)->where('is_active', 1)->limit('4')->get();
        return view('pages.about-backup', compact('showrooms'));
    }

      public function k_elec()
    {
        $showrooms = Showroom::where('featured', 1)->where('is_active', 1)->limit('4')->get();
        return view('pages.about', compact('showrooms'));
    }

    

    public function showrooms()
    {
        $showrooms = Showroom::all();
        return view('pages.showrooms', compact('showrooms'));
    }

    public function technicalSupport()
    {
        return view('pages.technical-support');
    }

    public function shippingReturns()
    {
        return view('pages.shipping-returns');
    }

    public function faq()
    {
        $faqs = \App\Models\Faq::active()->ordered()->get()->groupBy('category');
        return view('pages.faq', compact('faqs'));
    }

    public function privacy()
    {
        return view('pages.privacy');
    }
} 