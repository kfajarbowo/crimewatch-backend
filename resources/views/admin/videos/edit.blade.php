@extends('frontend.layouts.app')

@section('content')
<main class="container mx-auto px-3 sm:px-4 lg:px-6 py-4 sm:py-6">
    <!-- Header Section -->
    <div class="mb-6 sm:mb-8">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl sm:text-3xl font-bold text-red-600 mb-2">Edit TikTok Video</h1>
                <p class="text-gray-600">Update video information and content</p>
            </div>
            <a href="{{ route('admin.videos.index') }}" 
               class="inline-flex items-center px-4 py-2 bg-gray-500 border border-transparent rounded-lg font-medium text-sm text-white hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition-colors">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Back to Videos
            </a>
        </div>
    </div>

    <!-- Form Card -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-200">
        <div class="p-6 sm:p-8">
            <form action="{{ route('admin.videos.update', $video->id) }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')
                
                <!-- Category Field -->
                <div>
                    <label for="category_id" class="block text-sm font-medium text-gray-700 mb-2">
                        Category <span class="text-red-500">*</span>
                    </label>
                    <select name="category_id" 
                            id="category_id" 
                            class="block w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-red-500 focus:border-red-500 sm:text-sm @error('category_id') border-red-500 @enderror"
                            required>
                        <option value="">Select Category</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id', $video->category_id) == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Title Field -->
                <div>
                    <label for="title" class="block text-sm font-medium text-gray-700 mb-2">
                        Video Title <span class="text-red-500">*</span>
                    </label>
                    <input type="text" 
                           id="title" 
                           name="title" 
                           value="{{ old('title', $video->title) }}"
                           class="block w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-red-500 focus:border-red-500 sm:text-sm @error('title') border-red-500 @enderror"
                           placeholder="Enter video title"
                           required>
                    @error('title')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Description Field -->
                <div>
                    <label for="description" class="block text-sm font-medium text-gray-700 mb-2">
                        Description
                    </label>
                    <textarea id="description" 
                              name="description" 
                              rows="3"
                              class="block w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-red-500 focus:border-red-500 sm:text-sm @error('description') border-red-500 @enderror"
                              placeholder="Enter video description">{{ old('description', $video->description) }}</textarea>
                    @error('description')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- TikTok Embed Code Field -->
                <div>
                    <label for="tiktok_embed_code" class="block text-sm font-medium text-gray-700 mb-2">
                        TikTok Embed Code <span class="text-red-500">*</span>
                    </label>
                    <textarea id="tiktok_embed_code" 
                              name="tiktok_embed_code" 
                              rows="6"
                              class="block w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-red-500 focus:border-red-500 sm:text-sm @error('tiktok_embed_code') border-red-500 @enderror"
                              placeholder="Paste TikTok embed code here"
                              required>{{ old('tiktok_embed_code', $video->tiktok_embed_code) }}</textarea>
                    <p class="mt-2 text-sm text-gray-500">
                        <strong>How to get TikTok embed code:</strong> Click "Share" on a TikTok video → Select "Embed" → Copy the code and paste it here.
                    </p>
                    @error('tiktok_embed_code')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Author Field -->
                <div>
                    <label for="author" class="block text-sm font-medium text-gray-700 mb-2">
                        Author
                    </label>
                    <input type="text" 
                           id="author" 
                           name="author" 
                           value="{{ old('author', $video->author) }}"
                           class="block w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-red-500 focus:border-red-500 sm:text-sm @error('author') border-red-500 @enderror"
                           placeholder="Enter author name">
                    @error('author')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Status Field -->
                <div>
                    <label for="status" class="block text-sm font-medium text-gray-700 mb-2">
                        Status
                    </label>
                    <select name="status" 
                            id="status" 
                            class="block w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-red-500 focus:border-red-500 sm:text-sm @error('status') border-red-500 @enderror">
                        <option value="active" {{ old('status', $video->status) == 'active' ? 'selected' : '' }}>Active</option>
                        <option value="inactive" {{ old('status', $video->status) == 'inactive' ? 'selected' : '' }}>Inactive</option>
                    </select>
                    @error('status')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Form Actions -->
                <div class="flex items-center justify-end space-x-4 pt-6 border-t border-gray-200">
                    <a href="{{ route('admin.videos.index') }}" 
                       class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-lg text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition-colors">
                        Cancel
                    </a>
                    <button type="submit" 
                            class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-lg text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition-colors">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        Update Video
                    </button>
                </div>
            </form>
        </div>
    </div>
</main>
@endsection