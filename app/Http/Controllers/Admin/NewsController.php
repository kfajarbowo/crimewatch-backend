<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\News;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class NewsController extends Controller
{
    public function index()
    {
        $news = News::with('category')
                   ->latest()
                   ->paginate(10); // Show 10 news per page
        return view('backend.admin.news.index', compact('news'));
    }

    public function show(News $news)
    {
        $news->load('category');
        return view('backend.admin.news.show', compact('news'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('backend.admin.news.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'title' => 'required|string|max:255|unique:news',
            'content' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'author' => 'required|string|max:255',
            'location' => 'nullable|string|max:255',
            'published_at' => 'nullable|date|required_if:status,scheduled',
            'status' => 'required|in:draft,published,scheduled,archived',
            'tags' => 'nullable|string',
            'is_featured' => 'nullable|boolean'
        ]);

        $data = $request->all();
        $data['slug'] = Str::slug($request->title);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('news', 'public');
        }

       
        if (($data['status'] ?? null) === 'published' && empty($data['published_at'])) {
            $data['published_at'] = now();
        }

        $news = News::create($data);

        return redirect()->route('admin.news.index')
            ->with('success', 'News created successfully.');
    }

    public function edit(News $news)
    {
        $categories = Category::all();
        return view('backend.admin.news.edit', compact('news', 'categories'));
    }

    public function update(Request $request, News $news)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'title' => 'required|string|max:255|unique:news,title,' . $news->id,
            'content' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'author' => 'required|string|max:255',
            'location' => 'nullable|string|max:255',
            'published_at' => 'nullable|date|required_if:status,scheduled',
            'status' => 'required|in:draft,published,scheduled,archived',
            'tags' => 'nullable|string',
            'is_featured' => 'nullable|boolean'
        ]);

        $data = $request->all();
        $data['slug'] = Str::slug($request->title);

        if ($request->hasFile('image')) {
            // Delete old image
            if ($news->image) {
                Storage::disk('public')->delete($news->image);
            }
            $data['image'] = $request->file('image')->store('news', 'public');
        }

        if (($data['status'] ?? null) === 'published' && empty($data['published_at'])) {
            $data['published_at'] = now();
        }

        $news->update($data);


        return redirect()->route('admin.news.index')
            ->with('success', 'News updated successfully.');
    }

    public function destroy(News $news)
    {
        if ($news->image) {
            Storage::disk('public')->delete($news->image);
        }

        $news->delete();

        return redirect()->route('admin.news.index')
            ->with('success', 'News deleted successfully.');
    }

    public function publishScheduled()
    {
        $now = now();
        
        // Find all scheduled news that should be published now or earlier
        $scheduledNews = News::where('status', 'scheduled')
            ->whereNotNull('published_at')
            ->where('published_at', '<=', $now)
            ->get();
        
        if ($scheduledNews->isEmpty()) {
            return redirect()->route('admin.news.index')
                ->with('info', 'No scheduled news ready for publishing at this time.');
        }

        $publishedCount = 0;
        foreach ($scheduledNews as $news) {
            $news->update(['status' => 'published']);
            $publishedCount++;
        }

        return redirect()->route('admin.news.index')
            ->with('success', "Published {$publishedCount} scheduled news articles that were ready for publishing.");
    }

    public function testScheduler()
    {
      
        $now = now();
        
      
        $allScheduled = News::where('status', 'scheduled')->get();
        
        
        $readyToPublish = News::where('status', 'scheduled')
            ->whereNotNull('published_at')
            ->where('published_at', '<=', $now)
            ->get();
        
        $message = "=== SCHEDULER TEST ===\n";
        $message .= "Current time: " . $now . "\n";
        $message .= "Total scheduled news: " . $allScheduled->count() . "\n";
        $message .= "Ready to publish: " . $readyToPublish->count() . "\n\n";
        
        if ($allScheduled->count() > 0) {
            $message .= "Scheduled Articles:\n";
            foreach ($allScheduled as $news) {
                $publishedAt = $news->published_at ? $news->published_at->format('Y-m-d H:i:s') : 'NULL';
                $isReady = $news->published_at && $news->published_at <= $now ? 'YES' : 'NO';
                $message .= "- {$news->title}\n";
                $message .= "  Published At: {$publishedAt}\n";
                $message .= "  Ready: {$isReady}\n\n";
            }
        }
        

        if ($readyToPublish->count() > 0) {
            $publishedCount = 0;
            foreach ($readyToPublish as $news) {
                $news->update(['status' => 'published']);
                $publishedCount++;
            }
            $message .= "Published {$publishedCount} articles automatically!";
        } else {
            $message .= "No articles ready for publishing at this time.";
        }
        
        return redirect()->route('admin.news.index')
            ->with('info', $message);
    }

}