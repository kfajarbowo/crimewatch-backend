@php
use Illuminate\Support\Str;
@endphp

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Videos') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <!-- Header Card -->
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="flex justify-between items-center">
                    <div class="text-gray-900">
                        {{ __('Video Management') }}
                    </div>
                    <a href="{{ route('admin.videos.create') }}" 
                        class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                        {{ __('Add New Video') }}
                    </a>
                </div>
            </div>

            <!-- Success Message -->
            @if(session('success'))
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4" role="alert">
                    <p class="font-medium">{{ session('success') }}</p>
                </div>
            @endif

            <!-- Videos Grid -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        @forelse($videos as $video)
                            <div class="bg-white rounded-lg shadow-md overflow-hidden border border-gray-200">
                                <div class="aspect-[9/16] bg-gray-50">
                                    {!! $video->embed_html !!}
                                </div>
                                
                                <div class="p-6">
                                    <div class="flex justify-between items-start mb-4">
                                        <div>
                                            <h4 class="text-lg font-medium text-gray-900">{{ $video->title }}</h4>
                                            <p class="mt-1 text-sm text-gray-600">{{ $video->category->name }}</p>
                                        </div>
                                        <span class="inline-flex items-center rounded-md {{ $video->status === 'active' ? 'bg-green-50 text-green-700 ring-green-600/20' : 'bg-red-50 text-red-700 ring-red-600/20' }} px-2 py-1 text-xs font-medium ring-1 ring-inset">
                                            {{ ucfirst($video->status) }}
                                        </span>
                                    </div>

                                    @if($video->description)
                                        <p class="mt-2 text-sm text-gray-600">
                                            {{ Str::limit($video->description, 100) }}
                                        </p>
                                    @endif

                                    <div class="mt-6 flex items-center justify-end gap-x-6">
                                        <a href="{{ route('admin.videos.edit', $video->id) }}" 
                                            class="text-sm font-semibold leading-6 text-gray-900 hover:text-gray-700">
                                            Edit
                                        </a>
                                        <form action="{{ route('admin.videos.destroy', $video->id) }}" 
                                            method="POST" 
                                            class="inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                onclick="return confirm('Are you sure you want to delete this video?')"
                                                class="text-sm font-semibold leading-6 text-red-600 hover:text-red-500">
                                                Delete
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-span-2 text-center py-12 text-gray-500">
                                No videos found. Start by adding a new video.
                            </div>
                        @endforelse
                    </div>

                    <!-- Pagination -->
                    @if($videos->hasPages())
                        <div class="mt-6">
                            {{ $videos->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- TikTok Script -->
    <script async src="https://www.tiktok.com/embed.js"></script>
</x-app-layout>