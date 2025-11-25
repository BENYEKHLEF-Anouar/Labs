@extends('layouts.public')

@section('title', 'Favoris - Blog Group-1')

@section('content')
<!-- PAGE HEADER -->
<header class="bg-gradient-to-r from-blue-50 to-indigo-50 py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <nav class="flex mb-4 text-sm">
            <a href="{{ route('home') }}" class="text-blue-600 hover:text-blue-800">Accueil</a>
            <span class="mx-2 text-gray-500">/</span>
            <span class="text-gray-600">Favoris</span>
        </nav>

        <div class="flex justify-between items-center flex-wrap gap-4">
            <div>
                <h1 class="text-3xl md:text-4xl font-bold text-gray-900 mb-2">Mes Articles Favoris</h1>
                <p class="text-gray-600">Articles que vous avez sauvegardés</p>
            </div>
            <div>
                <span class="inline-block bg-blue-500 text-white font-semibold px-4 py-2 rounded-full text-lg">
                    {{ $favorites->count() }} articles
                </span>
            </div>
        </div>
    </div>
</header>

<!-- MAIN CONTENT - FAVORITES LIST -->
<main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="space-y-6">
        @forelse($favorites as $article)
        <div class="bg-white rounded-lg shadow-md hover:shadow-xl transition-shadow duration-300">
            <div class="p-6">
                <div class="grid grid-cols-1 lg:grid-cols-4 gap-6">
                    <div class="lg:col-span-3">
                        <div class="flex flex-wrap gap-2 mb-3">
                            @if($article->category)
                            <span class="inline-block bg-blue-500 text-white text-xs font-semibold px-3 py-1 rounded-full">{{ $article->category->name }}</span>
                            @endif
                            @if($article->views > 100)
                            <span class="inline-block bg-green-500 text-white text-xs font-semibold px-3 py-1 rounded-full">Populaire</span>
                            @endif
                        </div>
                        <h2 class="text-2xl font-bold text-gray-900 mb-3 hover:text-blue-600">
                            <a href="{{ route('article.detail', $article->article_id) }}">{{ $article->title }}</a>
                        </h2>
                        <p class="text-gray-600 mb-4">
                            {{ Str::limit(strip_tags($article->content), 150) }}
                        </p>
                        <div class="flex flex-wrap gap-4 text-sm text-gray-500">
                            <span><i class="fa-solid fa-calendar"></i> {{ $article->published_at ? $article->published_at->format('d M Y') : $article->created_at->format('d M Y') }}</span>
                            <span><i class="fa-solid fa-eye"></i> {{ $article->views }} vues</span>
                            <span><i class="fa-solid fa-user"></i> {{ $article->author->name ?? 'Anonyme' }}</span>
                        </div>
                    </div>
                    <div class="flex items-center justify-end">
                        <div class="flex flex-col gap-3">
                            <button class="p-3 text-red-500 hover:bg-red-50 rounded-full transition-colors duration-200">
                                <i class="fa-regular fa-trash-can text-xl"></i>
                            </button>
                            <a href="{{ route('article.detail', $article->article_id) }}" class="p-3 text-blue-600 hover:bg-blue-50 rounded-full transition-colors duration-200">
                                <i class="fa-regular fa-eye text-xl"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="text-center py-12">
            <i class="fa-regular fa-bookmark text-6xl text-gray-300 mb-4"></i>
            <p class="text-gray-500 text-xl">Vous n'avez pas encore de favoris.</p>
            <a href="{{ route('home') }}" class="inline-block mt-4 bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-3 rounded-lg transition">
                Découvrir les articles
            </a>
        </div>
        @endforelse
    </div>

    @if($favorites->count() > 0)
    <div class="mt-12 flex flex-wrap justify-center gap-4">
        <a href="{{ route('home') }}" class="inline-flex items-center bg-white hover:bg-gray-100 text-gray-700 font-semibold px-6 py-3 rounded-lg border border-gray-300 transition">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
            Retour aux articles
        </a>
    </div>
    @endif
</main>
@endsection

@section('footer')
<footer class="bg-white border-t border-gray-200 py-8 mt-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <p class="text-gray-600">&copy; {{ date('Y') }} Blog Group-1. Tous droits réservés.</p>
    </div>
</footer>
@endsection

@push('scripts')
<script>
    const btn = document.getElementById("menu-btn");
    const menu = document.getElementById("mobile-menu");
    btn.addEventListener("click", () => menu.classList.toggle("hidden"));
</script>
@endpush
