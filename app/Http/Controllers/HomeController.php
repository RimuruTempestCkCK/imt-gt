<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Greeting;
use App\Models\NewsPost;
use App\Models\ProfileSection;
use App\Models\Setting;
use Illuminate\Support\Facades\Schema;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function __invoke(): View
    {
        $hasCms = Schema::hasTable('banners') && Schema::hasTable('news_posts') && Schema::hasTable('profile_sections');

        return view('public.home', [
            'siteSettings' => Schema::hasTable('settings') ? Setting::pairs(true) : [],
            'banners' => $hasCms ? Banner::query()->with('media')->where('is_active', true)->orderBy('sort_order')->take(3)->get() : collect(),
            'greeting' => Schema::hasTable('greetings') ? Greeting::query()->where('is_active', true)->orderBy('sort_order')->first() : null,
            'featuredNews' => $hasCms ? NewsPost::query()->with(['category', 'tags', 'media'])->where('status', 'published')->where('featured', true)->latest('published_at')->take(3)->get() : collect(),
            'latestNews' => $hasCms ? NewsPost::query()->with(['category', 'tags', 'media'])->where('status', 'published')->latest('published_at')->take(6)->get() : collect(),
            'profileSections' => $hasCms ? ProfileSection::query()->with('media')->where('is_active', true)->orderBy('sort_order')->get() : collect(),
        ]);
    }
}
