@extends('layouts.app')

@section('content')
    <div class="max-w-[85rem] px-4 py-10 sm:px-6 lg:px-8 lg:py-14 mx-auto">
        <div class="max-w-2xl mx-auto">
            <div class="bg-white border border-gray-200 rounded-xl shadow-sm dark:bg-slate-900 dark:border-gray-700">
                <div class="p-4 sm:p-7">
                    <div class="text-center">
                        <h1 class="block text-2xl font-bold text-gray-800 dark:text-white">Create Article</h1>
                    </div>

                    <div class="mt-5">
                        <form action="{{ route('articles.store') }}" method="POST">
                            @csrf
                            <div class="grid gap-y-4">
                                <!-- Title -->
                                <div>
                                    <label for="title" class="block text-sm mb-2 dark:text-white">Title</label>
                                    <div class="relative">
                                        <input type="text" id="title" name="title"
                                            class="py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-slate-900 dark:border-gray-700 dark:text-gray-400 dark:focus:ring-gray-600"
                                            required value="{{ old('title') }}">
                                    </div>
                                    @error('title')
                                        <p class="text-xs text-red-600 mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                                <!-- End Title -->

                                <!-- Content (Tiptap) -->
                                <div>
                                    <label class="block text-sm mb-2 dark:text-white">Content</label>
                                    <div id="tiptap-editor"
                                        class="min-h-[300px] border border-gray-200 rounded-lg p-4 dark:border-gray-700 dark:bg-slate-900 dark:text-gray-300">
                                    </div>
                                    <input type="hidden" name="content" id="content-input" value="{{ old('content') }}">
                                    @error('content')
                                        <p class="text-xs text-red-600 mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                                <!-- End Content -->

                                <!-- Categories -->
                                <div>
                                    <label for="categories" class="block text-sm mb-2 dark:text-white">Categories</label>
                                    <select id="categories" name="categories[]" multiple
                                        class="py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-slate-900 dark:border-gray-700 dark:text-gray-400 dark:focus:ring-gray-600">
                                        @foreach($categories as $category)
                                            <option value="{{ $category->category_id }}" {{ in_array($category->category_id, old('categories', [])) ? 'selected' : '' }}>{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                    <p class="text-xs text-gray-500 mt-2">Hold Ctrl (Windows) or Command (Mac) to select
                                        multiple.</p>
                                    @error('categories')
                                        <p class="text-xs text-red-600 mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                                <!-- End Categories -->

                                <!-- Status -->
                                <div>
                                    <label for="status" class="block text-sm mb-2 dark:text-white">Status</label>
                                    <select id="status" name="status"
                                        class="py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-slate-900 dark:border-gray-700 dark:text-gray-400 dark:focus:ring-gray-600">
                                        <option value="Brouillon" {{ old('status') == 'Brouillon' ? 'selected' : '' }}>
                                            Brouillon</option>
                                        <option value="Publié" {{ old('status') == 'Publié' ? 'selected' : '' }}>Publié
                                        </option>
                                    </select>
                                    @error('status')
                                        <p class="text-xs text-red-600 mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                                <!-- End Status -->

                                <button type="submit"
                                    class="w-full py-3 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600">
                                    Create Article
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection