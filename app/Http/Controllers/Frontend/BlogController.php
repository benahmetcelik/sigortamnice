<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index()
    {
        return view('themes.NiceTheme.blog');
    }

    public function detail($slug)
    {
        $blog = Blog::where('slug', $slug)->firstOrFail();
        return view('themes.NiceTheme.blog-detail', compact('blog'));
    }
} 