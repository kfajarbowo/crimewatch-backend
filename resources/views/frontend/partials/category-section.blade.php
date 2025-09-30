<div>
    <div class="flex justify-between items-center mb-3 sm:mb-4">
        <h2 class="text-lg sm:text-xl font-bold text-red-600">{{ $title }}</h2>
        <a href="{{ route('frontend.categories.show', $route) }}" class="text-gray-500 text-xs sm:text-sm hover:text-red-600 whitespace-nowrap">Selengkapnya →</a>
    </div>
    <!-- Main Article -->
    @if($news->isNotEmpty())
        <article class="mb-4 sm:mb-6">
            <a href="{{ route('frontend.news.show', $news[0]->slug) }}" class="block group">
                <div class="bg-gray-200 aspect-video rounded-lg mb-2 sm:mb-3 shadow-sm group-hover:shadow-md transition-shadow">
                    <img src="{{ $news[0]->image_url }}" alt="{{ $news[0]->title }}" class="w-full h-full object-cover rounded-lg">
                </div>
                <h3 class="font-bold text-sm sm:text-base lg:text-lg mb-1 sm:mb-2 group-hover:text-red-600 transition-colors line-clamp-2">{{ $news[0]->title }}</h3>
                <p class="text-xs sm:text-sm text-gray-500">{{ $news[0]->created_at->format('l, d F Y - H:i') }} WIB</p>
            </a>
        </article>
        <!-- Child Articles -->
        <div class="space-y-3 sm:space-y-4">
            @foreach($news->skip(1) as $item)
                <article class="flex items-start space-x-2.5 sm:space-x-3 group hover:bg-gray-50 rounded-lg transition-colors">
                    <a href="{{ route('frontend.news.show', $item->slug) }}" class="flex items-start space-x-2.5 sm:space-x-3 w-full p-1.5 sm:p-2">
                        <img src="{{ $item->image_url }}" alt="{{ $item->title }}" class="w-16 h-12 sm:w-20 sm:h-15 rounded object-cover bg-gray-200 flex-shrink-0">
                        <div class="min-w-0">
                            <h4 class="font-medium text-xs sm:text-sm group-hover:text-red-600 transition-colors line-clamp-2">{{ $item->title }}</h4>
                            <p class="text-xs text-gray-500 mt-1">{{ $item->created_at->format('l, d F Y - H:i') }} WIB</p>
                        </div>
                    </a>
                </article>
            @endforeach
        </div>
    @endif
</div>
