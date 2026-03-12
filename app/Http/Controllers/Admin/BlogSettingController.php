<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlogSetting;
use Illuminate\Http\Request;

class BlogSettingController extends Controller
{
    public function edit()
    {
        $settings = BlogSetting::first() ?? BlogSetting::create([
            'show_sidebar' => 1,
            'show_recent_posts' => 1,
            'show_categories' => 1,
            'recent_posts_count' => 5,
        ]);

        return view('admin.blog-settings.edit', compact('settings'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'show_sidebar' => 'nullable|boolean',
            'show_recent_posts' => 'nullable|boolean',
            'show_categories' => 'nullable|boolean',
            'recent_posts_count' => 'required|integer|min:3|max:20',
        ]);

        $validated['show_sidebar'] = $request->has('show_sidebar') ? 1 : 0;
        $validated['show_recent_posts'] = $request->has('show_recent_posts') ? 1 : 0;
        $validated['show_categories'] = $request->has('show_categories') ? 1 : 0;

        $settings = BlogSetting::first();
        
        if ($settings) {
            $settings->update($validated);
        } else {
            BlogSetting::create($validated);
        }

        return redirect()->route('admin.blog-settings.edit')
            ->with('success', 'Blog settings updated successfully.');
    }
}
