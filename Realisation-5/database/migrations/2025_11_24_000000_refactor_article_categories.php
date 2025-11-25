<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Drop the foreign key and column from articles table
        Schema::table('articles', function (Blueprint $table) {
            if (Schema::hasColumn('articles', 'category_id')) {
                // Check if the foreign key exists before dropping
                $foreignKeys = Schema::getConnection()->getDoctrineSchemaManager()->listTableForeignKeys('articles');
                foreach ($foreignKeys as $foreignKey) {
                    if ($foreignKey->getColumns() == ['category_id']) {
                        $table->dropForeign($foreignKey->getName());
                        break;
                    }
                }
                $table->dropColumn('category_id');
            }
        });

        // Create the pivot table
        Schema::create('article_category', function (Blueprint $table) {
            $table->id();
            $table->foreignId('article_id')->constrained('articles', 'article_id')->onDelete('cascade');
            $table->foreignId('category_id')->constrained('categories', 'category_id')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('article_category');

        Schema::table('articles', function (Blueprint $table) {
            $table->foreignId('category_id')->nullable()->constrained('categories', 'category_id');
        });
    }
};
