@extends('layouts.app')

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form action="{{ route('public.articles.index') }}" method="GET" class="mb-4 flex space-x-4">
                        <input type="text" name="search" placeholder="Search by title" value="{{ request('search') }}"
                               class="border-gray-300 rounded-md shadow-sm">
                        <select name="category_id" class="border-gray-300 rounded-md shadow-sm" onchange="this.form.submit()">
                            <option value="">All Categories</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->category_id }}" {{ request('category_id') == $category->category_id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-md">Filter</button>
                    </form>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($articles as $article)
                            <a href="{{ route('public.articles.show', $article->article_id) }}" class="block">
                                <div class="bg-gray-100 p-4 rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300">
                                    <h3 class="text-xl font-semibold text-gray-800">{{ $article->title }}</h3>
                                    <p class="text-sm text-gray-600 mt-2">By {{ $article->author->name ?? 'Unknown' }} on {{ $article->published_at->format('M d, Y') }}</p>
                                    <div class="flex flex-wrap gap-2 mt-2">
                                        @foreach($article->categories as $category)
                                            <span class="bg-blue-200 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded-full">{{ $category->name }}</span>
                                        @endforeach
                                    </div>
                                    <p class="text-gray-700 mt-4">{{ Str::limit(strip_tags($article->content), 100) }}</p>
                                </div>
                            </a>
                        @endforeach
                    </div>

                    <div class="mt-8">
                        {{ $articles->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection