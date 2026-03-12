<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use App\Models\BlogSetting;
use Illuminate\Http\Request;

class BlogPostController extends Controller
{
    public function index(Request $request)
    {
        $blogSettings = BlogSetting::first() ?? new BlogSetting();
        
        $query = BlogPost::published()->ordered();

        // Filter by category if selected
        if ($request->has('category') && $request->category) {
            $query->where('category', $request->category);
        }

        $posts = $query->paginate(12);
        
        $recentPosts = BlogPost::published()
            ->orderBy('published_at', 'desc')
            ->limit($blogSettings->recent_posts_count ?? 5)
            ->get();
        
        $categories = BlogPost::published()
            ->distinct()
            ->pluck('category')
            ->filter()
            ->sort();
        
        return view('pages.blog.index', compact(
            'posts',
            'recentPosts',
            'categories',
            'blogSettings'
        ));
    }

    public function show($slug)
    {
        $post = BlogPost::published()->where('slug', $slug)->firstOrFail();
        $post->incrementViews();
        
        $relatedPosts = BlogPost::published()
            ->where('id', '!=', $post->id)
            ->where('category', $post->category)
            ->orderBy('published_at', 'desc')
            ->limit(3)
            ->get();
        
        return view('pages.blog.show', compact('post', 'relatedPosts'));
    }
}
