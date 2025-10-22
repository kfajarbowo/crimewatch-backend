<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\News;
use App\Models\Video;
use App\Models\Category;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function show($slug)
    {
        $news = News::where('slug', $slug)->firstOrFail();

        // Increment views
        $news->increment('views');

        // Get related news using optimized method
        $relatedNews = $news->related_news;

        // Get popular news (only published)
        $popularNews = News::where('status', 'published')
            ->orderBy('views', 'desc')
            ->take(3)
            ->get();

        return view('frontend.pages.detail-news', compact('news', 'relatedNews', 'popularNews'));
    }

    public function category($slug)
    {
        $category = DB::table('categories')->where('slug', $slug)->first();

        if (!$category) {
            abort(404);
        }

        // Get news for this category (only published)
        $news = News::whereHas('category', function($q) use ($slug) {
            $q->where('slug', $slug);
        })->where('status', 'published')
        ->latest()
        ->paginate(12);

        $popularNews = News::where('status', 'published')
            ->orderBy('views', 'desc')
            ->take(5)
            ->get();

        return view('frontend.pages.detail-category', compact('category', 'news', 'popularNews'));
    }

    public function index()
    {
        // Only show published articles
        $featuredNews = News::where('is_featured', true)
                            ->where('status', 'published')
                            ->latest()
                            ->take(3)
                            ->get();
        $latestNews = News::where('status', 'published')
                            ->latest()
                            ->take(6)
                            ->get();
        $popularNews = News::where('status', 'published')
                            ->orderBy('views', 'desc')
                            ->take(4)
                            ->get();
        $latestVideos = Video::where('status', 'active')
                            ->latest()
                            ->take(4)
                            ->get();

        $categories = DB::table('categories')->get();

        $polriNews = News::whereHas('category', function($q) {
            $q->where('slug', 'polri');
        })->where('status', 'published')
                            ->latest()
                            ->take(3)
                            ->get();

        $kriminalNews = News::whereHas('category', function($q) {
            $q->where('slug', 'kriminal');
        })->where('status', 'published')
                            ->latest()
                            ->take(3)
                            ->get();

        $bhabinNews = News::whereHas('category', function($q) {
            $q->where('slug', 'bhabin');
        })->where('status', 'published')
                            ->latest()
                            ->take(5)
                            ->get();

        $lantasNews = News::whereHas('category', function($q) {
            $q->where('slug', 'lantas');
        })->where('status', 'published')
                            ->latest()
                            ->take(5)
                            ->get();

        $politikNews = News::whereHas('category', function($q) {
            $q->where('slug', 'politik');
        })->where('status', 'published')
                            ->latest()
                            ->take(5)
                            ->get();

        return view('frontend.home', compact(
            'featuredNews',
            'latestNews',
            'popularNews',
            'latestVideos',
            'categories',
            'polriNews',
            'kriminalNews',
            'bhabinNews',
            'lantasNews',
            'politikNews'
        ));
    }
}