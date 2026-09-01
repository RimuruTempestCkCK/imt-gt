<?php

namespace App\Http\Controllers;

use App\Models\NewsPost;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index()
    {
        $news = NewsPost::where('status', 'published')->latest('published_at')->paginate(12);
        return view('public.news.index', compact('news'));
    }

    public function show($slug)
    {
        $newsItem = NewsPost::where('slug', $slug)->where('status', 'published')->firstOrFail();
        return view('public.news.show', compact('newsItem'));
    }
}
