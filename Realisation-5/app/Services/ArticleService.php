<?php

namespace App\Services;

use App\Models\Article;
use App\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Str;

class ArticleService
{
    /**
     * Get all articles with filters and pagination.
     */
    public function getAllArticles(array $filters = [], int $perPage = 10): LengthAwarePaginator
    {
        $query = Article::with(['author', 'categories']);

        if (!empty($filters['search'])) {
            $query->where('title', 'like', '%' . $filters['search'] . '%');
        }

        if (!empty($filters['category_id'])) {
            $query->whereHas('categories', function ($q) use ($filters) {
                $q->where('categories.category_id', $filters['category_id']);
            });
        }

        if (!empty($filters['status'])) {
            $query->where('status', $filters['status']);
        }

        return $query->latest()->paginate($perPage);
    }

    /**
     * Create a new article.
     */
    public function createArticle(array $data): Article
    {
        $admin = $this->getAdminUser();

        $article = Article::create([
            'title' => $data['title'],
            'slug' => Str::slug($data['title']),
            'content' => $data['content'],
            'status' => $data['status'] ?? 'draft',
            'author_id' => $admin->user_id,
            'published_at' => ($data['status'] ?? 'draft') === 'published' ? now() : null,
        ]);

        if (!empty($data['categories'])) {
            $article->categories()->sync($data['categories']);
        }

        return $article;
    }

    /**
     * Update an existing article.
     */
    public function updateArticle(Article $article, array $data): Article
    {
        $article->update([
            'title' => $data['title'],
            'slug' => Str::slug($data['title']),
            'content' => $data['content'],
            'status' => $data['status'] ?? $article->status,
            'published_at' => ($data['status'] ?? $article->status) === 'published' ? now() : $article->published_at,
        ]);

        if (isset($data['categories'])) {
            $article->categories()->sync($data['categories']);
        }

        return $article;
    }

    /**
     * Delete an article.
     */
    public function deleteArticle(Article $article): bool
    {
        return $article->delete();
    }

    /**
     * Get the default Admin user.
     */
    protected function getAdminUser(): User
    {
        // Assuming the first user with 'admin' role or just the first user is the admin
        // Based on our seeder, we can look for the admin role
        $admin = User::whereHas('role', function ($q) {
            $q->where('name', 'admin');
        })->first();

        // Fallback if no admin found (should not happen with seeders)
        return $admin ?? User::firstOrFail();
    }
}
