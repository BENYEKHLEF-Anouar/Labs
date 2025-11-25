<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use App\Models\Comment;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    public function home(Request $request)
    {
        $categories = Category::all();
        
        // Base query for articles
        $query = Article::with(['author', 'category'])->where('status', 'Publié');
        
        // Search filter
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('content', 'like', "%{$search}%");
            });
        }
        
        // Category filter
        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }
        
        // Check if filters are applied
        $hasFilters = $request->filled('search') || $request->filled('category');
        
        if ($hasFilters) {
            // Show filtered results
            $filteredArticles = $query->orderBy('published_at', 'desc')->paginate(9);
            return view('public.home', compact('categories', 'filteredArticles', 'hasFilters'));
        }
        
        // Default: show recent and popular
        $recentArticles = Article::with(['author', 'category'])
            ->where('status', 'Publié')
            ->orderBy('published_at', 'desc')
            ->take(6)
            ->get();

        $popularArticles = Article::with(['author', 'category'])
            ->where('status', 'Publié')
            ->orderBy('views', 'desc')
            ->take(6)
            ->get();

        return view('public.home', compact('recentArticles', 'popularArticles', 'categories', 'hasFilters'));
    }

    public function detail($id)
    {
        $article = Article::with(['author', 'category', 'comments' => function($query) {
            $query->where('is_approved', true)->with('user')->latest();
        }])->findOrFail($id);

        // Increment views
        $article->increment('views');

        return view('public.detail', compact('article'));
    }

    public function favorites()
    {
        // For now, show some articles as favorites (later will be user-specific)
        $favorites = Article::with(['author', 'category'])
            ->where('status', 'Publié')
            ->inRandomOrder()
            ->take(5)
            ->get();

        return view('public.favorites', compact('favorites'));
    }

    public function storeComment(Request $request, $articleId)
    {
        $request->validate([
            'content' => 'required|min:3',
            'guest_name' => 'required_without:user_id|min:2',
        ]);

        Comment::create([
            'article_id' => $articleId,
            'user_id' => auth()->id(),
            'guest_name' => auth()->check() ? null : $request->guest_name,
            'content' => $request->content,
            'is_approved' => false,
        ]);

        return back()->with('success', 'Commentaire envoyé et en attente de modération.');
    }
}
