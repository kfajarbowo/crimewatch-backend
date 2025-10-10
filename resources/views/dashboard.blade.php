@extends('frontend.layouts.app')

@section('content')
<main class="container mx-auto px-3 sm:px-4 lg:px-6 py-4 sm:py-6">
    <!-- Dashboard Header -->
    <div class="mb-6 sm:mb-8">
        <h1 class="text-2xl sm:text-3xl font-bold text-red-600 mb-2">Dashboard Admin</h1>
        <p class="text-gray-600">Selamat datang di panel administrasi CrimeWatch</p>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 sm:gap-6 mb-8">
        <!-- Categories Stats -->
        <div class="bg-white rounded-lg shadow-sm hover:shadow-md transition-shadow p-4 sm:p-6 border border-gray-200">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-sm sm:text-base font-medium text-gray-500 uppercase tracking-wide">Categories</h3>
                    <p class="text-2xl sm:text-3xl font-bold text-red-600 mt-2">{{ App\Models\Category::count() }}</p>
                </div>
                <div class="bg-red-100 p-3 rounded-full">
                    <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                    </svg>
                </div>
            </div>
            <a href="{{ route('admin.categories.index') }}" class="inline-flex items-center text-sm text-red-600 hover:text-red-800 mt-4 font-medium">
                View all categories
                <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
            </a>
        </div>

        <!-- News Stats -->
        <div class="bg-white rounded-lg shadow-sm hover:shadow-md transition-shadow p-4 sm:p-6 border border-gray-200">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-sm sm:text-base font-medium text-gray-500 uppercase tracking-wide">News</h3>
                    <p class="text-2xl sm:text-3xl font-bold text-red-600 mt-2">{{ App\Models\News::count() }}</p>
                </div>
                <div class="bg-red-100 p-3 rounded-full">
                    <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                    </svg>
                </div>
            </div>
            <a href="{{ route('admin.news.index') }}" class="inline-flex items-center text-sm text-red-600 hover:text-red-800 mt-4 font-medium">
                View all news
                <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
            </a>
        </div>

        <!-- Videos Stats -->
        <div class="bg-white rounded-lg shadow-sm hover:shadow-md transition-shadow p-4 sm:p-6 border border-gray-200">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-sm sm:text-base font-medium text-gray-500 uppercase tracking-wide">Videos</h3>
                    <p class="text-2xl sm:text-3xl font-bold text-red-600 mt-2">{{ App\Models\Video::count() }}</p>
                </div>
                <div class="bg-red-100 p-3 rounded-full">
                    <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                    </svg>
                </div>
            </div>
            <a href="{{ route('admin.videos.index') }}" class="inline-flex items-center text-sm text-red-600 hover:text-red-800 mt-4 font-medium">
                View all videos
                <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
            </a>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-4 sm:p-6 mb-8">
        <h2 class="text-lg sm:text-xl font-bold text-red-600 mb-4">Quick Actions</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
            <a href="{{ route('admin.news.create') }}" class="flex items-center p-3 bg-red-50 hover:bg-red-100 rounded-lg transition-colors group">
                <div class="bg-red-600 p-2 rounded-lg mr-3 group-hover:bg-red-700 transition-colors">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                    </svg>
                </div>
                <div>
                    <h3 class="font-medium text-gray-900">Create News</h3>
                    <p class="text-sm text-gray-500">Add new article</p>
                </div>
            </a>

            <a href="{{ route('admin.videos.create') }}" class="flex items-center p-3 bg-red-50 hover:bg-red-100 rounded-lg transition-colors group">
                <div class="bg-red-600 p-2 rounded-lg mr-3 group-hover:bg-red-700 transition-colors">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                    </svg>
                </div>
                <div>
                    <h3 class="font-medium text-gray-900">Add Video</h3>
                    <p class="text-sm text-gray-500">Upload TikTok video</p>
                </div>
            </a>

            <a href="{{ route('admin.categories.create') }}" class="flex items-center p-3 bg-red-50 hover:bg-red-100 rounded-lg transition-colors group">
                <div class="bg-red-600 p-2 rounded-lg mr-3 group-hover:bg-red-700 transition-colors">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                    </svg>
                </div>
                <div>
                    <h3 class="font-medium text-gray-900">New Category</h3>
                    <p class="text-sm text-gray-500">Create category</p>
                </div>
            </a>

            <a href="{{ route('admin.news.index') }}" class="flex items-center p-3 bg-red-50 hover:bg-red-100 rounded-lg transition-colors group">
                <div class="bg-red-600 p-2 rounded-lg mr-3 group-hover:bg-red-700 transition-colors">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                    </svg>
                </div>
                <div>
                    <h3 class="font-medium text-gray-900">Manage Content</h3>
                    <p class="text-sm text-gray-500">Edit & organize</p>
                </div>
            </a>
        </div>
    </div>

    <!-- Recent Activity -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-4 sm:p-6">
        <h2 class="text-lg sm:text-xl font-bold text-red-600 mb-4">Recent Activity</h2>
        <div class="space-y-4">
            @php
                $recentNews = App\Models\News::latest()->take(5)->get();
            @endphp
            
            @if($recentNews->count() > 0)
                @foreach($recentNews as $news)
                    <div class="flex items-start space-x-3 p-3 bg-gray-50 rounded-lg">
                        <div class="w-10 h-10 bg-red-100 rounded-full flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                            </svg>
                        </div>
                        <div class="flex-1 min-w-0">
                            <h4 class="text-sm font-medium text-gray-900 line-clamp-1">{{ $news->title }}</h4>
                            <p class="text-xs text-gray-500 mt-1">
                                Created {{ $news->created_at->diffForHumans() }} • 
                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                    {{ $news->category->name ?? 'Uncategorized' }}
                                </span>
                            </p>
                        </div>
                        <a href="{{ route('admin.news.edit', $news->id) }}" class="text-red-600 hover:text-red-800 text-sm font-medium">
                            Edit
                        </a>
                    </div>
                @endforeach
            @else
                <div class="text-center py-8">
                    <svg class="w-12 h-12 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                    </svg>
                    <p class="text-gray-500">No recent activity</p>
                    <a href="{{ route('admin.news.create') }}" class="text-red-600 hover:text-red-800 text-sm font-medium mt-2 inline-block">
                        Create your first news article
                    </a>
                </div>
            @endif
        </div>
    </div>
</main>
@endsection