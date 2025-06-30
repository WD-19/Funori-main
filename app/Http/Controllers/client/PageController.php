<?php

namespace App\Http\Controllers\client;

use App\Models\Page;
use Illuminate\Http\Request;

class PageController
{
    /**
     * Display the page.
     */
    public function index(Request $request)
    {
        $posts = Page::with('author')
            ->where('status', 'published')
            ->where('page_type', 'blog_post')
            ->orderByDesc('published_at')
            ->get();

        return view('client.page.page', compact('posts'));
    }

    public function show($slug)
    {
        $post = Page::with('author')
            ->where('status', 'published')
            ->where('page_type', 'blog_post')
            ->where('slug', $slug)
            ->firstOrFail();

        return view('client.page.show', compact('post'));
    }
}
