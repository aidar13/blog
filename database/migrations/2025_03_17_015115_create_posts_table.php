<?php

use App\Module\Post\Models\Post;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('status')
                ->default(Post::STATUS_DRAFT);
            $table->foreignId('author_id')
                ->constrained('users')
                ->onDelete('cascade');
            $table->string('title');
            $table->text('content');
            $table->string('featured_image')->nullable();
            $table->timestamps();
        });

        Schema::create('posts_categories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('post_id')->constrained('posts')->onDelete('cascade');
            $table->foreignId('category_id')->constrained('categories')->onDelete('cascade');
        });

        Schema::create('posts_tags', function (Blueprint $table) {
            $table->id();
            $table->foreignId('post_id')->constrained('posts')->onDelete('cascade');
            $table->foreignId('tag_id')->constrained('tags')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts_tags');
        Schema::dropIfExists('posts_categories');
        Schema::dropIfExists('posts');
    }
};
