@extends('frontend.layouts.app')

@section('page-title', 'Berita ' . ucfirst($category->name) . ' - CrimeWatch.ID')
@section('meta-description', $category->description ?: 'Baca berita terkini tentang ' . $category->name . ' di CrimeWatch.ID. Portal berita kriminal terpercaya dengan informasi terbaru tentang penegakan hukum dan keamanan masyarakat.')
@section('meta-keywords', 'berita ' . $category->name . ', ' . $category->name . ', kriminal, kejahatan, polisi, hukum, keamanan')
@section('canonical-url', route('category.detail', $category->slug))

@section('og-title', 'Berita ' . ucfirst($category->name) . ' - CrimeWatch.ID')
@section('og-description', $category->description ?: 'Baca berita terkini tentang ' . $category->name . ' di CrimeWatch.ID. Portal berita kriminal terpercaya.')
@section('og-type', 'website')

@section('content')
<main class="container mx-auto px-3 sm:px-4 lg:px-6 py-4 sm:py-6">
    <!-- Breadcrumb -->
    <div class="flex items-center text-sm text-gray-500 mb-4">
        <a href="{{ url('/') }}" class="hover:text-red-600">News</a>
        <span class="mx-2">/</span>
        <span class="text-red-600">{{ strtoupper($category->name) }}</span>
    </div>

    <!-- Main Grid Layout -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 sm:gap-8">
        <!-- Main Content Column -->
        <div class="col-span-1 lg:col-span-8">
            <!-- Category Title -->
            <div class="flex items-center justify-between mb-6">
                <h1 class="text-2xl sm:text-3xl font-bold">
                    <span class="text-red-600 border-b-2 border-yellow-500 pb-1">{{ strtoupper($category->name) }}</span>
                </h1>
            </div>

            <!-- Article Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-6">
                @foreach($news as $article)
                <article class="bg-white rounded-lg overflow-hidden shadow-sm group hover:bg-gray-50 hover:shadow-md transition-all">
                    <a href="{{ route('news.detail', $article->slug) }}" class="block">
                        <div class="bg-gray-300 aspect-video">
                            <img src="{{ $article->image_url }}" alt="{{ $article->title }}" class="w-full h-full object-cover" loading="lazy">
                        </div>
                        <div class="p-4">
                            <span class="inline-block text-red-600 font-medium text-xs border-b-2 border-yellow-500 pb-1">{{ strtoupper($category->name) }}</span>
                            <h3 class="font-bold text-sm sm:text-base mt-2 mb-2 group-hover:text-red-600 transition-colors line-clamp-2">{{ $article->title }}</h3>
                            <p class="text-xs text-gray-500">{{ $article->created_at->translatedFormat('d F Y') }} - {{ $article->author }}</p>
                        </div>
                    </a>
                </article>
                @endforeach
            </div>

            <!-- Pagination -->
            @if($news->hasPages())
            <div class="mt-6 sm:mt-8">
                {{ $news->links() }}
            </div>
            @endif
        </div>

        <!-- Sidebar Column - Berita Populer -->
        <div class="lg:col-span-4">
            <div class="mb-8">
                <h2 class="text-lg sm:text-xl font-bold text-red-600 mb-3 sm:mb-4">BERITA POPULER</h2>
                <div class="space-y-3 sm:space-y-4">
                    @foreach($popularNews as $popular)
                    <a href="{{ route('news.detail', $popular->slug) }}" class="flex items-start space-x-3 bg-white rounded-lg p-2.5 sm:p-3 shadow-sm group hover:bg-gray-50 hover:shadow-md transition-all">
                        <div class="w-16 h-12 sm:w-20 sm:h-14 lg:w-24 lg:h-16 bg-gray-200 rounded flex-shrink-0">
                            <img src="{{ $popular->image_url }}" alt="{{ $popular->title }}" class="w-full h-full object-cover rounded" loading="lazy">
                        </div>
                        <div class="flex-1 min-w-0">
                            <div class="inline-flex items-center space-x-2">
                                <span class="text-[10px] sm:text-xs text-red-600 font-medium border-b-2 border-yellow-500 pb-1">{{ $popular->category->name }}</span>
                            </div>
                            <h3 class="font-medium text-xs sm:text-sm mt-1 group-hover:text-red-600 transition-colors line-clamp-2 leading-snug">{{ $popular->title }}</h3>
                            <span class="text-[10px] sm:text-xs text-gray-500 line-clamp-1 mt-1">{{ $popular->created_at->translatedFormat('d F Y') }}</span>
                        </div>
                    </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</main>
@endsection