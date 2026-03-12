<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlogPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BlogPostController extends Controller
{
    public function index()
    {
        $posts = BlogPost::ordered()->paginate(15);
        $publishedCount = BlogPost::published()->count();
        $draftCount = BlogPost::where('is_published', 0)->count();
        
        return view('admin.blog-posts.index', compact('posts', 'publishedCount', 'draftCount'));
    }

    public function create()
    {
        return view('admin.blog-posts.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'excerpt' => 'nullable|string|max:500',
            'content' => 'required|string',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'author' => 'nullable|string|max:100',
            'category' => 'nullable|string|max:100',
            'reading_time' => 'nullable|integer|min:1',
            'is_published' => 'nullable|boolean',
        ]);

        $validated['slug'] = Str::slug($validated['title']);
        
        // Check if slug already exists
        $existingSlug = BlogPost::where('slug', $validated['slug'])->exists();
        if ($existingSlug) {
            $validated['slug'] = $validated['slug'] . '-' . time();
        }

        // Handle featured image upload
        if ($request->hasFile('featured_image')) {
            $validated['featured_image'] = $request->file('featured_image')->store('blog-posts', 'public');
        }

        // Calculate reading time if not provided
        if (!$validated['reading_time']) {
            $wordCount = str_word_count(strip_tags($validated['content']));
            $validated['reading_time'] = max(1, ceil($wordCount / 200)); // 200 words per minute
        }

        // Handle publish status
        $isPublished = $request->has('is_published');
        $validated['is_published'] = $isPublished ? 1 : 0;
        $validated['published_at'] = $isPublished ? now() : null;

        BlogPost::create($validated);

        return redirect()->route('admin.blog-posts.index')->with('success', 'Blog post created successfully.');
    }

    public function show(BlogPost $blogPost)
    {
        return view('admin.blog-posts.show', compact('blogPost'));
    }

    public function edit(BlogPost $blogPost)
    {
        return view('admin.blog-posts.edit', compact('blogPost'));
    }

    public function update(Request $request, BlogPost $blogPost)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'excerpt' => 'nullable|string|max:500',
            'content' => 'required|string',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'author' => 'nullable|string|max:100',
            'category' => 'nullable|string|max:100',
            'reading_time' => 'nullable|integer|min:1',
            'is_published' => 'nullable|boolean',
        ]);

        $validated['slug'] = Str::slug($validated['title']);
        
        // Check if slug already exists (excluding current post)
        $existingSlug = BlogPost::where('slug', $validated['slug'])
            ->where('id', '!=', $blogPost->id)
            ->exists();
        if ($existingSlug) {
            $validated['slug'] = $validated['slug'] . '-' . time();
        }

        if ($request->hasFile('featured_image')) {
            if ($blogPost->featured_image) {
                Storage::disk('public')->delete($blogPost->featured_image);
            }
            $validated['featured_image'] = $request->file('featured_image')->store('blog-posts', 'public');
        }

        if (!$validated['reading_time']) {
            $wordCount = str_word_count(strip_tags($validated['content']));
            $validated['reading_time'] = max(1, ceil($wordCount / 200));
        }

        // Handle publish status
        $isPublished = $request->has('is_published');
        $validated['is_published'] = $isPublished ? 1 : 0;
        $validated['published_at'] = $isPublished ? ($blogPost->published_at ?? now()) : null;

        $blogPost->update($validated);

        return redirect()->route('admin.blog-posts.index')->with('success', 'Blog post updated successfully.');
    }

    public function destroy(BlogPost $blogPost)
    {
        if ($blogPost->featured_image) {
            Storage::disk('public')->delete($blogPost->featured_image);
        }
        $blogPost->delete();

        return back()->with('success', 'Blog post deleted successfully.');
    }

    public function togglePublish(BlogPost $blogPost)
    {
        $blogPost->update([
            'is_published' => !$blogPost->is_published,
            'published_at' => !$blogPost->is_published ? now() : null
        ]);
        
        return back()->with('success', 'Post status updated successfully.');
    }

    public function updateOrder(Request $request)
    {
        $posts = $request->input('posts', []);
        foreach ($posts as $index => $postId) {
            BlogPost::find($postId)->update(['order' => $index]);
        }

        return response()->json(['success' => true]);
    }
}
