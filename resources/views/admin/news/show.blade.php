@extends('frontend.layouts.app')

@section('content')
<main class="container mx-auto px-3 sm:px-4 lg:px-6 py-4 sm:py-6">
    <!-- Header Section -->
    <div class="mb-6 sm:mb-8">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h1 class="text-2xl sm:text-3xl font-bold text-red-600 mb-2">Preview Article</h1>
                <p class="text-gray-600">Admin view of the news article</p>
            </div>
            <div class="mt-4 sm:mt-0 flex space-x-3">
                <a href="{{ route('admin.news.edit', $news->id) }}" 
                   class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-lg font-medium text-sm text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                    </svg>
                    Edit Article
                </a>
                <a href="{{ route('admin.news.index') }}" 
                   class="inline-flex items-center px-4 py-2 bg-gray-500 border border-transparent rounded-lg font-medium text-sm text-white hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition-colors">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    Back to News
                </a>
            </div>
        </div>
    </div>

    <!-- Article Status Badge -->
    <div class="mb-6">
        @php
            $statusColors = [
                'published' => 'bg-green-100 text-green-800 border-green-200',
                'draft' => 'bg-yellow-100 text-yellow-800 border-yellow-200',
                'archived' => 'bg-gray-100 text-gray-800 border-gray-200'
            ];
            $statusColor = $statusColors[$news->status] ?? 'bg-gray-100 text-gray-800 border-gray-200';
        @endphp
        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium border {{ $statusColor }}">
            {{ ucfirst($news->status) }}
        </span>
        @if($news->is_featured)
            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-red-100 text-red-800 border border-red-200 ml-2">
                Featured
            </span>
        @endif
    </div>

    <!-- Article Content -->
    <article class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
        <!-- Article Header -->
        <div class="p-6 sm:p-8 border-b border-gray-200">
            <div class="flex items-center space-x-2 mb-4">
                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-red-100 text-red-800">
                    {{ $news->category->name ?? 'Uncategorized' }}
                </span>
                @if($news->location)
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-gray-100 text-gray-800">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                        {{ $news->location }}
                    </span>
                @endif
            </div>
            
            <h1 class="text-2xl sm:text-3xl lg:text-4xl font-bold text-gray-900 mb-4 leading-tight">
                {{ $news->title }}
            </h1>
            
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between text-sm text-gray-500 space-y-2 sm:space-y-0">
                <div class="flex items-center space-x-4">
                    <span class="flex items-center">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                        {{ $news->author ?? 'Anonymous' }}
                    </span>
                    <span class="flex items-center">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        {{ $news->created_at->locale('id')->translatedFormat('l, d F Y - H:i') }} WIB
                    </span>
                </div>
                <div class="flex items-center space-x-2">
                    <span class="flex items-center">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                        </svg>
                        {{ $news->views }} views
                    </span>
                </div>
            </div>
        </div>

        <!-- Article Image -->
        @if($news->image)
            <div class="aspect-video bg-gray-100">
                <img src="{{ $news->image_url }}" 
                     alt="{{ $news->title }}" 
                     class="w-full h-full object-cover">
            </div>
        @endif

        <!-- Article Content -->
        <div class="p-6 sm:p-8">
            <div class="prose prose-lg max-w-none">
                {!! $news->rendered_content !!}
            </div>

            <!-- Tags -->
            @if($news->tags)
                <div class="mt-8 pt-6 border-t border-gray-200">
                    <h3 class="text-sm font-medium text-gray-900 mb-3">Tags:</h3>
                    <div class="flex flex-wrap gap-2">
                        @foreach(explode(',', $news->tags) as $tag)
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                {{ trim($tag) }}
                            </span>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>

        <!-- Admin Actions Footer -->
        <div class="px-6 sm:px-8 py-4 bg-gray-50 border-t border-gray-200">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between space-y-3 sm:space-y-0">
                <div class="text-sm text-gray-500">
                    <p>Created: {{ $news->created_at->locale('id')->translatedFormat('l, d F Y - H:i') }} WIB</p>
                    @if($news->updated_at != $news->created_at)
                        <p>Last updated: {{ $news->updated_at->locale('id')->translatedFormat('l, d F Y - H:i') }} WIB</p>
                    @endif
                </div>
                <div class="flex space-x-3">
                    <a href="{{ route('news.detail', $news->slug) }}" 
                       class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-lg font-medium text-sm text-white hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition-colors" 
                       target="_blank">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                        </svg>
                        View Public
                    </a>
                    <a href="{{ route('admin.news.edit', $news->id) }}" 
                       class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-lg font-medium text-sm text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                        </svg>
                        Edit Article
                    </a>
                    <form action="{{ route('admin.news.destroy', $news->id) }}" 
                          method="POST" 
                          class="inline-block">
                        @csrf
                        @method('DELETE')
                        <button type="submit" 
                                onclick="return confirm('Are you sure you want to delete this article? This action cannot be undone.')"
                                class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-lg font-medium text-sm text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition-colors">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                            </svg>
                            Delete Article
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </article>
</main>
@endsection

@push('styles')
<style>
    .prose {
        color: #374151;
        line-height: 1.7;
    }
    .prose h1, .prose h2, .prose h3, .prose h4, .prose h5, .prose h6 {
        color: #111827;
        font-weight: 700;
        margin-top: 2rem;
        margin-bottom: 1rem;
    }
    .prose h1 {
        font-size: 2.25rem;
        line-height: 1.2;
    }
    .prose h2 {
        font-size: 1.875rem;
        line-height: 1.3;
    }
    .prose h3 {
        font-size: 1.5rem;
        line-height: 1.4;
    }
    .prose p {
        margin-bottom: 1.5rem;
    }
    .prose ul, .prose ol {
        margin-bottom: 1.5rem;
        padding-left: 1.5rem;
    }
    .prose li {
        margin-bottom: 0.5rem;
    }
    .prose blockquote {
        border-left: 4px solid #dc2626;
        background-color: #fef2f2;
        padding: 1rem 1.5rem;
        margin: 2rem 0;
        font-style: italic;
        color: #374151;
    }
    .prose blockquote p {
        margin-bottom: 0;
    }
    .prose img {
        border-radius: 0.5rem;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
    }
    .prose a {
        color: #dc2626;
        text-decoration: underline;
    }
    .prose a:hover {
        color: #b91c1c;
    }
</style>
@endpush
