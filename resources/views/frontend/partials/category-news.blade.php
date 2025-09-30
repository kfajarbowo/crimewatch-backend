<div class="mb-6 sm:mb-8">
    <div class="flex justify-between items-center mb-3 sm:mb-4">
        <h2 class="text-lg sm:text-xl font-bold text-red-600">{{ $title }}</h2>
        <a href="{{ route('frontend.categories.show', $route) }}" class="text-gray-500 text-xs sm:text-sm hover:text-red-600 whitespace-nowrap">Selengkapnya →</a>
    </div>
    <div class="space-y-3 sm:space-y-4">
        @foreach($news as $item)
            <div class="flex items-start space-x-3 bg-white rounded-lg p-2.5 sm:p-3 shadow-sm hover:bg-gray-50 hover:shadow-md transition-all">
                <div class="w-16 h-12 sm:w-20 sm:h-14 lg:w-24 lg:h-16 bg-gray-200 rounded flex-shrink-0">
                    <img src="{{ $item->image_url }}" alt="{{ $item->title }}" class="w-full h-full object-cover rounded">
                </div>
                <div class="flex-1 min-w-0">
                    <h3 class="font-medium text-xs sm:text-sm mb-1 line-clamp-2">{{ $item->title }}</h3>
                    <p class="text-xs text-gray-500">{{ $item->created_at->format('l, d F Y - H:i') }} WIB</p>
                </div>
            </div>
        @endforeach
    </div>
</div>
