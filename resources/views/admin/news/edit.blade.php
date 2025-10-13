<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit News') }}
        </h2>
    </x-slot>

    <!-- Include Quill stylesheet -->
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form id="newsForm" action="{{ route('admin.news.update', $news->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <x-input-label for="category_id" :value="__('Category')" />
                        <select name="category_id" id="category_id" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full">
                                <option value="">Select Category</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id', $news->category_id) == $category->id ? 'selected' : '' }}">
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('category_id')" class="mt-2" />
                    </div>

                    <div class="mb-4">
                        <x-input-label for="title" :value="__('Title')" />
                        <x-text-input id="title" name="title" type="text" class="block mt-1 w-full" :value="old('title', $news->title)" required />
                        <x-input-error :messages="$errors->get('title')" class="mt-2" />
                    </div>

                    <div class="mb-4">
                        <x-input-label for="content" :value="__('Content')" />
                        <div class="mb-4 p-4 bg-gray-50 rounded-lg border border-gray-200">
                                <h4 class="text-sm font-semibold text-gray-700 mb-3">Contoh Shortcode yang bisa digunakan:</h4>
                                <div class="space-y-3 text-sm">

                                    <div>
                                        <label class="block text-xs font-medium text-gray-600 mb-1">Baca Juga (copy paste ke editor):</label>
                                        <div class="bg-white border border-gray-300 rounded p-2 font-mono text-xs">
                                        [baca-juga url="/news/tester"]patrick menikahi tiang dan hidup bahagia selamanya[/baca-juga]
                                        </div>
                                        <p class="text-xs text-gray-500 mt-1">Contoh: [baca-juga url="/news/tester"]patrick menikahi tiang dan hidup bahagia selamanya[/baca-juga]</p>
                                    </div>


                                    <div>
                                        <label class="block text-xs font-medium text-gray-600 mb-1">Quote (copy paste ke editor):</label>
                                        <div class="bg-white border border-gray-300 rounded p-2 font-mono text-xs">
                                        [quote author="Jojo"]Tincur massa id et id tellus.\nConvallis .[/quote]
                                        </div>
                                        <p class="text-xs text-gray-500 mt-1">Contoh: [quote author="Jojo"]Tincur massa id et id tellus.\nConvallis .[/quote]</p>
                                    </div>
                                </div>
                            </div>
                        <!-- Quill editor container -->
                        <div id="editor" style="height: 300px;">{!! old('content', $news->content) !!}</div>
                        <!-- Hidden textarea to store the content -->
                        <textarea id="content" name="content" class="hidden">{{ old('content', $news->content) }}</textarea>
                        <x-input-error :messages="$errors->get('content')" class="mt-2" />
                    </div>

                    <div class="mb-4">
                        <x-input-label for="image" :value="__('Image')" />
                        @if($news->image)
                            <div class="mb-2">
                                <img src="{{ $news->image_url }}" alt="{{ $news->title }}" class="h-32 w-auto">
                                </div>
                            @endif
                        <input type="file" id="image" name="image" class="block mt-1 w-full" accept="image/*">
                        <x-input-error :messages="$errors->get('image')" class="mt-2" />
                    </div>

                    <div class="mb-4">
                            <x-input-label for="author" :value="__('Author')" />
                        <x-text-input id="author" name="author" type="text" class="block mt-1 w-full" :value="old('author', $news->author)" required />
                        <x-input-error :messages="$errors->get('author')" class="mt-2" />
                    </div>

                    <div class="mb-4">
                        <x-input-label for="location" :value="__('Location')" />
                        <x-text-input id="location" name="location" type="text" class="block mt-1 w-full" :value="old('location', $news->location)" />
                        <x-input-error :messages="$errors->get('location')" class="mt-2" />
                    </div>

                    <div id="publish-date-container" class="mb-4 {{ old('status', $news->status) == 'scheduled' ? '' : 'hidden' }}">
                        <x-input-label for="published_at" :value="__('Publish Date')" />
                        <x-text-input id="published_at" name="published_at" type="datetime-local" class="block mt-1 w-full" :value="old('published_at', $news->published_at ? $news->published_at->format('Y-m-d\TH:i') : '')" />
                        <x-input-error :messages="$errors->get('published_at')" class="mt-2" />
                    </div>

                    <div class="mb-4">
                        <x-input-label for="status" :value="__('Status')" />
                        <select name="status" id="status" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full">
                            <option value="draft" {{ old('status', $news->status) == 'draft' ? 'selected' : '' }}>Draft</option>
                            <option value="published" {{ old('status', $news->status) == 'published' ? 'selected' : '' }}>Published</option>
                            <option value="scheduled" {{ old('status', $news->status) == 'published' ? 'selected' : '' }}>Published</option>
                            <option value="archived" {{ old('status', $news->status) == 'published' ? 'selected' : '' }}>Scheduled</option>
                        </select>
                        <x-input-error :messages="$errors->get('status')" class="mt-2" />
                    </div>

                    <div class="mb-4">
                        <label class="inline-flex items-center">
                            <input type="checkbox" name="is_featured" value="1" {{ old('is_featured', $news->is_featured) ? 'checked' : '' }}
                        <span class="ml-2 text-sm text-gray-600">Featured News (Tampilkan di slider utama)</span>
                        </label>
                        <x-input-error :messages="$errors->get('is_featured')" class="mt-2" />
                    </div>

                    <div class="mb-4">
                        <x-input-label for="tags" :value="__('Tags (pisahkan dengan koma)')" />
                        <x-text-input id="tags" name="tags" type="text" class="block mt-1 w-full" :value="old('tags', $news->tags)" placeholder="contoh: kpk, haji, kemenag" />
                        <x-input-error :messages="$errors->get('tags')" class="mt-2" />
                    </div>

                    <!-- Shortcode Examples -->
                    <div class="mb-4 p-4 rounded-lg text-right">

                        <a href="{{ route('admin.news.index') }}" class="text-gray-600 hover:text-gray-900 mr-4">
                            {{ __('Cancel') }}
                        </a>
                        <x-primary-button type="button" onclick="submitForm()">
                            {{ __('Update News') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Include Quill JS -->
    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
    <script>
        // Initialize Quill editor
        var quill = new Quill('#editor', {
            theme: 'snow',
            modules: {
                toolbar: [
                    [{ 'header': [1, 2, 3, 4, 5, 6, false] }],
                ['bold', 'italic', 'underline', 'strike'],
                ['blockquote', 'code-block'],
                [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                [{ 'script': 'sub'}, { 'script': 'super' }],
                [{ 'indent': '-1'}, { 'indent': '+1' }],
                [{ 'direction': 'rtl' }],
                [{ 'color': [] }, { 'background': [] }],
                [{ 'align': [] }],
                ['link', 'image'],
                ['clean']
                ]
            }
        });

        // Function to show/hide publish date based on status
        function togglePublishDate() {
            var status = document.getElementById('status').value;
            var publishDateContainer = document.getElementById('publish-date-container');

            if (status === 'scheduled') {
                publishDateContainer.classList.remove('hidden');
            } else {
                publishDateContainer.classList.add('hidden');
            }
        }

        // Initialize on page load
        document.addEventListener('DOMContentLoaded', function() {
            // Set initial state
            togglePublishDate();

            // Add event listener to status dropdown
            document.getElementById('status').addEventListener('change', togglePublishDate);

        // Set initial content for Quill editor
        var contentTextarea = document.querySelector('#content');
        if (contentTextarea.value) {
                quill.root.innerHTML = contentTextarea.value;
        }
        });

        // Function to submit form
        function submitForm() {
            var content = document.querySelector('#content');
            content.value = quill.root.innerHTML;

            document.getElementById('newsForm').submit();
        }
    </script>
</x-app-layout>