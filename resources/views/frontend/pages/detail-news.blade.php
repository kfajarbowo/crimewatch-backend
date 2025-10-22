@php use Illuminate\Support\Str; @endphp
@extends('frontend.layouts.app')

@section('page-title', $news->title . ' - CrimeWatch.ID')
@section('meta-description', $news->meta_description)
@section('meta-keywords', $news->meta_keywords)
@section('meta-author', $news->author ?: 'CrimeWatch.ID')
@section('canonical-url', route('news.detail', $news->slug))

@section('og-title', $news->title)
@section('og-description', $news->meta_description)
@section('og-image', $news->image_url)
@section('og-url', route('news.detail', $news->slug))
@section('og-type', 'article')

@section('twitter-title', $news->title)
@section('twitter-description', $news->meta_description)
@section('twitter-image', $news->image_url)

@section('content')
    <main class="container mx-auto px-4 py-6">
        <!-- SEO-Friendly Breadcrumb -->
        <nav aria-label="Breadcrumb" class="mb-4">
            <ol class="flex items-center text-sm text-gray-500 overflow-x-auto whitespace-nowrap">
                <li>
                    <a href="/" class="hover:text-red-600 transition-colors">Home</a>
                </li>
                <li class="mx-2">/</li>
                <li>
                    <a href="{{ route('category.detail', $news->category->slug) }}" class="hover:text-red-600 transition-colors">{{ $news->category->name }}</a>
                </li>
                <li class="mx-2">/</li>
                <li class="text-gray-700 line-clamp-1" aria-current="page">{{ $news->title }}</li>
            </ol>
    </nav>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
            <!-- Main Article Content -->
            <div class="lg:col-span-8">
                <article class="bg-white rounded-lg p-4 md:p-6 mb-8">
                    <!-- Article Header -->
                    <div class="mb-6">
                        <div class="flex items-start justify-between mb-3">
                            <h1 class="text-2xl md:text-3xl font-bold flex-1 pr-4">{{ $news->title }}</h1>
                            <div class="flex items-center text-sm text-gray-500 bg-gray-100 px-3 py-1 rounded-full">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                </svg>
                                <span>{{ $news->views }} views</span>
                            </div>
                        </div>
                        <div class="flex items-center justify-between flex-wrap gap-4">
                            <div class="flex flex-col text-sm text-gray-500 space-y-1">
                                <span>{{ $news->published_at?->locale('id')->translatedFormat('l, d F Y - H:i') }} WIB</span>
                                @if(!empty($news->author))
                                <span class="text-red-600">{{ $news->author }}</span>
                                @endif
                            </div>
                            <!-- Share Buttons -->
                            <div class="flex items-center space-x-3">
                                <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}" target="_blank" rel="noopener noreferrer" class="w-8 h-8 flex items-center justify-center rounded-full bg-blue-600 text-white hover:bg-blue-700">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M18.77 7.46H14.5v-1.9c0-.9.6-1.1 1-1.1h3V.5h-4.33C10.24.5 9.5 3.44 9.5 5.32v2.15h-3v4h3v12h5v-12h3.85l.42-4z"/></svg>
                                </a>
                                <a href="https://twitter.com/intent/tweet?text={{ urlencode($news->title) }}&url={{ urlencode(url()->current()) }}" target="_blank" rel="noopener noreferrer" class="w-8 h-8 flex items-center justify-center rounded-full bg-blue-400 text-white hover:bg-blue-500">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M23.44 4.83c-.8.37-1.5.38-2.22.02.93-.56.98-.96 1.32-2.02-.88.52-1.86.9-2.9 1.1-.82-.88-2-1.43-3.3-1.43-2.5 0-4.55 2.04-4.55 4.54 0 .36.03.7.1 1.04-3.77-.2-7.12-2-9.36-4.75-.4.67-.6 1.45-.6 2.3 0 1.56.8 2.95 2 3.77-.74-.03-1.44-.23-2.05-.58v.06c0 2.2 1.56 4.03 3.64 4.44-.67.2-1.37.2-2.06.08.58 1.8 2.26 3.12 4.25 3.16C5.78 18.1 3.37 18.74 1 18.46c2 1.3 4.4 2.04 6.97 2.04 8.35 0 12.92-6.92 12.92-12.93 0-.2 0-.4-.02-.6.9-.63 1.96-1.22 2.56-2.14z"/></svg>
                                </a>
                                <a href="https://api.whatsapp.com/send?text={{ urlencode($news->title . ' ' . url()->current()) }}" target="_blank" rel="noopener noreferrer" class="w-8 h-8 flex items-center justify-center rounded-full bg-green-500 text-white hover:bg-green-600">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347"/></svg>
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Featured Image -->
                    <div class="mb-6">
                        <img src="{{ $news->image_url }}" alt="{{ $news->title }}" class="w-full rounded-lg" loading="lazy">
                        @if(!empty($news->author))
                        <p class="text-sm text-gray-500 mt-2">{{ $news->title }}. (Foto: {{ $news->author }})</p>
                        @endif
                    </div>

                    <!-- Article Text -->
                    <div class="prose max-w-none">
                            {!! $news->rendered_content !!}
                        </div>

                    <!-- Internal Links -->
                    @if($news->internal_links && count($news->internal_links) > 0)
                    <div class="mt-8 pt-6 border-t">
                        <h3 class="text-lg font-bold text-gray-800 mb-4">Artikel Terkait</h3>
                        <div class="space-y-3">
                            @foreach($news->internal_links as $link)
                            <div class="p-4 bg-red-50 border border-red-200 rounded-lg">
                                <div class="text-red-700 font-semibold mb-1">Baca Juga:</div>
                                <a href="{{ $link['url'] }}" class="text-gray-700 hover:text-red-700 underline">{{ $link['text'] }}</a>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endif

                    <!-- Tags -->
                    @if($news->tags)
                    <div class="mt-8 pt-6 border-t">
                        <div class="flex items-center">
                            <span class="text-gray-700 mr-2 font-bold">Tag:</span>
                            <div class="flex flex-wrap gap-2">
                                @foreach(explode(',', $news->tags) as $tag)
                                    <a href="#" class="px-3 py-1 bg-gray-100 text-sm text-red-600 rounded-full hover:bg-gray-200">{{ trim($tag) }}</a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    @endif
                </article>
            </div>

            <!-- Sidebar -->
            <div class="lg:col-span-4">
                <div class="mb-8">
                    <h2 class="text-lg sm:text-xl font-bold text-red-600 mb-3 sm:mb-4">BERITA POPULER</h2>
                    <div class="space-y-3 sm:space-y-4">
                        @foreach($popularNews as $pop)
                        <a href="{{ route('news.detail', $pop->slug) }}" class="flex items-start space-x-3 bg-white rounded-lg p-2.5 sm:p-3 shadow-sm group hover:bg-gray-50 hover:shadow-md transition-all">
                            <div class="w-16 h-12 sm:w-20 sm:h-14 lg:w-24 lg:h-16 bg-gray-200 rounded flex-shrink-0">
                                <img src="{{ $pop->image_url }}" alt="{{ $pop->title }}" class="w-full h-full object-cover rounded" loading="lazy">
                            </div>
                            <div class="flex-1 min-w-0">
                                <div class="inline-flex items-center space-x-2">
                                    <span class="text-[10px] sm:text-xs text-red-600 font-medium border-b-2 border-yellow-500 pb-1">{{ $pop->category->name }}</span>
                                </div>
                                <h3 class="font-medium text-xs sm:text-sm mt-1 group-hover:text-red-600 transition-colors line-clamp-2 leading-snug">{{ $pop->title }}</h3>
                                <span class="text-[10px] sm:text-xs text-gray-500 line-clamp-1 mt-1">{{ $pop->published_at->locale('id')->translatedFormat('d F Y') }}</span>
                            </div>
                        </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-4">
            <h2 class="text-2xl font-bold text-red-600 mb-4">BERITA TERKAIT</h2>
            <div class="border-t-2 border-yellow-500 pt-6">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    @foreach($relatedNews as $related)
                    <a href="{{ route('news.detail', $related->slug) }}" class="block group">
                        <div class="relative mb-4">
                            <img src="{{ $related->image_url }}" alt="{{ $related->title }}" class="w-full aspect-video object-cover rounded" loading="lazy">
                        </div>
                        <h2 class="inline-block text-red-600 font-bold border-b-2 border-yellow-500 pb-1">{{ $related->category->name }}</h2>
                        <h3 class="font-bold text-lg mb-2 group-hover:text-red-600 transition-colors line-clamp-2">{{ $related->title }}</h3>
                        <p class="text-sm text-gray-500">{{ $related->published_at?->locale('id')?->translatedFormat('l, d F Y - H:i') }} WIB</p>
                    </a>
                    @endforeach
                </div>
            </div>
        </div>
    </main>

@endsection
