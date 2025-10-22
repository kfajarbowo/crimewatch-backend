<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\Category;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cache;

class SitemapController extends Controller
{
    public function index()
    {
      
        return Cache::remember('sitemap_main', 3600, function () {
            $sitemap = '<?xml version="1.0" encoding="UTF-8"?>';
            $sitemap .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';
            
            // Home page
            $sitemap .= '<url>';
            $sitemap .= '<loc>' . url('/') . '</loc>';
            $sitemap .= '<lastmod>' . now()->format('Y-m-d') . '</lastmod>';
            $sitemap .= '<changefreq>daily</changefreq>';
            $sitemap .= '<priority>1.0</priority>';
            $sitemap .= '</url>';
            
            // Categories
            $categories = Category::all();
            foreach ($categories as $category) {
                $sitemap .= '<url>';
                $sitemap .= '<loc>' . route('category.detail', $category->slug) . '</loc>';
                $sitemap .= '<lastmod>' . $category->updated_at->format('Y-m-d') . '</lastmod>';
                $sitemap .= '<changefreq>weekly</changefreq>';
                $sitemap .= '<priority>0.8</priority>';
                $sitemap .= '</url>';
            }
            
            // Published News Articles 
            $news = News::where('status', 'published')
                ->orderBy('published_at', 'desc')
                ->limit(1000)
                ->get();
            foreach ($news as $article) {
                $sitemap .= '<url>';
                $sitemap .= '<loc>' . route('news.detail', $article->slug) . '</loc>';
                $sitemap .= '<lastmod>' . $article->updated_at->format('Y-m-d') . '</lastmod>';
                $sitemap .= '<changefreq>monthly</changefreq>';
           
                $priority = $article->is_featured ? '0.95' : '0.9';
                $sitemap .= '<priority>' . $priority . '</priority>';
                $sitemap .= '</url>';
            }
            
            $sitemap .= '</urlset>';
            
            return response($sitemap, 200)
                ->header('Content-Type', 'application/xml');
        });
    }
    
    public function news()
    {
        $sitemap = '<?xml version="1.0" encoding="UTF-8"?>';
        $sitemap .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';
        
        // Artikel yang terpublish only 
        $news = News::where('status', 'published')
            ->orderBy('published_at', 'desc')
            ->limit(1000)
            ->get();
            
        foreach ($news as $article) {
            $sitemap .= '<url>';
            $sitemap .= '<loc>' . route('news.detail', $article->slug) . '</loc>';
            $sitemap .= '<lastmod>' . $article->updated_at->format('Y-m-d') . '</lastmod>';
            $sitemap .= '<changefreq>monthly</changefreq>';
          
            $priority = $article->is_featured ? '0.95' : '0.9';
            $sitemap .= '<priority>' . $priority . '</priority>';
            $sitemap .= '</url>';
        }
        
        $sitemap .= '</urlset>';
        
        return response($sitemap, 200)
            ->header('Content-Type', 'application/xml');
    }
    
    public function categories()
    {
        $sitemap = '<?xml version="1.0" encoding="UTF-8"?>';
        $sitemap .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';
        
        // All Categories
        $categories = Category::all();
        foreach ($categories as $category) {
            $sitemap .= '<url>';
            $sitemap .= '<loc>' . route('category.detail', $category->slug) . '</loc>';
            $sitemap .= '<lastmod>' . $category->updated_at->format('Y-m-d') . '</lastmod>';
            $sitemap .= '<changefreq>weekly</changefreq>';
            $sitemap .= '<priority>0.8</priority>';
            $sitemap .= '</url>';
        }
        
        $sitemap .= '</urlset>';
        
        return response($sitemap, 200)
            ->header('Content-Type', 'application/xml');
    }
    
    public function sitemapIndex()
    {
        $sitemapIndex = '<?xml version="1.0" encoding="UTF-8"?>';
        $sitemapIndex .= '<sitemapindex xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';
        
        // Main sitemap
        $sitemapIndex .= '<sitemap>';
        $sitemapIndex .= '<loc>' . url('/sitemap.xml') . '</loc>';
        $sitemapIndex .= '<lastmod>' . now()->format('Y-m-d') . '</lastmod>';
        $sitemapIndex .= '</sitemap>';
        
        // News sitemap
        $sitemapIndex .= '<sitemap>';
        $sitemapIndex .= '<loc>' . url('/sitemap-news.xml') . '</loc>';
        $sitemapIndex .= '<lastmod>' . now()->format('Y-m-d') . '</lastmod>';
        $sitemapIndex .= '</sitemap>';
        
        // Categories sitemap
        $sitemapIndex .= '<sitemap>';
        $sitemapIndex .= '<loc>' . url('/sitemap-categories.xml') . '</loc>';
        $sitemapIndex .= '<lastmod>' . now()->format('Y-m-d') . '</lastmod>';
        $sitemapIndex .= '</sitemap>';
        
        $sitemapIndex .= '</sitemapindex>';
        
        return response($sitemapIndex, 200)
            ->header('Content-Type', 'application/xml');
    }
    
   
    public static function clearCache()
    {
        Cache::forget('sitemap_main');
        Cache::forget('sitemap_news');
        Cache::forget('sitemap_categories');
    }
}