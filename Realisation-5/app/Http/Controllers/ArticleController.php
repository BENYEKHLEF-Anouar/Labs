<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    // List all articles
    public function index()
    {
        $articles = Article::with('author', 'category')->get();
        $categories = \App\Models\Category::all();
        return view('articles.index', compact('articles', 'categories'));
    }

    // Show edit form for an article
    public function edit($id)
    {
        $article = Article::findOrFail($id);
        $categories = \App\Models\Category::all();
        return view('articles.edit', compact('article', 'categories'));
    }
    // Update an article
    public function update(Request $request, $id)
    {
        $article = Article::findOrFail($id);
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|unique:articles,slug,' . $id . ',article_id',
            'content' => 'required|string',
            'published_at' => 'nullable|date',
            'category_id' => 'nullable|exists:categories,category_id',
            'status' => 'required|in:Brouillon,Publié',
        ]);
        $article->update($validated);
        return redirect()->route('article.index')->with('success', 'Article updated successfully.');
    }

    // Delete an article
    public function destroy($id)
    {
        $article = Article::findOrFail($id);
        
        // Delete related records first due to foreign key constraints
        $article->comments()->delete(); // Delete all comments
        $article->tags()->detach(); // Detach all tags
        
        // Delete favorites (delete from favorites table)
        \DB::table('favorites')->where('article_id', $article->article_id)->delete();
        
        $article->delete();
        
        return redirect()->route('article.index')->with('success', 'Article deleted successfully.');
    }
}
