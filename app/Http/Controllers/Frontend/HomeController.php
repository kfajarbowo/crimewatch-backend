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

        // Get related news from same category
        $relatedNews = News::where('category_id', $news->category_id)
            ->where('id', '!=', $news->id)
            ->latest()
            ->take(6)
            ->get();

        // Get popular news
        $popularNews = News::orderBy('views', 'desc')
            ->take(3)
            ->get();

        return view('frontend.pages.detail-news', compact('news', 'relatedNews', 'popularNews'));
    }
    public function index()
    {
        $featuredNews = News::where('is_featured', true)->latest()->take(3)->get();
        $latestNews = News::latest()->take(6)->get();
        $popularNews = News::orderBy('views', 'desc')->take(4)->get();
        $latestVideos = Video::latest()->take(4)->get();
        
        // Gunakan query builder untuk menghindari soft delete
        $categories = DB::table('categories')->get();

        // Get news by category
        $polriNews = News::whereHas('category', function($q) {
            $q->where('slug', 'polri');
        })->latest()->take(3)->get();

        $kriminalNews = News::whereHas('category', function($q) {
            $q->where('slug', 'kriminal');
        })->latest()->take(3)->get();

        $bhabinNews = News::whereHas('category', function($q) {
            $q->where('slug', 'bhabin');
        })->latest()->take(5)->get();

        $lantasNews = News::whereHas('category', function($q) {
            $q->where('slug', 'lantas');
        })->latest()->take(5)->get();

        $politikNews = News::whereHas('category', function($q) {
            $q->where('slug', 'politik');
        })->latest()->take(5)->get();

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