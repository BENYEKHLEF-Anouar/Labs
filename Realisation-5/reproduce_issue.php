<?php

use App\Models\Article;
use App\Models\User;
use App\Models\Category;
use Illuminate\Support\Str;

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

// Clear logs
file_put_contents(__DIR__.'/storage/logs/laravel.log', '');

echo "--- START REPRODUCTION ---\n";

// Create a test article
$title = 'Original Title ' . Str::random(5);
$newTitle = 'Updated Title ' . Str::random(5);

echo "Creating article with title: $title\n";

$user = User::first();
if (!$user) {
    $user = User::factory()->create();
}
$category = Category::first();
if (!$category) {
    $category = Category::factory()->create();
}

// Case 1: Published, published_at = now()
$article = Article::create([
    'title' => $title,
    'slug' => Str::slug($title),
    'content' => 'Content',
    'status' => 'Publié',
    'author_id' => $user->user_id,
    'category_id' => $category->category_id,
    'published_at' => now(),
]);

echo "Article created. ID: " . $article->article_id . "\n";

// Verify it's found in search
$found = Article::where('title', 'like', "%$title%")->where('status', 'Publié')->exists();
echo "Search 1 (Original, Publié, Now): " . ($found ? "FOUND" : "NOT FOUND") . "\n";

// Update the article
echo "Updating article to title: $newTitle\n";
$article->update([
    'title' => $newTitle,
    'slug' => Str::slug($newTitle),
]);

// Verify update in DB
$article->refresh();
echo "Article title in DB: " . $article->title . "\n";

// Search for new title
$foundNew = Article::where('title', 'like', "%$newTitle%")->where('status', 'Publié')->exists();
echo "Search 2 (Updated, Publié, Now): " . ($foundNew ? "FOUND" : "NOT FOUND") . "\n";

// Case 2: Published, published_at = NULL
echo "Updating published_at to NULL\n";
$article->update(['published_at' => null]);
$foundNull = Article::where('title', 'like', "%$newTitle%")->where('status', 'Publié')->exists();
echo "Search 3 (Updated, Publié, NULL): " . ($foundNull ? "FOUND" : "NOT FOUND") . "\n";

// Case 3: Published, published_at = Future
echo "Updating published_at to Future\n";
$article->update(['published_at' => now()->addDays(10)]);
$foundFuture = Article::where('title', 'like', "%$newTitle%")->where('status', 'Publié')->exists();
echo "Search 4 (Updated, Publié, Future): " . ($foundFuture ? "FOUND" : "NOT FOUND") . "\n";

// Clean up
$article->delete();
echo "--- END REPRODUCTION ---\n";
