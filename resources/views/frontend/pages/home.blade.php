@extends('frontend.layouts.app')

@section('content')
    <!-- Featured News Section -->
    <section class="mb-6 sm:mb-8">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-4 sm:gap-6">
            <!-- Main Featured News Slider -->
            <div class="col-span-1 lg:col-span-8">
                <div class="featured-slider-container relative rounded-lg overflow-hidden shadow-lg hover:shadow-xl transition-shadow">
                    <!-- Slider Wrapper -->
                    <div class="featured-slider-wrapper hide-scrollbar">
                        @foreach($featuredNews as $news)
                            <div class="featured-slide">
                                <a href="{{ route('frontend.news.show', $news->slug) }}" class="block">
                                    <div class="bg-gray-300 aspect-video sm:aspect-[16/9] relative">
                                        <img src="{{ $news->image_url }}" alt="{{ $news->title }}" class="w-full h-full object-cover">
                                        <div class="absolute bottom-0 left-0 right-0 p-3 sm:p-4 lg:p-6 bg-gradient-to-t from-black via-black/70 to-transparent text-white">
                                            <span class="inline-block text-red-400 font-medium text-xs sm:text-sm border-b-2 border-yellow-500 pb-1 mb-2 sm:mb-3">{{ $news->category->name }}</span>
                                            <h1 class="text-lg sm:text-xl lg:text-2xl font-bold mb-1 sm:mb-2 line-clamp-2">{{ $news->title }}</h1>
                                            <p class="text-xs sm:text-sm text-gray-200">{{ $news->created_at->format('l, d F Y') }}</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                    
                    <!-- Navigation Arrows -->
                    <button class="featured-nav featured-prev hidden sm:flex">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                        </svg>
                    </button>
                    <button class="featured-nav featured-next hidden sm:flex">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </button>
                    
                    <!-- Dot Indicators -->
                    <div class="featured-dots">
                        @foreach($featuredNews as $key => $news)
                            <button class="featured-dot {{ $key === 0 ? 'active' : '' }}" data-slide="{{ $key }}"></button>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Popular News Sidebar -->
            <div class="col-span-1 lg:col-span-4">
                <h2 class="text-lg sm:text-xl font-bold text-red-600 mb-3 sm:mb-4">BERITA POPULER</h2>
                <div class="space-y-3 sm:space-y-4">
                    @foreach($popularNews as $news)
                        <a href="{{ route('frontend.news.show', $news->slug) }}" class="flex items-start space-x-3 bg-white rounded-lg p-2.5 sm:p-3 shadow-sm group hover:bg-gray-50 hover:shadow-md transition-all">
                            <div class="w-16 h-12 sm:w-20 sm:h-14 lg:w-24 lg:h-16 bg-gray-200 rounded flex-shrink-0">
                                <img src="{{ $news->image_url }}" alt="{{ $news->title }}" class="w-full h-full object-cover rounded">
                            </div>
                            <div class="flex-1 min-w-0">
                                <div class="inline-flex items-center space-x-2">
                                    <span class="text-[10px] sm:text-xs text-red-600 font-medium border-b-2 border-yellow-500 pb-1">{{ $news->category->name }}</span>
                                </div>
                                <h3 class="font-medium text-xs sm:text-sm mt-1 group-hover:text-red-600 transition-colors line-clamp-2">{{ $news->title }}</h3>
                                <span class="text-[10px] sm:text-xs text-gray-500 line-clamp-1 mt-1">{{ $news->created_at->format('d F Y') }}</span>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <!-- TikTok Content Section -->
    <section class="mb-8 sm:mb-12">
        <div class="flex justify-between items-center mb-3 sm:mb-4">
            <h2 class="text-lg sm:text-xl font-bold text-red-600">KONTEN TIKTOK TERBARU</h2>
            <a href="https://www.tiktok.com/@crimewatchid" class="text-gray-500 text-xs sm:text-sm hover:text-red-600 whitespace-nowrap">Lihat lainnya →</a>
        </div>
        
        <!-- TikTok Slider Container -->
        <div class="relative">
            <div id="tiktok-slider" class="flex overflow-x-auto pb-4 space-x-3 sm:space-x-4 hide-scrollbar snap-x snap-mandatory scroll-smooth">
                @foreach($latestVideos as $video)
                    <div class="tiktok-slide relative rounded-lg sm:rounded-xl overflow-hidden shadow-md hover:shadow-lg transition-shadow min-w-[300px] sm:min-w-[325px] flex-shrink-0 snap-start">
                        <div class="aspect-[9/16] relative">
                            <div class="tiktok-embed-container" loading="lazy">
                                {!! $video->embed_html !!}
                            </div>
                            <div class="absolute bottom-0 left-0 right-0 p-2 sm:p-3 bg-gradient-to-t from-black via-black/70 to-transparent">
                                <h3 class="text-white text-xs sm:text-sm font-medium mb-1 line-clamp-2">{{ $video->title }}</h3>
                                <p class="text-gray-200 text-xs hidden sm:block">{{ $video->description }}</p>
                                <div class="flex items-center mt-1 sm:mt-2">
                                    <svg class="w-3 h-3 sm:w-4 sm:h-4 text-white" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M8 5v14l11-7z"/>
                                    </svg>
                                    <span class="text-white text-xs ml-1">{{ $video->views }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            
            <!-- Navigation Arrows -->
            <button id="tiktok-prev" class="absolute left-0 top-1/2 transform -translate-y-1/2 bg-black/50 text-white p-2 rounded-full hidden sm:flex items-center justify-center z-10">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
            </button>
            <button id="tiktok-next" class="absolute right-0 top-1/2 transform -translate-y-1/2 bg-black/50 text-white p-2 rounded-full hidden sm:flex items-center justify-center z-10">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
            </button>
        </div>
    </section>

    <!-- Latest News Section -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 sm:gap-8">
        <!-- Main News Column -->
        <div class="col-span-1 lg:col-span-8">
            <div class="flex justify-between items-center mb-3 sm:mb-4">
                <h2 class="text-lg sm:text-xl font-bold text-red-600">BERITA TERBARU</h2>
                <a href="{{ route('frontend.news.index') }}" class="text-gray-500 text-xs sm:text-sm hover:text-red-600 whitespace-nowrap">Selengkapnya →</a>
            </div>
            <!-- News List -->
            <div class="space-y-4 sm:space-y-6">
                @foreach($latestNews as $news)
                    <article class="bg-white rounded-lg overflow-hidden shadow-sm group hover:bg-gray-50 hover:shadow-md transition-all">
                        <a href="{{ route('frontend.news.show', $news->slug) }}" class="block">
                            <div class="flex flex-col sm:flex-row">
                                <div class="w-full sm:w-40 lg:w-48 h-48 sm:h-28 lg:h-32 flex-shrink-0">
                                    <img src="{{ $news->image_url }}" alt="{{ $news->title }}" class="w-full h-full object-cover">
                                </div>
                                <div class="flex-1 p-3 sm:p-4">
                                    <span class="inline-block text-xs sm:text-sm text-red-600 font-medium border-b-2 border-yellow-500 pb-1">{{ $news->category->name }}</span>
                                    <h3 class="font-bold text-sm sm:text-base lg:text-lg mt-1 mb-1 sm:mb-2 group-hover:text-red-600 transition-colors line-clamp-2">{{ $news->title }}</h3>
                                    <p class="text-xs sm:text-sm text-gray-500">{{ $news->created_at->format('l, d F Y - H:i') }} WIB</p>
                                </div>
                            </div>
                        </a>
                    </article>
                @endforeach
            </div>
        </div>

        <!-- Sidebar -->
        <div class="col-span-1 lg:col-span-4">
            <!-- POLRI Section -->
            @include('frontend.partials.category-news', [
                'title' => 'POLRI',
                'news' => $polriNews,
                'route' => 'polri'
            ])

            <!-- KRIMINAL Section -->
            @include('frontend.partials.category-news', [
                'title' => 'KRIMINAL',
                'news' => $kriminalNews,
                'route' => 'kriminal'
            ])
        </div>
    </div>

    <!-- Category Sections -->
    <section class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6 sm:gap-8 mt-8 sm:mt-12">
        <!-- BHABIN Section -->
        @include('frontend.partials.category-section', [
            'title' => 'BHABIN',
            'news' => $bhabinNews,
            'route' => 'bhabin'
        ])

        <!-- LANTAS Section -->
        @include('frontend.partials.category-section', [
            'title' => 'LANTAS',
            'news' => $lantasNews,
            'route' => 'lantas'
        ])

        <!-- POLITIK Section -->
        @include('frontend.partials.category-section', [
            'title' => 'POLITIK',
            'news' => $politikNews,
            'route' => 'politik'
        ])
    </section>
@endsection

@push('scripts')
<script async src="https://www.tiktok.com/embed.js"></script>
<script>
    // Your existing JavaScript code for sliders
</script>
@endpush