<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use App\Services\ArticleService;
use Illuminate\Http\Request;

class PublicArticleController extends Controller
{
    protected $articleService;

    public function __construct(ArticleService $articleService)
    {
        $this->articleService = $articleService;
    }

    /**
     * Display a listing of the published articles.
     */
    public function index(Request $request)
    {
        $filters = $request->only(['search', 'category_id']);
        $filters['status'] = 'published'; // Only show published articles
        $articles = $this->articleService->getAllArticles($filters);
        $categories = Category::all();

        return view('public.articles.index', compact('articles', 'categories'));
    }

    /**
     * Display the specified published article.
     */
    public function show(Article $article)
    {
        if ($article->status !== 'published') {
            abort(404); // Or redirect to a different page
        }
        return view('public.articles.show', compact('article'));
    }
}