@extends('layouts.app')

@section('content')
<div class="max-w-[85rem] px-4 py-10 sm:px-6 lg:px-8 lg:py-14 mx-auto">
    <div class="max-w-3xl mx-auto">
        <div class="bg-white border border-gray-200 rounded-xl shadow-sm dark:bg-slate-900 dark:border-gray-700">
            <div class="p-4 sm:p-7">
                <div class="mb-8">
                    <h1 class="text-3xl font-bold text-gray-800 dark:text-white">
                        {{ $article->title }}
                    </h1>
                    <div class="mt-4 flex items-center gap-x-3">
                        <div class="text-sm text-gray-500 dark:text-gray-400">
                            By <span class="font-semibold text-gray-800 dark:text-gray-200">{{ $article->author->name ?? 'Unknown' }}</span>
                        </div>
                        <div class="text-sm text-gray-500 dark:text-gray-400">
                            {{ $article->created_at->format('M d, Y') }}
                        </div>
                        <div class="flex gap-x-2">
                            @foreach($article->categories as $category)
                                <span class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-full text-xs font-medium bg-blue-100 text-blue-800 dark:bg-blue-800/30 dark:text-blue-500">{{ $category->name }}</span>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="prose prose-lg dark:prose-invert max-w-none">
                    {!! $article->content !!}
                </div>

                <div class="mt-8 pt-8 border-t border-gray-200 dark:border-gray-700">
                    <a class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600" href="{{ route('articles.index') }}">
                        Back to Articles
                    </a>
                    <a class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-gray-200 text-gray-500 hover:border-blue-600 hover:text-blue-600 disabled:opacity-50 disabled:pointer-events-none dark:border-gray-700 dark:text-gray-400 dark:hover:text-blue-500 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600" href="{{ route('articles.edit', $article->article_id) }}">
                        Edit Article
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
