<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create News') }}
        </h2>
    </x-slot>

    <!-- Include Quill stylesheet -->
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form id="newsForm" action="{{ route('admin.news.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-4">
                            <x-input-label for="category_id" :value="__('Category')" />
                            <select name="category_id" id="category_id" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full">
                                <option value="">Select Category</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('category_id')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="title" :value="__('Title')" />
                            <x-text-input id="title" name="title" type="text" class="block mt-1 w-full" :value="old('title')" required />
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

                            <textarea id="content" name="content" style="display: none">{{ old('content') }}</textarea>
                            <!-- Quill editor container -->
                            <div id="editor" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm h-96">
                                {!! old('content') !!}
                            </div>
                            <x-input-error :messages="$errors->get('content')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="image" :value="__('Image')" />
                            <input type="file" id="image" name="image" class="block mt-1" accept="image/*">
                            <x-input-error :messages="$errors->get('image')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="author" :value="__('Author')" />
                            <x-text-input id="author" name="author" type="text" class="block mt-1 w-full" :value="old('author')" required />
                            <x-input-error :messages="$errors->get('author')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="location" :value="__('Location')" />
                            <x-text-input id="location" name="location" type="text" class="block mt-1 w-full" :value="old('location')" />
                            <x-input-error :messages="$errors->get('location')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="published_at" :value="__('Publish Date')" />
                            <x-text-input id="published_at" name="published_at" type="datetime-local" class="block mt-1 w-full" :value="old('published_at')" />
                            <x-input-error :messages="$errors->get('published_at')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="status" :value="__('Status')" />
                            <select name="status" id="status" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full">
                                <option value="draft" {{ old('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                                <option value="published" {{ old('status') == 'published' ? 'selected' : '' }}>Published</option>
                                <option value="archived" {{ old('status') == 'archived' ? 'selected' : '' }}>Archived</option>
                            </select>
                            <x-input-error :messages="$errors->get('status')" class="mt-2" />

                        </div>

                        <div class="mb-4">
                            <label class="inline-flex items-center">
                                <input type="checkbox" name="is_featured" value="1" {{ old('is_featured') ? 'checked' : '' }}
                                    class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
                                <span class="ml-2 text-sm text-gray-600">Featured News (Tampilkan di slider utama)</span>
                            </label>
                            <x-input-error :messages="$errors->get('is_featured')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="tags" :value="__('Tags (pisahkan dengan koma)')" />
                            <x-text-input id="tags" name="tags" type="text" class="block mt-1 w-full" :value="old('tags')" placeholder="contoh: kpk, haji, kemenag" />
                            <x-input-error :messages="$errors->get('tags')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <a href="{{ route('admin.news.index') }}" class="text-gray-600 hover:text-gray-900 mr-4">
                                {{ __('Cancel') }}
                            </a>
                            <x-primary-button type="button" onclick="submitForm()">
                                {{ __('Create News') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
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

        quill.keyboard.addBinding({
            key: 'Enter',
            shiftKey: true,
            collapsed: true,
            format: ['blockquote'],
            handler: function(range, context) {

                this.quill.insertText(range.index, '\n', Quill.sources.USER);
                this.quill.setSelection(range.index + 1, Quill.sources.SILENT);
                return false;
            }
        });

        quill.keyboard.addBinding({
            key: 'Enter',
            collapsed: true,
            format: ['blockquote'],
            handler: function(range, context) {

                var [block] = this.quill.getLine(range.index);
                if (block && block.domNode && block.domNode.tagName === 'BLOCKQUOTE') {
                    // Insert new line after blockquote
                    this.quill.insertText(range.index, '\n', Quill.sources.USER);
                    this.quill.formatLine(range.index + 1, 1, 'blockquote', false);
                    this.quill.setSelection(range.index + 1, Quill.sources.SILENT);
                    return false;
                }
                return true;
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