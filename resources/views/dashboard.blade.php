@php
use Illuminate\Support\Facades\Auth;
@endphp
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <!-- Categories Stats -->
                        <div class="bg-white p-6 rounded-lg border">
                            <h3 class="text-lg font-semibold mb-2">Categories</h3>
                            <p class="text-3xl">{{ App\Models\Category::count() }}</p>
                            <a href="{{ route('admin.categories.index') }}" class="text-blue-600 hover:text-blue-800 mt-4 inline-block">
                                View all categories →
                            </a>
                        </div>

                        <!-- News Stats -->
                        <div class="bg-white p-6 rounded-lg border">
                            <h3 class="text-lg font-semibold mb-2">News</h3>
                              <p class="text-3xl">{{ App\Models\News::count() }}</p>
                            <a href="{{ route('admin.news.index') }}" class="text-blue-600 hover:text-blue-800 mt-4 inline-block">
                                View all news →
                            </a>
                        </div>

                        <!-- Videos Stats -->
                        <div class="bg-white p-6 rounded-lg border">
                            <h3 class="text-lg font-semibold mb-2">Videos</h3>
                              <p class="text-3xl">{{ App\Models\Video::count() }}</p>
                            <a href="{{ route('admin.videos.index') }}" class="text-blue-600 hover:text-blue-800 mt-4 inline-block">
                                View all videos →
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>