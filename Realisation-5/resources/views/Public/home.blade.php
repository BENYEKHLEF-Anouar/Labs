@extends('layouts.public')

@section('title', 'Accueil - Blog Group-1')

@section('content')
<main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <!-- Search and Filter Section -->
    <section class="mb-12 fade-in">
        <div class="bg-white rounded-lg shadow-md p-6">
            <form action="{{ route('home') }}" method="GET" class="space-y-4 md:space-y-0 md:flex md:items-end md:gap-4">
                <!-- Search Input -->
                <div class="flex-1">
                    <label for="search" class="block text-sm font-medium text-gray-700 mb-1">Rechercher</label>
                    <div class="relative">
                        <input type="text" name="search" id="search" value="{{ request('search') }}" 
                            placeholder="Rechercher un article..." 
                            class="w-full border border-gray-300 rounded-lg pl-10 pr-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <i class="fa-solid fa-search absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
                    </div>
                </div>
                
                <!-- Category Filter -->
                <div class="md:w-48">
                    <label for="category" class="block text-sm font-medium text-gray-700 mb-1">Catégorie</label>
                    <select name="category" id="category" 
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <option value="">Toutes les catégories</option>
                        @foreach($categories as $category)
                        <option value="{{ $category->category_id }}" {{ request('category') == $category->category_id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                        @endforeach
                    </select>
                </div>
                
                <!-- Buttons -->
                <div class="flex gap-2">
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-2 rounded-lg transition">
                        <i class="fa-solid fa-filter mr-2"></i>Filtrer
                    </button>
                    @if($hasFilters)
                    <a href="{{ route('home') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-700 font-semibold px-4 py-2 rounded-lg transition">
                        <i class="fa-solid fa-times"></i>
                    </a>
                    @endif
                </div>
            </form>
        </div>
    </section>

    @if($hasFilters)
    <!-- Filtered Results -->
    <section class="mb-16 fade-in">
        <div class="flex justify-between items-center mb-8">
            <h2 class="text-3xl font-bold text-gray-900">Résultats de recherche</h2>
            <span class="text-gray-500">{{ $filteredArticles->total() }} article(s) trouvé(s)</span>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($filteredArticles as $article)
            <div class="bg-white rounded-lg shadow-md hover:shadow-xl transition-shadow duration-300 overflow-hidden fade-in">
                <div class="p-6">
                    @if($article->category)
                    <span class="inline-block bg-blue-500 text-white text-xs font-semibold px-3 py-1 rounded-full mb-3">{{ $article->category->name }}</span>
                    @endif
                    <h3 class="text-xl font-bold text-gray-900 mb-3">{{ Str::limit($article->title, 50) }}</h3>
                    <p class="text-gray-600 mb-4">{{ Str::limit(strip_tags($article->content), 100) }}</p>
                    <p class="text-sm text-gray-500 mb-4">Publié le: {{ $article->published_at ? $article->published_at->format('d M Y') : $article->created_at->format('d M Y') }}</p>
                    <a href="{{ route('article.detail', $article->article_id) }}" class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-2 rounded-lg transition">Lire plus</a>
                </div>
            </div>
            @empty
            <div class="col-span-3 text-center py-12">
                <i class="fa-solid fa-search text-6xl text-gray-300 mb-4"></i>
                <p class="text-gray-500 text-xl">Aucun article trouvé pour votre recherche.</p>
            </div>
            @endforelse
        </div>
        
        <!-- Pagination -->
        @if($filteredArticles->hasPages())
        <div class="mt-8">
            {{ $filteredArticles->withQueryString()->links() }}
        </div>
        @endif
    </section>
    @else
    <!-- Recent Articles Section -->
    <section class="mb-16 fade-in">
        <h2 class="text-3xl font-bold text-gray-900 mb-8">Articles Récents</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($recentArticles as $article)
            <div class="bg-white rounded-lg shadow-md hover:shadow-xl transition-shadow duration-300 overflow-hidden fade-in">
                <div class="p-6">
                    @if($loop->first)
                    <span class="inline-block bg-blue-500 text-white text-xs font-semibold px-3 py-1 rounded-full mb-3">Nouveau</span>
                    @elseif($article->views > 100)
                    <span class="inline-block bg-green-500 text-white text-xs font-semibold px-3 py-1 rounded-full mb-3">Populaire</span>
                    @endif
                    <h3 class="text-xl font-bold text-gray-900 mb-3">{{ Str::limit($article->title, 50) }}</h3>
                    <p class="text-gray-600 mb-4">{{ Str::limit(strip_tags($article->content), 100) }}</p>
                    <p class="text-sm text-gray-500 mb-4">Publié le: {{ $article->published_at ? $article->published_at->format('d M Y') : $article->created_at->format('d M Y') }}</p>
                    <a href="{{ route('article.detail', $article->article_id) }}" class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-2 rounded-lg transition">Lire plus</a>
                </div>
            </div>
            @empty
            <p class="text-gray-500 col-span-3">Aucun article récent disponible.</p>
            @endforelse
        </div>
    </section>

    <!-- Popular Articles Section -->
    <section class="fade-in">
        <h2 class="text-3xl font-bold text-gray-900 mb-8">Articles Populaires</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($popularArticles as $article)
            <div class="bg-white rounded-lg shadow-md hover:shadow-xl transition-shadow duration-300 overflow-hidden fade-in">
                <div class="p-6">
                    @if($article->views > 500)
                    <span class="inline-block bg-yellow-500 text-gray-900 text-xs font-semibold px-3 py-1 rounded-full mb-3">Tendance</span>
                    @endif
                    <h3 class="text-xl font-bold text-gray-900 mb-3">{{ Str::limit($article->title, 50) }}</h3>
                    <p class="text-gray-600 mb-4">{{ Str::limit(strip_tags($article->content), 100) }}</p>
                    <p class="text-sm text-gray-500 mb-4">{{ $article->views }} vues</p>
                    <a href="{{ route('article.detail', $article->article_id) }}" class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-2 rounded-lg transition">Lire plus</a>
                </div>
            </div>
            @empty
            <p class="text-gray-500 col-span-3">Aucun article populaire disponible.</p>
            @endforelse
        </div>
    </section>
    @endif
</main>
@endsection

@section('footer')
<footer class="bg-gray-900 text-gray-300 py-12 mt-16 fade-in">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid md:grid-cols-3 gap-8">
        <div>
            <h3 class="text-white text-xl font-bold mb-4">Errachidia – Sahara Solidaire</h3>
            <p class="text-gray-400 mb-4">Connecter et rendre visibles les initiatives solidaires du Tafilalet.</p>
            <p class="text-gray-500 text-sm">&copy; {{ date('Y') }} Tous droits réservés.</p>
        </div>
        <div>
            <h4 class="text-white font-semibold mb-4">Liens utiles</h4>
            <ul class="space-y-2">
                <li><a href="{{ route('home') }}" class="hover:text-blue-400">Accueil</a></li>
                <li><a href="#" class="hover:text-blue-400">À propos</a></li>
                <li><a href="#" class="hover:text-blue-400">Contact</a></li>
            </ul>
        </div>
        <div>
            <h4 class="text-white font-semibold mb-4">Suivez-nous</h4>
            <div class="flex space-x-4">
                <a href="#" class="hover:text-blue-400 transition"><i class="fa-brands fa-facebook-f"></i> Facebook</a>
                <a href="#" class="hover:text-blue-400 transition"><i class="fa-brands fa-instagram"></i> Instagram</a>
            </div>
            <p class="mt-6 text-sm text-gray-500">Email : contact@BlogGroup-1.ma</p>
        </div>
    </div>
</footer>
@endsection

@push('scripts')
<script>
    const btn = document.getElementById("menu-btn");
    const menu = document.getElementById("mobile-menu");
    btn.addEventListener("click", () => menu.classList.toggle("hidden"));

    const faders = document.querySelectorAll(".fade-in");
    const appearOnScroll = new IntersectionObserver(function(entries) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add("visible");
            }
        });
    }, { threshold: 0.2 });
    faders.forEach(fader => appearOnScroll.observe(fader));
</script>
@endpush
