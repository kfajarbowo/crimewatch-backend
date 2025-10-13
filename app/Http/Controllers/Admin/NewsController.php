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
        return view('admin.news.index', compact('news'));
    }

    public function show(News $news)
    {
        $news->load('category');
        return view('admin.news.show', compact('news'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.news.create', compact('categories'));
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
            'published_at' => 'nullable|date',
            'status' => 'required|in:draft,published,scheduled,archived',
            'tags' => 'nullable|string',
            'is_featured' => 'nullable|boolean'
        ]);

        $data = $request->all();
        $data['slug'] = Str::slug($request->title);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('news', 'public');
        }

        $news = News::create($data);

        return redirect()->route('admin.news.index')
            ->with('success', 'News created successfully.');
    }

    public function edit(News $news)
    {
        $categories = Category::all();
        return view('admin.news.edit', compact('news', 'categories'));
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
            'published_at' => 'nullable|date',
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
}