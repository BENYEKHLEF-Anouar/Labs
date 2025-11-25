@extends('layouts.public')

@section('title', $article->title . ' - Blog Group-1')

@section('content')
<!-- ARTICLE HEADER -->
<header class="bg-gradient-to-r from-blue-50 to-indigo-50 py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <nav class="flex mb-6 text-sm">
            <a href="{{ route('home') }}" class="text-blue-600 hover:text-blue-800">Accueil</a>
            <span class="mx-2 text-gray-500">/</span>
            <span class="text-gray-600">{{ $article->category->name ?? 'Article' }}</span>
        </nav>
        <h1 class="text-4xl md:text-5xl font-bold text-gray-900 mb-6">{{ $article->title }}</h1>
        <div class="flex flex-wrap gap-4 items-center text-gray-600">
            @if($article->category)
            <span class="inline-block bg-blue-500 text-white text-sm font-semibold px-3 py-1 rounded-full">{{ $article->category->name }}</span>
            @endif
            <span>Publié le: {{ $article->published_at ? $article->published_at->format('d F Y') : $article->created_at->format('d F Y') }}</span>
            <span>Par: {{ $article->author->name ?? 'Anonyme' }}</span>
        </div>
    </div>
</header>

<!-- MAIN CONTENT -->
<main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Article Content -->
        <div class="lg:col-span-2">
            <article class="bg-white rounded-lg shadow-md p-8">
                @if($article->image)
                <img src="{{ asset('storage/' . $article->image) }}" alt="{{ $article->title }}" class="w-full h-96 object-cover rounded-lg mb-8">
                @else
                <div class="bg-gray-300 rounded-lg flex items-center justify-center mb-8 h-96">
                    <p class="text-2xl text-gray-600">[Image de l'article]</p>
                </div>
                @endif

                <div class="prose max-w-none text-gray-700 leading-relaxed">
                    {!! nl2br(e($article->content)) !!}
                </div>

                <!-- COMMENTS SECTION -->
                <section class="w-full mx-auto py-8 mt-8 border-t">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6">Commentaires ({{ $article->comments->count() }})</h2>

                    @if(session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                        {{ session('success') }}
                    </div>
                    @endif

                    <!-- Existing comments -->
                    <div class="space-y-6 mb-8">
                        @forelse($article->comments as $comment)
                        <div class="bg-gray-50 shadow-md p-4 rounded-lg">
                            <p class="text-gray-800 font-semibold">
                                {{ $comment->user->name ?? $comment->guest_name ?? 'Visiteur' }}
                                <span class="text-gray-500 text-sm">– {{ $comment->created_at->format('d F Y') }}</span>
                            </p>
                            <p class="text-gray-700 mt-2">{{ $comment->content }}</p>
                        </div>
                        @empty
                        <p class="text-gray-500">Aucun commentaire pour le moment. Soyez le premier à commenter!</p>
                        @endforelse
                    </div>

                    <!-- Comment form -->
                    <div class="bg-white p-4 rounded-lg border">
                        <h3 class="text-lg font-bold text-gray-900 mb-4">Laissez un commentaire</h3>
                        <form action="{{ route('article.comment', $article->article_id) }}" method="POST">
                            @csrf
                            @guest
                            <div class="mb-4">
                                <label for="guest_name" class="block text-gray-700 font-semibold mb-1">Votre nom</label>
                                <input type="text" id="guest_name" name="guest_name" class="w-full border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Votre nom" required>
                            </div>
                            @endguest
                            <div class="mb-4">
                                <label for="content" class="block text-gray-700 font-semibold mb-1">Commentaire</label>
                                <textarea id="content" name="content" rows="4" class="w-full border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Votre commentaire" required></textarea>
                            </div>
                            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-lg transition">Envoyer</button>
                        </form>
                    </div>
                </section>
            </article>

            <div class="mt-8">
                <a href="{{ route('home') }}" class="inline-flex items-center text-gray-600 hover:text-blue-600 font-medium transition">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                    </svg>
                    Retour aux articles
                </a>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="lg:col-span-1">
            <div class="sticky top-8 space-y-6">
                <!-- Share Card -->
                <div class="bg-white rounded-lg shadow-md p-6 text-center">
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Partager cet article</h3>
                    <div class="flex justify-center gap-4">
                        <a href="#" class="text-green-500 hover:text-green-700 text-2xl"><i class="fa-brands fa-whatsapp"></i></a>
                        <a href="#" class="text-blue-600 hover:text-blue-800 text-2xl"><i class="fa-brands fa-facebook"></i></a>
                        <a href="#" class="text-blue-400 hover:text-blue-600 text-2xl"><i class="fa-brands fa-twitter"></i></a>
                        <a href="#" class="text-gray-600 hover:text-gray-800 text-2xl"><i class="fa-solid fa-envelope"></i></a>
                    </div>
                </div>

                <!-- Article Info -->
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h3 class="text-lg font-bold text-gray-900 mb-4">Informations</h3>
                    <div class="space-y-3 text-sm">
                        <div><span class="font-semibold text-gray-700">Catégorie:</span> <span class="text-gray-600">{{ $article->category->name ?? 'Non catégorisé' }}</span></div>
                        <div><span class="font-semibold text-gray-700">Auteur:</span> <span class="text-gray-600">{{ $article->author->name ?? 'Anonyme' }}</span></div>
                        <div><span class="font-semibold text-gray-700">Vues:</span> <span class="text-gray-600">{{ $article->views }}</span></div>
                        <div><span class="font-semibold text-gray-700">Partages:</span> <span class="text-gray-600">{{ $article->shares }}</span></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
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
    if (btn && menu) {
        btn.addEventListener("click", () => menu.classList.toggle("hidden"));
    }
</script>
@endpush
