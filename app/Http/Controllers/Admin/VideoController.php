<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Video;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class VideoController extends Controller
{
    public function index()
    {
        $videos = Video::with('category')
                      ->latest()
                      ->paginate(2); // Show 2 videos per page
        return view('admin.videos.index', compact('videos'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.videos.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'title' => 'required|string|max:255|unique:videos',
            'description' => 'nullable|string',
            'tiktok_embed_code' => [
                'required',
                'string',
                function ($attribute, $value, $fail) {
                    if (!str_contains($value, '<blockquote class="tiktok-embed"')) {
                        $fail('The TikTok embed code is invalid. Please use the official TikTok embed code.');
                    }
                },
            ],
            'author' => 'required|string|max:255',
            'status' => 'required|in:active,inactive'
        ]);

        $data = $request->all();
        $data['slug'] = Str::slug($request->title);

        Video::create($data);

        return redirect()->route('admin.videos.index')
            ->with('success', 'Video created successfully.');
    }

    public function edit(Video $video)
    {
        $categories = Category::all();
        return view('admin.videos.edit', compact('video', 'categories'));
    }

    public function update(Request $request, Video $video)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'title' => 'required|string|max:255|unique:videos,title,' . $video->id,
            'description' => 'nullable|string',
            'tiktok_embed_code' => [
                'required',
                'string',
                function ($attribute, $value, $fail) {
                    if (!str_contains($value, '<blockquote class="tiktok-embed"')) {
                        $fail('The TikTok embed code is invalid. Please use the official TikTok embed code.');
                    }
                },
            ],
            'author' => 'required|string|max:255',
            'status' => 'required|in:active,inactive'
        ]);

        $data = $request->all();
        $data['slug'] = Str::slug($request->title);

        $video->update($data);

        return redirect()->route('admin.videos.index')
            ->with('success', 'Video updated successfully.');
    }

    public function destroy(Video $video)
    {
        $video->delete();

        return redirect()->route('admin.videos.index')
            ->with('success', 'Video deleted successfully.');
    }
}