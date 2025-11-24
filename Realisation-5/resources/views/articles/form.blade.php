<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ isset($article) ? 'Edit Article' : 'Create Article' }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form method="POST" action="{{ isset($article) ? route('admin.articles.update', $article) : route('admin.articles.store') }}">
                        @csrf
                        @if(isset($article))
                            @method('PUT')
                        @endif

                        <div>
                            <x-input-label for="title" :value="__('Title')" />
                            <x-text-input id="title" class="block mt-1 w-full" type="text" name="title" :value="old('title', $article->title ?? '')" required autofocus />
                            <x-input-error :messages="$errors->get('title')" class="mt-2" />
                        </div>

                        <div class="mt-4">
                            <x-input-label for="content" :value="__('Content')" />
                            <div id="editor" data-content="{{ old('content', $article->content ?? '') }}"></div>
                            <input type="hidden" id="content" name="content" value="{{ old('content', $article->content ?? '') }}">
                            <x-input-error :messages="$errors->get('content')" class="mt-2" />
                        </div>

                        <div class="mt-4">
                            <x-input-label for="categories" :value="__('Categories')" />
                            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 mt-2">
                                @foreach($categories as $category)
                                    <div class="flex items-center">
                                        <input type="checkbox" name="categories[]" id="category_{{ $category->category_id }}" value="{{ $category->category_id }}"
                                            @if(isset($article) && $article->categories->contains($category->category_id)) checked @endif
                                            class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
                                        <x-input-label for="category_{{ $category->category_id }}" class="ml-2">{{ $category->name }}</x-input-label>
                                    </div>
                                @endforeach
                            </div>
                            <x-input-error :messages="$errors->get('categories')" class="mt-2" />
                        </div>

                        <div class="mt-4">
                            <x-input-label for="status" :value="__('Status')" />
                            <select id="status" name="status" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                <option value="draft" {{ old('status', $article->status ?? '') == 'draft' ? 'selected' : '' }}>Draft</option>
                                <option value="published" {{ old('status', $article->status ?? '') == 'published' ? 'selected' : '' }}>Published</option>
                            </select>
                            <x-input-error :messages="$errors->get('status')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <x-primary-button>
                                {{ isset($article) ? 'Update Article' : 'Create Article' }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>